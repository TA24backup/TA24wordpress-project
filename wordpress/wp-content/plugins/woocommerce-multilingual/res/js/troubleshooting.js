jQuery( function($) {

    WCML_Troubleshooting = {


        init:  function(){

            $(function(){

                //troubleshooting page
                jQuery('#wcml_trbl').on('click',function(){
                    var field = jQuery(this);
                    field.prop('disabled', true);
                    jQuery('.spinner').css('display','inline-block').css('visibility','visible');
                    if(jQuery('#wcml_sync_update_product_count').is(':checked')){
                        WCML_Troubleshooting.update_product_count();
                    }else{
                        WCML_Troubleshooting.run_next_troubleshooting_action();
                    }
                });

                jQuery('#attr_to_duplicate').on('change',function(){
                    jQuery('.attr_status').html(jQuery(this).find('option:selected').attr('rel'))
                    jQuery('#count_terms').val(jQuery(this).find('option:selected').attr('rel'))
                });

                jQuery('#wcml_product_type_trbl').on('click',function(){
                    var field = jQuery(this);
                    field.prop('disabled', true);
                    jQuery('.product_type_spinner').css('display','inline-block').css('visibility','visible');

                    WCML_Troubleshooting.fix_product_type_terms();
                });
            });
        },
        update_product_count: function(){
            jQuery.ajax({
                type : "post",
                url : ajaxurl,
                data : {
                    action: "trbl_update_count",
                    wcml_nonce: jQuery('#trbl_update_count_nonce').val()
                },
                dataType: 'json',
                success: function( response ) {
                    jQuery('.var_status').each(function(){
                        jQuery(this).html(response.data.count);
                    })
                    jQuery('#count_prod_variat').val(response.data.count);
                    WCML_Troubleshooting.run_next_troubleshooting_action();
                }
            });
        },

        sync_variations: function(){
            jQuery.ajax({
                type : "post",
                url : ajaxurl,
                data : {
                    action: "trbl_sync_variations",
                    wcml_nonce: jQuery('#trbl_sync_variations_nonce').val()
                },
                dataType: 'json',
                success: function(response) {
                    if(jQuery('#count_prod_variat').val() == 0){
                        jQuery('.var_status').each(function(){
                            jQuery(this).html(0);
                        });
                        WCML_Troubleshooting.run_next_troubleshooting_action();
                    }else{
                        var left = jQuery('#count_prod_variat').val()-3;
                        if(left < 0 ){
                            left = 0;
                        }
                        jQuery('.var_status').each(function(){
                            jQuery(this).html(left);
                        });
                        jQuery('#count_prod_variat').val(left);
                        WCML_Troubleshooting.sync_variations();
                    }
                }
            });
        },

        sync_product_gallery: function(){
            jQuery.ajax({
                type : "post",
                url : ajaxurl,
                data : {
                    action: "trbl_gallery_images",
                    wcml_nonce: jQuery('#trbl_gallery_images_nonce').val(),
                    page: jQuery('#sync_galerry_page').val()
                },
                dataType: 'json',
                success: function(response) {
                    if(jQuery('#count_galleries').val() == 0){
                        WCML_Troubleshooting.run_next_troubleshooting_action();
                        jQuery('.gallery_status').html(0);
                    }else{
                        var left = jQuery('#count_galleries').val()-5;
                        if(left < 0 ){
                            left = 0;
                        }else{
                            jQuery('#sync_galerry_page').val(parseInt(jQuery('#sync_galerry_page').val())+1)
                        }
                        jQuery('.gallery_status').html(left);
                        jQuery('#count_galleries').val(left);
                        WCML_Troubleshooting.sync_product_gallery();
                    }
                }
            });
        },

        register_reviews_in_st: function() {
            jQuery.ajax({
                type : "post",
                url : ajaxurl,
                data : {
                    action: "register_reviews_in_st",
                    wcml_nonce: jQuery('#register_reviews_in_st_nonce').val(),
                    page: jQuery('#register_reviews_in_st_page').val()
                },
                dataType: 'json',
                success: function(response) {
                    if(jQuery('#count_unregistered_reviews').val() == 0){
                        WCML_Troubleshooting.run_next_troubleshooting_action();
                        jQuery('.unregistered_reviews_status').html(0);
                    }else{
                        var left = jQuery('#count_unregistered_reviews').val()-5;
                        if(left < 0 ){
                            left = 0;
                            jQuery('#register_reviews_in_st').prop('checked', false);
                        }else{
                            jQuery('#register_reviews_in_st_page').val(parseInt(jQuery('#register_reviews_in_st_page').val())+1)
                        }
                        jQuery('.unregistered_reviews_status').html(left);
                        jQuery('#count_unregistered_reviews').val(left);
                        WCML_Troubleshooting.register_reviews_in_st();
                    }
                }
            });
        },

        sync_product_categories: function(){
            jQuery.ajax({
                type : "post",
                url : ajaxurl,
                data : {
                    action: "trbl_sync_categories",
                    wcml_nonce: jQuery('#trbl_sync_categories_nonce').val(),
                    page: jQuery('#sync_category_page').val()
                },
                success: function(response) {
                    if(jQuery('#count_categories').val() == 0){
                        WCML_Troubleshooting.run_next_troubleshooting_action();
                        jQuery('.cat_status').html(0);
                    }else{
                        var left = jQuery('#count_categories').val()-5;
                        if(left < 0 ){
                            left = 0;
                        }else{
                            jQuery('#sync_category_page').val(parseInt(jQuery('#sync_category_page').val())+1)
                        }
                        jQuery('.cat_status').html(left);
                        jQuery('#count_categories').val(left);
                        WCML_Troubleshooting.sync_product_categories();
                    }
                }
            });
        },

        duplicate_terms: function(){
            jQuery.ajax({
                type : "post",
                url : ajaxurl,
                data : {
                    action: "trbl_duplicate_terms",
                    wcml_nonce: jQuery('#trbl_duplicate_terms_nonce').val(),
                    attr: jQuery('#attr_to_duplicate option:selected').val()
                },
                dataType: 'json',
                success: function(response) {
                    if(jQuery('#count_terms').val() == 0){
                        WCML_Troubleshooting.run_next_troubleshooting_action();
                        jQuery('.attr_status').html(0);
                    }else{
                        var left = jQuery('#count_terms').val()-5;
                        if(left < 0 ){
                            left = 0;
                        }
                        jQuery('.attr_status').html(left);
                        jQuery('#count_terms').val(left);

                        WCML_Troubleshooting.duplicate_terms();
                    }
                }
            });
        },

        sync_stock: function(){
            jQuery.ajax({
                type : "post",
                url : ajaxurl,
                data : {
                    action: "trbl_sync_stock",
                    wcml_nonce: jQuery('#trbl_sync_stock_nonce').val()
                },
                dataType: 'json',
                success: function(response) {
                    jQuery('#count_stock').val(0);
                    WCML_Troubleshooting.run_next_troubleshooting_action();
                    jQuery('.stock_status').html(0);
                }
            });
        },

        fix_translated_variations_relationships: function(){
            jQuery.ajax({
                type : "post",
                url : ajaxurl,
                data : {
                    action: "fix_translated_variations_relationships",
                    wcml_nonce: jQuery('#fix_relationships_nonce').val()
                },
                dataType: 'json',
                success: function(response) {

                    var count_input = jQuery('#count_relationships');

                    if( count_input.val() == 0 ){
                        WCML_Troubleshooting.run_next_troubleshooting_action();
                        jQuery('.relationships_status').html(0);
                    }else{
                        var left = count_input.val()-5;
                        if(left < 0 ){
                            left = 0;
                        }
                        jQuery('.relationships_status').html(left);
                        count_input.val(left);

                        WCML_Troubleshooting.fix_translated_variations_relationships();
                    }
                }
            });
        },

        sync_deleted_meta: function(){
            jQuery.ajax({
                type : "post",
                url : ajaxurl,
                data : {
                    action: "sync_deleted_meta",
                    wcml_nonce: jQuery('#sync_deleted_meta_nonce').val()
                },
                dataType: 'json',
                success: function(response) {

                    var count_input = jQuery('#count_meta'),
                        remaining = count_input.val();

                    if( remaining == 0 ){
                        WCML_Troubleshooting.run_next_troubleshooting_action();
                        jQuery('.deleted_meta_status').html(0);
                    }else{
                        remaining = Math.max( remaining - 5, 0 );
                        jQuery('.deleted_meta_status').html(remaining);
                        count_input.val(remaining);
                        WCML_Troubleshooting.sync_deleted_meta();
                    }
                }
            });
        },

        fix_product_type_terms: function(){
            jQuery.ajax({
                type : "post",
                url : ajaxurl,
                data : {
                    action: "trbl_fix_product_type_terms",
                    wcml_nonce: jQuery('#trbl_product_type_terms_nonce').val()
                },
                dataType: 'json',
                success: function(response) {
                    jQuery('#wcml_product_type_trbl').prop('disabled', false);
                    jQuery('.product_type_spinner').hide();
                    jQuery('.product_type_fix_done').show();
                    setTimeout(function() {
                        jQuery('.product_type_fix_done').fadeOut( 300 );
                    }, 2000);

                }
            });
        },

        run_next_troubleshooting_action: function(){
           if(jQuery('#wcml_sync_product_variations').is(':checked') && parseInt( jQuery('#count_prod_variat').val() ) !== 0 ){
                WCML_Troubleshooting.sync_variations();
           }else if(jQuery('#wcml_sync_gallery_images').is(':checked') && parseInt( jQuery('#count_galleries').val() ) !== 0 ){
               WCML_Troubleshooting.sync_product_gallery();
           }else if(jQuery('#wcml_sync_categories').is(':checked') && parseInt( jQuery('#count_categories').val() ) !== 0 ){
                WCML_Troubleshooting.sync_product_categories();
            }else if(jQuery('#wcml_duplicate_terms').is(':checked') && parseInt( jQuery('#count_terms').val() ) !== 0 ){
                WCML_Troubleshooting.duplicate_terms();
            }else if(jQuery('#wcml_sync_stock').is(':checked') && parseInt( jQuery('#count_stock').val() ) !== 0 ){
                WCML_Troubleshooting.sync_stock();
            }else if(jQuery('#wcml_fix_relationships').is(':checked') && parseInt( jQuery('#count_relationships').val() ) !== 0 ){
                WCML_Troubleshooting.fix_translated_variations_relationships();
            }else if(jQuery('#wcml_sync_deleted_meta').is(':checked') && parseInt( jQuery('#count_meta').val() ) !== 0 ){
                WCML_Troubleshooting.sync_deleted_meta();
           }else if(jQuery('#register_reviews_in_st').is(':checked') ){
               WCML_Troubleshooting.register_reviews_in_st();
           }else{
                jQuery('#wcml_trbl').prop('disabled', false);
                jQuery('.spinner').hide();
                jQuery('#wcml_trbl').next().fadeOut();
            }
        }

    }

    WCML_Troubleshooting.init();

});


