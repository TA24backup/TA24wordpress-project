(function( $ ) {

  let mapLibrary;
  let currentDrawCreation = false;

  $(document).on('click', '.mapster-submit', function() {

    var thisPostID = $(this).attr('id').replace('mapster-submit-', '');

    $(`#mapster-submission-modal-overlay-${thisPostID}`).fadeIn(100);
    $(`#mapster-submission-modal-${thisPostID}`).fadeIn(150);

    var mapID = 'mapster-submission-map-'+thisPostID;
    var mapProperties = {
      center : $('#'+mapID).attr('data-center'),
      zoom : $('#'+mapID).attr('data-zoom'),
      allow_points : $('#'+mapID).attr('data-allow_points'),
      allow_lines : $('#'+mapID).attr('data-allow_lines'),
      allow_polygons : $('#'+mapID).attr('data-allow_polygons'),
      mark_as_category : $('#'+mapID).attr('data-mark_as_category'),
      include_geocoder : $('#'+mapID).attr('data-include_geocoder')
    }

    // Open a modal, and create the map and creator there, then submit through an API call
    var mapDiv = $(`#mapster-submission-modal-${thisPostID}`).find('.mapster-submission-map')
    var mapLibrary = mapDiv.data('maplibrary') === 'maplibre' ? maplibregl : mapboxgl;
    mapLibrary.accessToken = window.params.mapbox_access_token

    const map = new mapLibrary.Map({
      container: mapID, // container ID
      style: 'mapbox://styles/mapbox/streets-v11', // style URL
      center: JSON.parse(mapProperties.center), // starting position [lng, lat]
      zoom: mapProperties.zoom // starting zoom
    });

    if(mapProperties.include_geocoder === 'true') {
      map.addControl(
        new MapboxGeocoder({
          accessToken: window.params.mapbox_access_token,
          mapboxgl: mapLibrary
        })
      );
    }

    var Draw = new MapboxDraw({
      controls : {
        point : mapProperties.allow_points === 'true',
        line_string : mapProperties.allow_lines === 'true',
        polygon : mapProperties.allow_polygons === 'true',
        trash : true,
        combine_features : false,
        uncombine_features : false
      }
    });
    map.addControl(Draw, 'top-left');

    map.on('draw.create', (e) => {
      Draw.deleteAll();
      Draw.add(e.features[0]);
      currentDrawCreation = e.features[0];
      $('.mapster-submission-details').fadeIn();
    });

    map.on('draw.update', (e) => {
      currentDrawCreation = e.features[0];
    });

    map.on('draw.delete', (e) => {
      Draw.deleteAll();
      currentDrawCreation = false;
      $('.mapster-submission-details').fadeOut();
    });

  })

  $(document).on('click', '.mapster-submission-modal-close', function() {
      var thisPostID = $(this).attr('id').replace('mapster-submission-modal-close-', '');
      $(`#mapster-submission-modal-overlay-${thisPostID}`).fadeOut(50);
      $(`#mapster-submission-modal-${thisPostID}`).fadeOut(100);
  })

  $(document).on('click', '.mapster-post-submit', function() {
      var thisPostID = $(this).attr('id').replace('mapster-post-submit-', '');
      var mapID = 'mapster-submission-map-'+thisPostID;
      let postTitle = $('#mapster-submission-post-title-'+thisPostID).val();
      let postDescription = $('#mapster-submission-post-description-'+thisPostID).val();
      if(postTitle === '' || !currentDrawCreation) {
        window.alert("You must submit at least a title.");
      } else {
        fetch(`${window.params.rest_url}mapster-wp-maps/add-feature`, {
          method : "POST",
          body : JSON.stringify({
            feature : currentDrawCreation,
            post_title : postTitle,
            post_description : postDescription,
            category_id : $('#'+mapID).attr('data-category'),
            publish : $('#'+mapID).attr('data-publish')
          })
        }).then(resp => resp.json()).then(response => {
          if(response.new_feature) {
            $('#mapster-submission-response-'+thisPostID).html('Your feature was successfully submitted!');
          } else {
            $('#mapster-submission-response-'+thisPostID).html('An error occurred, please contact the admins.');
          }
        })
      }
  })

})(jQuery)
