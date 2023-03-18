@extends('andishkade.layouts.master')
@section('script')

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCzcEM8z2_imGO8TMRmJEpDEahvZ7KYY_U"></script>
    <script>
        function init() {
            var mapOptions = {
                zoom: 11,
                scrollwheel: false,
                center: new google.maps.LatLng(35.702437, 51.395817),
                styles: [{
                    "featureType": "water",
                    "elementType": "geometry",
                    "stylers": [{
                        "color": "#e9e9e9"
                    }, {
                        "lightness": 17
                    }]
                }, {
                    "featureType": "landscape",
                    "elementType": "geometry",
                    "stylers": [{
                        "color": "#f5f5f5"
                    }, {
                        "lightness": 20
                    }]
                }, {
                    "featureType": "road.highway",
                    "elementType": "geometry.fill",
                    "stylers": [{
                        "color": "#ffffff"
                    }, {
                        "lightness": 17
                    }]
                }, {
                    "featureType": "road.highway",
                    "elementType": "geometry.stroke",
                    "stylers": [{
                        "color": "#ffffff"
                    }, {
                        "lightness": 29
                    }, {
                        "weight": 0.2
                    }]
                }, {
                    "featureType": "road.arterial",
                    "elementType": "geometry",
                    "stylers": [{
                        "color": "#ffffff"
                    }, {
                        "lightness": 18
                    }]
                }, {
                    "featureType": "road.local",
                    "elementType": "geometry",
                    "stylers": [{
                        "color": "#ffffff"
                    }, {
                        "lightness": 16
                    }]
                }, {
                    "featureType": "poi",
                    "elementType": "geometry",
                    "stylers": [{
                        "color": "#f5f5f5"
                    }, {
                        "lightness": 21
                    }]
                }, {
                    "featureType": "poi.park",
                    "elementType": "geometry",
                    "stylers": [{
                        "color": "#dedede"
                    }, {
                        "lightness": 21
                    }]
                }, {
                    "elementType": "labels.text.stroke",
                    "stylers": [{
                        "visibility": "on"
                    }, {
                        "color": "#ffffff"
                    }, {
                        "lightness": 16
                    }]
                }, {
                    "elementType": "labels.text.fill",
                    "stylers": [{
                        "saturation": 36
                    }, {
                        "color": "#333333"
                    }, {
                        "lightness": 40
                    }]
                }, {
                    "elementType": "labels.icon",
                    "stylers": [{
                        "visibility": "off"
                    }]
                }, {
                    "featureType": "transit",
                    "elementType": "geometry",
                    "stylers": [{
                        "color": "#f2f2f2"
                    }, {
                        "lightness": 19
                    }]
                }, {
                    "featureType": "administrative",
                    "elementType": "geometry.fill",
                    "stylers": [{
                        "color": "#fefefe"
                    }, {
                        "lightness": 20
                    }]
                }, {
                    "featureType": "administrative",
                    "elementType": "geometry.stroke",
                    "stylers": [{
                        "color": "#fefefe"
                    }, {
                        "lightness": 17
                    }, {
                        "weight": 1.2
                    }]
                }]
            };
            var mapElement = document.getElementById('map');
            var map = new google.maps.Map(mapElement, mapOptions);
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(40.709896, -73.995481),
                map: map,
                icon: 'assetsFront/img/icon-img/2.png',
                animation: google.maps.Animation.BOUNCE,
                title: 'Snazzy!'
            });
        }

        google.maps.event.addDomListener(window, 'load', init);
    </script>
@endsection
@section('contact')

    <div class="breadcrumb-area">
        <div class="breadcrumb-top default-overlay bg-img breadcrumb-overly-5 pt-100 pb-95"
             style="background-image:url(assetsFront/img/bg/breadcrumb-bg-6.jpg);">
            <div class="container">
                <h2>تماس با ما</h2>
            </div>
        </div>
        <div class="breadcrumb-bottom">
            <div class="container">
                <ul>
                    <li><a href="#">خانه</a> <span><i class="fa fa-angle-double-left"></i>تماس با ما</span></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="contact-area pt-130 pb-130">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="contact-map ml-70">
                        <div id="map"></div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="contact-form">
                        <div class="contact-title mb-45">
                            <h2> با ما <span>در ارتباط باشید</span></h2>

                        </div>
                        <form id="contact-form" action="assetsFront/php/mail.php" method="post">
                            <input name="name" placeholder="نام*" type="text">
                            <input name="email" placeholder="ایمیل*" type="email">
                            <input name="subject" placeholder="موضوع*" type="text">
                            <textarea name="message" placeholder="پیام"></textarea>
                            <button class="submit btn-style" type="submit">ارسال پیام</button>
                        </form>
                        <p class="form-messege"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="contact-info-area bg-img pt-180 pb-140 default-overlay"
         style="background-image:url(assetsFront/img/bg/contact-info.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-12">
                    <div class="single-contact-info mb-30 text-center">
                        <div class="contact-info-icon">
                            <span><i class="fa fa-calendar-o"></i></span>
                        </div>
                        <p>تهران، شرکت پژوهشگران جوان
                            <br> روبه روی سایت Yellow</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-12">
                    <div class="single-contact-info mb-30 text-center">
                        <div class="contact-info-icon">
                            <span><i class="fa fa-calendar-o"></i></span>
                        </div>
                        <div class="contact-info-phn">
                            <div class="info-phn-title">
                                <span>تلفن تماس : </span>
                            </div>
                            <div class="info-phn-number">
                                <p>+۰۹۱۱۱۱۱۱۱۱۱</p>
                                <p>+۰۹۱۱۱۱۱۱۱۱۱</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-12">
                    <div class="single-contact-info mb-30 text-center">
                        <div class="contact-info-icon">
                            <span><i class="fa fa-calendar-o"></i></span>
                        </div>
                        <a href="#">education@email.com</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
