(function ($) {
    "use strict";
    jQuery(document).on('ready', function () {
        $(window).on('scroll', function () {
            if ($(this).scrollTop() > 150) {
                $('.header-sticky').addClass("is-sticky");
            } else {
                $('.header-sticky').removeClass("is-sticky");
            }
        });
        $('.hero-slider').owlCarousel({
            items: 1,
            thumbs: false,
            dots: true,
            touchDrag: true,
            mouseDrag: false,
            rtl: true,
            smartSpeed: 1000,
            autoplay: true,
            autoplayHoverPause: true,
            loop: true,
            nav: true,
            navText: ["<i class='icofont-rounded-left'></i>", "<i class='icofont-rounded-right'></i>"]
        });
        $(".hero-slider").on("translate.owl.carousel", function () {
            $(".hero-item .welcome, .hero-item h2, .hero-item p").removeClass("animated fadeInUp").css("opacity", "0");
            $(".hero-item ul, .hero-item .price, .hero-item .hero-btn").removeClass("animated fadeInDown").css("opacity", "0");
        });
        $(".hero-slider").on("translated.owl.carousel", function () {
            $(".hero-item .welcome, .hero-item h2, .hero-item p").addClass("animated fadeInUp").css("opacity", "1");
            $(".hero-item ul, .hero-item .price, .hero-item .hero-btn").addClass("animated fadeInDown").css("opacity", "1");
        });
        $('.property-slider').owlCarousel({
            items: 1,
            loop: true,
            autoplay: true,
            rtl: true,
            nav: true,
            smartSpeed: 1500,
            mouseDrag: true,
            autoplayHoverPause: true,
            responsiveClass: true,
            dots: false,
            animateOut: 'slideOutDown',
            animateIn: 'flipInX',
            navText: ["<i class='flaticon-left-arrow-key'></i>", "<i class='flaticon-keyboard-right-arrow-button'></i>"],
        });
        new WOW().init();
        $('.popup-youtube').magnificPopup({
            disableOn: 320,
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false
        });
        $('.popup-btn').magnificPopup({
            type: 'image',
            gallery: {
                enabled: true
            }
        });
        $('#Container').mixItUp();
        $('.testimonials-slider').owlCarousel({
            loop: false,
            autoplay: false,
            nav: true,
            rtl: true,
            center: true,
            margin: 30,
            smartSpeed: 1000,
            mouseDrag: true,
            autoplayHoverPause: true,
            responsiveClass: true,
            dots: false,
            navText: ["<i class='flaticon-left-arrow-key'></i>", "<i class='flaticon-keyboard-right-arrow-button'></i>"],
            responsive: {
                0: {
                    items: 1,
                },
                768: {
                    items: 2,
                },
                1200: {
                    items: 3,
                }
            }
        });
        $('.partner-slider').owlCarousel({
            loop: false,
            autoplay: true,
            nav: false,
            rtl: true,
            mouseDrag: true,
            autoplayHoverPause: true,
            responsiveClass: true,
            dots: false,
            margin: 30,
            responsive: {
                0: {
                    items: 3,
                },
                768: {
                    items: 5,
                },
                1200: {
                    items: 5,
                }
            }
        });
        $('.amentities-slider').owlCarousel({
            items: 1,
            loop: false,
            rtl: true,
            autoplay: true,
            nav: true,
            responsiveClass: true,
            dots: false,
            autoplayHoverPause: true,
            mouseDrag: true,
            navText: ["<i class='flaticon-left-arrow-key'></i>", "<i class='flaticon-keyboard-right-arrow-button'></i>"],
        });
        $('.description-slider').owlCarousel({
            loop: false,
            autoplay: true,
            nav: true,
            margin: 30,
            rtl: true,
            mouseDrag: true,
            autoplayHoverPause: true,
            responsiveClass: true,
            dots: true,
            navText: ["<i class='flaticon-left-arrow-key'></i>", "<i class='flaticon-keyboard-right-arrow-button'></i>"],
            responsive: {
                0: {
                    items: 1,
                },
                768: {
                    items: 2,
                },
                1200: {
                    items: 3,
                }
            }
        });
        $('.client-slider').owlCarousel({
            loop: false,
            autoplay: true,
            nav: false,
            margin: 30,
            rtl: true,
            mouseDrag: true,
            autoplayHoverPause: true,
            responsiveClass: true,
            dots: true,
            responsive: {
                0: {
                    items: 1,
                },
                768: {
                    items: 1,
                },
                1200: {
                    items: 1,
                }
            }
        });
        $('body').append('<div id="toTop" class="top-arrow"><i class="flaticon-select"></i></div>');
        $(window).on('scroll', function () {
            if ($(this).scrollTop() != 0) {
                $('#toTop').fadeIn();
            } else {
                $('#toTop').fadeOut();
            }
        });
        $('#toTop').on('click', function () {
            $("html, body").animate({
                scrollTop: 0
            }, 600);
            return false;
        });
        jQuery(window).on('load', function () {
            $('.preloader').fadeOut();
        });
        $(".newsletter-form").validator().on("submit", function (event) {
            if (event.isDefaultPrevented()) {
                formErrorSub();
                submitMSGSub(false, "لطفا ایمیل خود را به درستی وارد کنید.");
            } else {
                event.preventDefault();
            }
        });

        function callbackFunction(resp) {
            if (resp.result === "success") {
                formSuccessSub();
            } else {
                formErrorSub();
            }
        }

        function formSuccessSub() {
            $(".newsletter-form")[0].reset();
            submitMSGSub(true, "از اشتراک شما متشکریم!");
            setTimeout(function () {
                $("#validator-newsletter").addClass('hide');
            }, 4000)
        }

        function formErrorSub() {
            $(".newsletter-form").addClass("animated shake");
            setTimeout(function () {
                $(".newsletter-form").removeClass("animated shake");
            }, 1000)
        }

        function submitMSGSub(valid, msg) {
            if (valid) {
                var msgClasses = "validation-success";
            } else {
                var msgClasses = "validation-danger";
            }
            $("#validator-newsletter").removeClass().addClass(msgClasses).text(msg);
        }

        $(".newsletter-form").ajaxChimp({
            url: "https://envytheme.us20.list-manage.com/subscribe/post?u=60e1ffe2e8a68ce1204cd39a5&amp;id=42d6d188d9",
            callback: callbackFunction
        });
        (function ($) {
            $('.tab ul.tabs').addClass('active').find('> li:eq(0)').addClass('current');
            $('.tab ul.tabs li a').on('click', function (g) {
                var tab = $(this).closest('.tab'),
                    index = $(this).closest('li').index();
                tab.find('ul.tabs > li').removeClass('current');
                $(this).closest('li').addClass('current');
                tab.find('.tab_content').find('div.tabs_item').not('div.tabs_item:eq(' + index + ')').slideUp();
                tab.find('.tab_content').find('div.tabs_item:eq(' + index + ')').slideDown();
                g.preventDefault();
            });
        })(jQuery);
        (function ($) {
            $('.tab ul.tabs-work').addClass('active').find('> li:eq(0)').addClass('current');
            $('.tab ul.tabs-work li a').on('click', function (g) {
                var tab = $(this).closest('.tab'),
                    index = $(this).closest('li').index();
                tab.find('ul.tabs-work > li').removeClass('current');
                $(this).closest('li').addClass('current');
                tab.find('.tab_content').find('div.tabs_item').not('div.tabs_item:eq(' + index + ')').slideUp();
                tab.find('.tab_content').find('div.tabs_item:eq(' + index + ')').slideDown();
                g.preventDefault();
            });
        })(jQuery);
    });
}(jQuery));

