jQuery(document).ready(function ($) {
    /**
     * File customizer.js.
     *
     * Theme Customizer enhancements for a better user experience.
     *
     * Contains handlers to make Theme Customizer preview reload changes asynchronously.
    */

    $('.cl-repeater-field-title.accordion-section-title').click(function () {
        $(this).toggleClass('expanded');
    });

    $('.cl-repeater-selected-icon').click(function () {
        $(this).find( ".fa-angle-down" ).toggleClass('fa-angle-up');
    });

    // Site title and description.
    wp.customize( 'blogname', function( value ) {
        value.bind( function( to ) {
            $( '.site-title a' ).text( to );
        } );
    } );
    
    wp.customize( 'blogdescription', function( value ) {
        value.bind( function( to ) {
            $( '.site-description' ).text( to );
        } );
    } );

    // Header text color.
    wp.customize( 'header_textcolor', function( value ) {
        value.bind( function( to ) {
            if ( 'blank' === to ) {
                $( '.site-title, .site-description' ).css( {
                    'clip': 'rect(1px, 1px, 1px, 1px)',
                    'position': 'absolute'
                } );
            } else {
                $( '.site-title, .site-description' ).css( {
                    'clip': 'auto',
                    'position': 'relative'
                } );
                $( '.site-title a, .site-description' ).css( {
                    'color': to
                } );
            }
        } );
    } );

    wp.customize('construction_light_contact_num', function (value) {
		value.bind( function( to ) {
            to = '<i class="fas fa-mobile-alt"></i>' + to;
			$( '.sp_quick_info_tel' ).html( to );
		} );
    });

    wp.customize('construction_light_email', function (value) {
		value.bind( function( to ) {
            to = '<i class="fas fa-envelope"></i>' + to;
			$( '.sp_quick_info_mail' ).html( to );
		} );
    });

    wp.customize('construction_light_address', function (value) {
		value.bind( function( to ) {
            to = '<i class="fas fa-marker"></i>' + to;
			$( '.sp_quick_info_location' ).html( to );
		} );
    });

    wp.customize('construction_light_nav_style', function (value) {
        value.bind( function( to ) {
            $( '#banner-slider' ).removeClass( 'features-slider-1 features-slider-2' ).addClass( 'features-slider-' + to );
        });
    });

    jQuery(document).ready( function() {
		wp.customize.selectiveRefresh.bind( 'partial-content-rendered', function( placement ) {
			var p_p_id = placement.partial.id;
			if ( p_p_id === 'construction_light_banner_slider_settings' ) {

                var brtl;
                if ($("body").hasClass('rtl')) {
                    brtl = true;
                } else {
                    brtl = false;
                }

				if ($(".features-slider-1").length > 0) {
                    var $owlHome = $('.features-slider-1');
                    $owlHome.owlCarousel({
                        rtl: brtl,
                        items: 1,
                        autoplay: true,
                        autoplayTimeout: 5000,
                        smartSpeed: 2000,
                        margin: 0,
                        loop: true,
                        dots: false,
                        nav: true,
            
                        singleItem: true,
                        transitionStyle: "fade",
                        touchDrag: true,
                        mouseDrag: false,
                        responsive: {
                            0: {
                                nav: false
                            },
                            768: {
                                nav: true
                            },
                            992: {
                                nav: true
                            }
                        }
                    });
                    $owlHome.owlCarousel();
                    $owlHome.on('translate.owl.carousel', function(event) {
                        var data_anim = $("[data-animation]");
                        data_anim.each(function() {
                            var anim_name = $(this).data('animation');
                            $(this).removeClass('animated ' + anim_name).css('opacity', '0');
                        });
                    });
                    $("[data-delay]").each(function() {
                        var anim_del = $(this).data('delay');
                        $(this).css('animation-delay', anim_del);
                    });
                    $("[data-duration]").each(function() {
                        var anim_dur = $(this).data('duration');
                        $(this).css('animation-duration', anim_dur);
                    });
                    $owlHome.on('translated.owl.carousel', function() {
                        var data_anim = $owlHome.find('.owl-item.active').find("[data-animation]");
                        data_anim.each(function() {
                            var anim_name = $(this).data('animation');
                            $(this).addClass('animated ' + anim_name).css('opacity', '1');
                        });
                    });
            
                    function owlHomeThumb() {
                        $('.owl-item').removeClass('prev next');
                        var currentSlide = $('.features-slider-1 .owl-item.active');
            
                        currentSlide.next('.owl-item').addClass('next');
                        currentSlide.prev('.owl-item').addClass('prev');
            
                        var nextSlideImg = $('.owl-item.next').find('.slider-item').attr('data-img-url');
                        var prevSlideImg = $('.owl-item.prev').find('.slider-item').attr('data-img-url');
            
                        $('.owl-nav .owl-prev').css({
                            backgroundImage: 'url(' + prevSlideImg + ')'
                        });
                        $('.owl-nav .owl-next').css({
                            backgroundImage: 'url(' + nextSlideImg + ')'
                        });
                    }
                    owlHomeThumb();
                    $owlHome.on('translated.owl.carousel', function() {
                        owlHomeThumb();
                    });
                }

                $(".features-slider-2").owlCarousel({
                    items: 1,
                    loop: true,
                    smartSpeed: 2000,
                    dots: true,
                    nav: false,
                    autoplay: true,
                    mouseDrag: true,
                    rtl: brtl,
                    responsive: {
                        0: {
                            nav: false,
                            mouseDrag: false,
                            touchDrag: false,
                        },
                        600: {
                            nav: false,
                            mouseDrag: false,
                            touchDrag: false,
            
                        },
                        1000: {
                            nav: true,
                            mouseDrag: true,
                            touchDrag: true,
            
                        }
                    }
                });
			}
            if ( p_p_id === 'construction_light_aboutus_service_settings' ) {
                $('.achivement').counterUp();
            }
            if(p_p_id === 'construction_light_counter_settings') {
                $('.cons_light_team-counter-wrap').waypoint(function() {
                    setTimeout(function() {
                        $('.odometer1').html($('.odometer1').data('count'));
                    }, 500);
                    setTimeout(function() {
                        $('.odometer2').html($('.odometer2').data('count'));
                    }, 1000);
                    setTimeout(function() {
                        $('.odometer3').html($('.odometer3').data('count'));
                    }, 1500);
                    setTimeout(function() {
                        $('.odometer4').html($('.odometer4').data('count'));
                    }, 2000);
                    setTimeout(function() {
                        $('.odometer5').html($('.odometer5').data('count'));
                    }, 2500);
                    setTimeout(function() {
                        $('.odometer6').html($('.odometer6').data('count'));
                    }, 3000);
                    setTimeout(function() {
                        $('.odometer7').html($('.odometer7').data('count'));
                    }, 3500);
                    setTimeout(function() {
                        $('.odometer8').html($('.odometer8').data('count'));
                    }, 4000);
                }, {
                    offset: 800,
                    triggerOnce: true
                });
            }
            if(p_p_id === 'construction_light_testimonial_settings') {
                $('.testimonial_slider').owlCarousel({
                    loop: true,
                    margin: 10,
                    dots: true,
                    smartSpeed: 2000,
                    autoplay: true,
                    autoplayTimeout: 5000,
                    nav: true,
                    navText: ["<i class='fas fa-angle-left'></i>", "<i class='fas fa-angle-right'></i>"],
                    items: $('.testimonial_slider').data('columns') || 3,
                    rtl: brtl,
                    responsive: {
                        0: {
                            items: 1
                        },
                        600: {
                            items: 2
                        },
                        1000: {
                            items: 3
                        }
                    }
                });
            }
            if(p_p_id === 'construction_light_client_logo_settings') {
                $('.client_logo').owlCarousel({
                    loop: true,
                    margin: 10,
                    dots: true,
                    nav: false,
                    autoplay: true,
                    smartSpeed: 3000,
                    autoplayTimeout: 5000,
                    rtl: brtl,
                    responsive: {
                        0: {
                            items: 2
                        },
                        600: {
                            items: 4
                        },
                        1000: {
                            items: 5
                        }
                    }
            
                });
            }
		});
	});

    wp.customize('construction_light_aboutus_email_address', function (value) {
        value.bind( function( to ) {
            $( '.about-us-email' ).text( to );
        });
    });

    wp.customize('construction_light_aboutus_phone_number', function (value) {
        value.bind( function( to ) {
            $( '.about-us-contact' ).text( to );
        });
    });

    wp.customize('construction_light_aboutus_text_color', function (value) {
        value.bind( function( to ) {
            $( '.about_us_front, .about_us_front h3' ).css( 'color', to );
        });
    });

    wp.customize('construction_light_aboutus_bg_color', function (value) {
        value.bind( function( to ) {
            $( '.about_us_front' ).css( 'background-color', to );
        });
    });

    wp.customize('construction_light_pricing_title', function (value) {
        value.bind( function( to ) {
            $( '#price-section h2.seprate-with-span' ).text( to );
        });
    });

    wp.customize('construction_light_pricing_sub_title', function (value) {
        value.bind( function( to ) {
            $( '#price-section .heading-default p' ).text( to );
        });
    });

    wp.customize('construction_light_video_button_url', function (value) {
        value.bind( function( to ) {
            $( '#cl_ctavideo .video_calltoaction_wrap a' ).attr( 'href', to );
        });
    });

    wp.customize('construction_light_video_calltoaction_title', function (value) {
        value.bind( function( to ) {
            $( '#cl_ctavideo .calltoaction_full_widget_content h2' ).text( to );
        });
    });

    wp.customize('construction_light_video_calltoaction_subtitle', function (value) {
        value.bind( function( to ) {
            $( '#cl_ctavideo .calltoaction_subtitle p' ).text( to );
        });
    });

    wp.customize('construction_light_video_calltoaction_image', function (value) {
        value.bind( function( to ) {
            $( '#cl_ctavideo' ).css( 'background-image', 'url(' + to + ')' );
        });
    });

    wp.customize('construction_light_service_title', function (value) {
        value.bind( function( to ) {
            $( '#cl-service-section h2.section-title' ).text( to );
        });
    });

    wp.customize('construction_light_service_sub_title', function (value) {
        value.bind( function( to ) {
            $( '#cl-service-section .section-tagline' ).text( to );
        });
    });

    wp.customize('construction_light_calltoaction_image', function (value) {
        value.bind( function( to ) {
            $( '#cl_cta' ).css( 'background-image', 'url(' + to + ')' );
        });
    });

    wp.customize('construction_light_calltoaction_title', function (value) {
        value.bind( function( to ) {
            $( '#cl_cta .calltoaction_full_widget_content h2' ).text( to );
        });
    });    

    wp.customize('construction_light_calltoaction_subtitle', function (value) {
        value.bind( function( to ) {
            $( '#cl_cta .calltoaction_full_widget_content .calltoaction_subtitle p' ).text( to );
        });
    });  

    wp.customize('construction_light_calltoaction_button', function (value) {
        value.bind( function( to ) {
            $( '#cl_cta .calltoaction_button_wrap a.btn-primary' ).html( to + '<i class="fas fa-arrow-right"></i>' );
        });
    });   

    wp.customize('construction_light_calltoaction_link', function (value) {
        value.bind( function( to ) {
            $( '#cl_cta .calltoaction_button_wrap a.btn-primary' ).attr( 'href', to );
        });
    }); 

    wp.customize('construction_light_calltoaction_button_one', function (value) {
        value.bind( function( to ) {
            $( '#cl_cta .calltoaction_button_wrap a.btn-border' ).html( to + '<i class="fas fa-arrow-right"></i>' );
        });
    });   

    wp.customize('construction_light_calltoaction_link_one', function (value) {
        value.bind( function( to ) {
            $( '#cl_cta .calltoaction_button_wrap a.btn-border' ).attr( 'href', to );
        });
    }); 

    wp.customize('construction_light_recentwork_title', function (value) {
        value.bind( function( to ) {
            $( '#cl_portfolio h2.section-title' ).text( to );
        });
    });

    wp.customize('construction_light_recentwork_sub_title', function (value) {
        value.bind( function( to ) {
            $( '#cl_portfolio .section-tagline' ).text( to );
        });
    });
    
    wp.customize('construction_light_counter_title', function (value) {
        value.bind( function( to ) {
            $( '#cl_counter h2.section-title' ).text( to );
        });
    });

    wp.customize('construction_light_counter_sub_title', function (value) {
        value.bind( function( to ) {
            $( '#cl_counter .section-tagline' ).text( to );
        });
    });

    wp.customize('construction_light_counter_image', function (value) {
        value.bind( function( to ) {
            $( '#cl_counter' ).css( 'background-image', 'url(' + to + ')' );
        });
    });

    wp.customize('construction_light_blog_title', function (value) {
        value.bind( function( to ) {
            $( '#cl_blog h2.section-title' ).text( to );
        });
    });

    wp.customize('construction_light_blog_sub_title', function (value) {
        value.bind( function( to ) {
            $( '#cl_blog .section-tagline' ).text( to );
        });
    });

    wp.customize('construction_light_posts_alignment', function (value) {
        value.bind( function( to ) {
            $( '#cl_blog .articlesListing .box' ).removeClass('text-left text-center text-right').addClass('text-' + to);
        });
    });

    wp.customize('construction_light_testimonial_title', function (value) {
        value.bind( function( to ) {
            $( '#cl_testimonial h2.section-title' ).text( to );
        });
    });

    wp.customize('construction_light_testimonial_sub_title', function (value) {
        value.bind( function( to ) {
            $( '#cl_testimonial .section-tagline' ).text( to );
        });
    });

    wp.customize('construction_light_testimonials_image', function (value) {
        value.bind( function( to ) {
            $( '#cl_testimonial' ).css( 'background-image', 'url(' + to + ')' );
        });
    });

    wp.customize('construction_light_client_title', function (value) {
        value.bind( function( to ) {
            $( '#cl_clients h2.section-title' ).text( to );
        });
    });

    wp.customize('construction_light_client_sub_title', function (value) {
        value.bind( function( to ) {
            $( '#cl_clients .section-tagline' ).text( to );
        });
    });

    wp.customize('construction_light_breadcrumbs_image', function (value) {
        value.bind( function( to ) {
            console.log(to);
            $( '.breadcrumb' ).css( 'background-image', 'url(' + to + ')' );
        });
    });

});