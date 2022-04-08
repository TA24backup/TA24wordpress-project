jQuery(document).ready(function($) {

    /**
     * Add RTL Class in Body
     */
    var brtl;

    if ($("body").hasClass('rtl')) {

        brtl = true;

    } else {

        brtl = false;
    }

    /**
     * Header Search
     */
    $('.menu-item-search a').click(function() {
        if ($(this).hasClass('layout_two')) {
            $(this).parents('.nav-menu').find('.main-menu').hide();
        }
        $('.conslight-search-wrapper').addClass('conslight-search-triggered');
        setTimeout(function() {
            $('.conslight-search-wrapper .search-field').focus();
        }, 1000);
    });

    $('.conslight-close-icon').click(function() {
        $('.conslight-search-wrapper').removeClass('conslight-search-triggered');
        if ($(this).hasClass('search-layout-two')) {
            $(this).parents('.nav-menu').find('.main-menu').show();
        }
    });

    $('.sparkletabs .sparkletablinks a').on('click', function(e) {
        e.preventDefault();
        var that = $(this);
        var currentAttrValue = that.attr('href');
        var active = that.attr('id');

        var parentLi = that.parent('li');
        parentLi.addClass('active').siblings().removeClass('active');

        var contentArea = $(this).parents('.sparkletabs').siblings('.sparkletabsproductwrap .sparkletablinkscontent').find('.sparkletabproductarea').find("#" + currentAttrValue);

        //find is ajax or not
        var is_no_ajax = that.data('noajax');
        if (is_no_ajax) {

            that.parents('.sparkletabs').parent().find('.sparkletabproductarea .tab-content').hide();

            that.parents('.sparkletabs').parent().find('.sparkletabproductarea #' + active).show();
            $(window).trigger('resize');
            return;
        }

        that.parents('.sparkletabs').parent().find('.sparkletabproductarea ul').addClass('hidden');

        contentArea.removeClass('hidden');
        $(window).trigger('resize');

        if (parentLi.attr('data-loaded') == 1) {
            console.log('already loaded');
            return;
        }
    });

    // Home Slider
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

    /**
     * Banner Slider
     */
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


    /**
     * scrollTop To Top
     */
    $(window).scroll(function() {
        if ($(window).scrollTop() > 300) {
            $('#back-to-top').addClass('show');
        } else {
            $('#back-to-top').removeClass('show');
        }
    });

    $('#back-to-top').click(function(e) {
        e.preventDefault();
        $('html,body').animate({
            scrollTop: 0
        }, 800);
    });

    var progressPath = document.querySelector('.progress path');
    var pathLength = progressPath.getTotalLength();
    progressPath.style.transition = progressPath.style.WebkitTransition = 'none';
    progressPath.style.strokeDasharray = pathLength + ' ' + pathLength;
    progressPath.style.strokeDashoffset = pathLength;
    progressPath.getBoundingClientRect();
    progressPath.style.transition = progressPath.style.WebkitTransition = 'stroke-dashoffset 300ms linear';
    var updateProgress = function() {
        var scroll = $(window).scrollTop();
        var height = $(document).height() - $(window).height();
        var percent = Math.round(scroll * 100 / height);
        var progress = pathLength - (scroll * pathLength / height);
        progressPath.style.strokeDashoffset = progress;
        $('.percent').text(percent + "%");
    };
    updateProgress();
    $(window).scroll(updateProgress);


    /**
     * Theia sticky slider
     */
    var sticky_sidebar = construction_light_script.sticky_sidebar;

    if (sticky_sidebar == 'enable') {
        try {
            $('.content-area').theiaStickySidebar({
                additionalMarginTop: 30
            });

            $('.widget-area').theiaStickySidebar({
                additionalMarginTop: 30
            });
        } catch (e) {
            //console.log( e );
        }
    }

    /**
     * Video popup
     */
    $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
        disableOn: 700,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false
    });


    /**
     * Isotop Portfolio
     */
    if ($('.cons_light_portfolio-posts').length > 0) {

        var first_class = $('.cons_light_portfolio-cat-name:first').data('filter');

        var $container = $('.cons_light_portfolio-posts').imagesLoaded(function() {

            $container.isotope({
                itemSelector: '.cons_light_portfolio',
                filter: first_class
            });

            var elems = $container.isotope('getFilteredItemElements');

            elems.forEach(function(item, index) {
                if (index == 0 || index == 4) {
                    $(item).addClass('wide');
                    var bg = $(item).find('.cons_light_portfolio-image').attr('href');
                    $(item).find('.cons_light_portfolio-wrap').css('background-image', 'url(' + bg + ')');
                } else {
                    $(item).removeClass('wide');
                }
            });

            GetMasonary();

            setTimeout(function() {
                $container.isotope({
                    itemSelector: '.cons_light_portfolio',
                    filter: first_class,
                });
            }, 2000);

            $(window).on('resize', function() {
                GetMasonary();
            });

        });

        $('.cons_light_portfolio-cat-name-list').on('click', '.cons_light_portfolio-cat-name', function() {

            $('.cons_light_portfolio-cat-name-list').find('.cons_light_portfolio-cat-name').removeClass('active');

            var filterValue = $(this).attr('data-filter');

            $container.isotope({
                filter: filterValue
            });

            var elems = $container.isotope('getFilteredItemElements');

            elems.forEach(function(item, index) {
                if (index == 0 || index == 4) {
                    $(item).addClass('wide');
                    var bg = $(item).find('.cons_light_portfolio-image').attr('href');
                    $(item).find('.cons_light_portfolio-wrap').css('background-image', 'url(' + bg + ')');
                } else {
                    $(item).removeClass('wide');
                }
            });

            GetMasonary();

            var filterValue = $(this).attr('data-filter');
            $container.isotope({
                filter: filterValue
            });

            $('.cons_light_portfolio-cat-name').removeClass('active');
            $(this).addClass('active');
        });

        function GetMasonary() {
            var winWidth = window.innerWidth;
            if (winWidth > 580) {

                $container.find('.cons_light_portfolio').each(function() {
                    var image_width = $(this).find('img').width();
                    if ($(this).hasClass('wide')) {
                        $(this).find('.cons_light_portfolio-wrap').css({
                            height: (image_width * 2) + 15 + 'px'
                        });
                    } else {
                        $(this).find('.cons_light_portfolio-wrap').css({
                            height: image_width + 'px'
                        });
                    }
                });

            } else {
                $container.find('.cons_light_portfolio').each(function() {
                    var image_width = $(this).find('img').width();
                    if ($(this).hasClass('wide')) {
                        $(this).find('.cons_light_portfolio-wrap').css({
                            height: (image_width * 2) + 8 + 'px'
                        });
                    } else {
                        $(this).find('.cons_light_portfolio-wrap').css({
                            height: image_width + 'px'
                        });
                    }
                });
            }
        }

    }


    /**
     * Portfolio Open Light Box
     */
    $('.cons_light_portfolio-image').magnificPopup({
        type: 'image',
        closeOnContentClick: true,
        mainClass: 'mfp-img-mobile',
        image: {
            verticalFit: true
        }
    });

    /**
     * About us Achiments Awards Counter
     */
    $('.achivement').counterUp();


    /**
     * Success Product Counter
     */
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


    /**
     * Masonry Posts Layout
     */
    var grid = document.querySelector(
            '.construction-masonry'
        ),
        masonry;

    if (
        grid &&
        typeof Masonry !== undefined &&
        typeof imagesLoaded !== undefined
    ) {
        imagesLoaded(grid, function(instance) {
            masonry = new Masonry(grid, {
                itemSelector: '.hentry',
                gutter: 15
            });
        });
    }

    /**
     * Testimonial
     */
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


    /**
     * Client logo owl slider
     */
    $(' .client_logo').owlCarousel({
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

    /**
     * Add Icon Sub Menu
     */
    $('.box-header-nav .menu-item-has-children').append('<span class="sub-toggle"><i class="fas fa-plus"></i></span>');
    //$('.box-header-nav .page_item_has_children').append('<span class="sub-toggle-children"> <i class="fas fa-plus"></i> </span>');

    $('.box-header-nav .sub-toggle').click(function() {
        $(this).parent('.menu-item-has-children').children('ul.sub-menu').first().toggle();
        $(this).children('.fa-plus').first().toggleClass('fa-minus');
    });

    $(".header-nav-toggle").keydown(function(event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            jQuery(".box-header-nav.main-menu-wapper").show();
        }
    });

    /********************
     *  search
     * *****************/
    $('.search_main_menu a').click(function() {
        $('.ss-content').addClass('ss-content-act');
    });
    $('.ss-close').click(function() {
        $('.ss-content').removeClass('ss-content-act');
    });

    /********************
     *  init wow js
     * *****************/
    var wow = new WOW({
        boxClass: 'wow', // animated element css class (default is wow)
        animateClass: 'animated', // animation css class (default is animated)
        offset: 0, // distance to the element when triggering the animation (default is 0)
        mobile: true, // trigger animations on mobile devices (default is true)
        live: true, // act on asynchronously loaded content (default is true)
        callback: function(box) {
            // the callback is fired every time an animation is started
            // the argument that is passed in is the DOM node being animated
        },
        scrollContainer: null, // optional scroll container selector, otherwise use window,
        resetAnimation: true, // reset animation on end (default is true)
    });
    wow.init();


    // add all the elements inside modal which you want to make focusable
    const focusableElements =
        'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])';
    const modal = document.querySelector('#conslight-search-wrapper'); // select the modal by it's id
    if( modal ) {
        const firstFocusableElement = modal.querySelectorAll(focusableElements)[0]; // get first element to be focused inside modal
        const focusableContent = modal.querySelectorAll(focusableElements);
        const lastFocusableElement = focusableContent[focusableContent.length - 1]; // get last element to be focused inside modal
        


        document.addEventListener('keydown', function(e) {
            let isTabPressed = e.key === 'Tab' || e.keyCode === 9;

            if (!isTabPressed) {
                return;
            }

            if (e.shiftKey) { // if shift key pressed for shift + tab combination
                if (document.activeElement === firstFocusableElement) {
                    lastFocusableElement.focus(); // add focus for the last focusable element
                    e.preventDefault();
                }
            } else { // if tab key is pressed
                if (document.activeElement === lastFocusableElement) { // if focused has reached to last focusable element then focus first focusable element after pressing tab
                    firstFocusableElement.focus(); // add focus for the first focusable element
                    e.preventDefault();
                }
            }
        });

        firstFocusableElement.focus();
    }


    /** seprate pricing value */
    jQuery('.seprate-with-sup').each(function() {
        var text = jQuery(this).text();
        if (text) {
            var split = text.split(' ');
            text = text.replace(split[0], "<sup>" + split[0] + "</sup>");
            jQuery(this).html(text);
        }
    });

    /** seprate title with span */
    jQuery('.seprate-with-span').each(function() {
        var text = jQuery(this).text();
        if (text) {
            var split = text.split(' ');
            text = text.replace(split[0], "<span>" + split[0] + "</span>");
            jQuery(this).html(text);
        }
    });

    /** timer counter */
    if( jQuery('.sparkle-maintenance-countdown').length > 0 ){
        jQuery(".sparkle-maintenance-countdown").each(function(){
            var dt = jQuery(this).data('date');
            if( dt ){
                jQuery(this).countdown({ date: dt });
            }       
        })
    }

    /**
     * Gallery Light Box
    */
     $("a[rel^='cons-portfolio[work]']").prettyPhoto({
        theme: 'light_rounded',
        slideshow: 5000,
        autoplay_slideshow: false,
        keyboard_shortcuts: true,
        deeplinking : false,
        default_width: 500,
        default_height: 344,
    });
    
});