(function ($) {
    $.fn.extend({
        donetyping: function (callback, timeout) {
            timeout = timeout || 1e3; // 1 second default timeout
            var timeoutReference,
                doneTyping = function (el) {
                    if (!timeoutReference) return;
                    timeoutReference = null;
                    callback.call(el);
                };
            return this.each(function (i, el) {
                var $el = $(el);
                // Chrome Fix (Use keyup over keypress to detect backspace)
                // thank you @palerdot
                $el.is(':input') && $el.on('keyup keypress paste', function (e) {
                    // This catches the backspace button in chrome, but also prevents
                    // the event from triggering too preemptively. Without this line,
                    // using tab/shift+tab will make the focused element fire the callback.
                    if (e.type == 'keyup' && e.keyCode != 8) return;

                    // Check if timeout has been set. If it has, "reset" the clock and
                    // start over again.
                    if (timeoutReference) clearTimeout(timeoutReference);
                    timeoutReference = setTimeout(function () {
                        // if we made it here, our timeout has elapsed. Fire the
                        // callback
                        doneTyping(el);
                    }, timeout);
                }).on('blur', function () {
                    // If we can, fire the event since we're leaving the field
                    doneTyping(el);
                });
            });
        }
    });
})(jQuery);

(function ($) {

    $(document).ready(function () {

        // start menu mobile
        $(".header-mm").click(function (e) {
            e.preventDefault();
            $("#mask").fadeIn(500);
            $("#menumobile").addClass("come-menumobile");
        });
        $("#mask").click(function () {
            $(this).fadeOut(500);
            $("#menumobile").removeClass("come-menumobile");
            $(".sub-menu").removeClass("come-submenu");
        });
        $("#nomenumobile").click(function () {
            $("#mask").fadeOut(500);
            $("#menumobile").removeClass("come-menumobile");
            $(".sub-menu").removeClass("come-submenu");
        });
        $("#menumobile .main-mm ul > .menu-item-has-children > a").append("<span class='childer'><i></i></span>");
        $("#menumobile .sub-menu").prepend("<div class='title-sub-head'><span class='sub-closer float-left'><i></i></span><strong class='float-right title-subcome'>بازگشت</strong></div>");
        $("#menumobile .sub-closer").click(function () {
            $(this).parent().parent().removeClass('come-submenu');
        });
        $("#menumobile .childer").click(function (e) {
            e.preventDefault();
            var textmenu = $(this).parent().text();
            $(this).parent().next().addClass('come-submenu');
            $(this).parent().next().find('.title-sub-head').find('.title-subcome').html(textmenu);
        });
        // end menu mobile

        /*****************************************************
         seach pop up
         *****************************************************/

        jQuery(".header-search").click(function (e) {
            e.preventDefault();
            jQuery(".search-pup-up").fadeIn(500);
            jQuery(".search-pup-up").addClass('popup-search-active');
        });
        jQuery(".fd-outer").click(function (e) {
            e.preventDefault();
            jQuery(".search-pup-up").fadeOut(500);
            jQuery(".search-pup-up").removeClass('popup-search-active');
        });

        /*****************************************************
         AJAX search
         *****************************************************/
        jQuery('.search-close').click(function () {
            jQuery(".search-results-box").html('').fadeOut();
            jQuery("#search-text").val('');
        });
        jQuery("#search-text").donetyping(function () {
            var subject = jQuery(this).val().trim();
            if (subject.length > 2) {
                jQuery.ajax({
                    type: 'post',
                    async: true,
                    url: ajax_data.url,
                    data: {
                        action: 'results_search',
                        'subject': subject,
                        keyword: jQuery('#search-text').val(),
                    },
                    dataType: "html"

                }).done(function (data) {
                    jQuery(".search-results-box").html('').html(data).fadeIn(400);
                    jQuery('#head_search form').addClass('sc_open');
                });
            } else {
                jQuery(".search-results-box").html('').fadeOut(400);
            }
        });

        jQuery(".flex-control-thumbs").addClass('owl-carousel');
        jQuery('.flex-control-thumbs').owlCarousel({
            rtl: true,
            nav: true,
            dots: false,
            touchDrag: false,
            mouseDrag: false,
            margin: 15,
            stagePadding: 10,
            autoplay: false,
            //smartSpeed: 1000,
            navText: ["<i class='icon-chevron-thin-right'></i>", "<i class='icon-chevron-thin-left'></i>"],
            responsive: {
                0: {
                    items: 2,
                },
                576: {
                    items: 3,
                }
            }
        });


    });

    /*  JS For Gallery */
    if (jQuery('.owl-gallery').length > 0) {
        jQuery('.page_lightgallery').lightGallery({
            thumbnail: true,
            selector: '.gallery_item a',
            subHtmlSelectorRelative: true
        });
    }

    /* JS for ALL sidebar */
    jQuery('.cat-item .children').slideUp();
    jQuery(".cat-item ").children('.children').after("<span class='caticon'></span>");
    jQuery(".children").parent().addClass("cat-parent");
    jQuery(".cat-parent .caticon").each(function (index) {
        jQuery(this).on("click", function () {
            jQuery(this).toggleClass('active');
            jQuery(this).siblings(".children").slideToggle(300);
        });
    });
    jQuery(".filter-container").on("click", function () {
        jQuery(this).siblings("#sidebar").toggleClass('active')
    });
    jQuery("#sidebar").on("click", '.sidebar-close', function () {
        jQuery(this).parent("#sidebar").toggleClass('active')
    });
    // setup fields
}(jQuery));

function refreshCaptcha() {
    var img = document.images['captchaimg'];
    img.src = img.src.substring(0, img.src.lastIndexOf("?")) + "?rand=" + new Date().getTime();
}

