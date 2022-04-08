(function( $ ) {

  // GL JS IMPORT
  var gljsdocumentToImport = false;

  $(document).on('change', '#gl-js-import-file', function(e) {
    GLJSgeoJSONUploaded(e);
  })

  const GLJSgeoJSONUploaded = async (e) => {
    const fileContents = await new Response(e.target.files[0]).json()
    importGLJSGeoJSON(fileContents)
  }
  const importGLJSGeoJSON = (file) => {
    if(!file) {
      window.alert("Please upload a file.");
    } else {
      gljsdocumentToImport = file;
    }
  }

  $(document).on('click', '#gl-js-import-button', function() {
    if(gljsdocumentToImport) {
      fetch(window.params.rest_url + 'mapster-wp-maps/import-gl-js', {
        headers : {
          'X-WP-Nonce' : window.params.nonce,
          'Content-Type' : 'application/json'
        },
        method : "POST",
        body : JSON.stringify({
          file : gljsdocumentToImport,
          category : $('#gl-js-import-category').val()
        })
      }).then(resp => resp.json()).then(response => {
        $('#gl-js-import-result span').html(response.count);
        $('#gl-js-import-result').fadeIn();
      })
    } else {
      window.alert("Please upload a file.");
    }
  })

  // GEOJSON IMPORT
  var geojsondocumentToImport = false;

  $(document).on('change', '#geojson-import-file', function(e) {
    GeoJSONUploaded(e);
  })

  const GeoJSONUploaded = async (e) => {
    const fileContents = await new Response(e.target.files[0]).json()
    importGeoJSON(fileContents)
  }
  const importGeoJSON = (file) => {
    if(!file) {
      window.alert("Please upload a file.");
    } else {
      geojsondocumentToImport = file;
    }
  }

  let featuresImported = 0;

  const doGeoJSONImport = (geojsondocumentToImport, chunk) => {
    fetch(window.params.rest_url + 'mapster-wp-maps/import-geojson', {
      headers : {
        'X-WP-Nonce' : window.params.nonce,
        'Content-Type' : 'application/json'
      },
      method : "POST",
      body : JSON.stringify({
        file : {
          type : "FeatureCollection",
          features : chunk
        },
        category : $('#geojson-import-category').val()
      })
    }).then(resp => resp.json()).then(response => {
      featuresImported = featuresImported + response.count;
      $('#geojson-import-result span').html(featuresImported);
      $('#geojson-import-result').fadeIn();
      $('#geojson-import-progress').val((featuresImported/geojsondocumentToImport.features.length) * 100)
    })
  }

  const fetchFunction = (chunk) => {
    return fetch(window.params.rest_url + 'mapster-wp-maps/import-geojson', {
      headers : {
        'X-WP-Nonce' : window.params.nonce,
        'Content-Type' : 'application/json'
      },
      method : "POST",
      body : JSON.stringify({
        file : {
          type : "FeatureCollection",
          features : chunk
        },
        category : $('#geojson-import-category').val()
      })
    }).then(resp => resp.json())
  }

  async function processArray(array, fn, totalFeatures) {
    let results = [];
    for (let i = 0; i < array.length; i++) {
      let r = await fn(array[i]);
      featuresImported = featuresImported + r.count;
      $('#geojson-import-result').fadeIn();
      $('#geojson-import-result span').html(featuresImported + ' / ' + totalFeatures);
      $('#geojson-import-progress').val((featuresImported/totalFeatures) * 100)
      results.push(r);
    }
    return results;    // will be resolved value of promise
  }

  $(document).on('click', '#geojson-import-button', function() {
    if(geojsondocumentToImport) {
      const chunkSize = 50;
      let loopVar = 0;
      let chunks = [];
      for (let i = 0; i < geojsondocumentToImport.features.length; i += chunkSize) {
        const chunk = geojsondocumentToImport.features.slice(i, i + chunkSize);
        chunks.push(chunk);
        // doGeoJSONImport(geojsondocumentToImport, chunk)
        // loopVar += 1;
      }
      processArray(chunks, fetchFunction, geojsondocumentToImport.features.length);
    } else {
      window.alert("Please upload a file.");
    }
  })

})(jQuery)
