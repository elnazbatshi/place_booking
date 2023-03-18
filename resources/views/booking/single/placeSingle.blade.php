@extends('booking.layouts.master')
@section('script')
    <script>

        @if(session()->has('set_order'))
            toastr["success"]('{{session()->get('set_order')}}');
        @endif
        $('.owl-single-image').owlCarousel({
            loop: true,
            autoplay: false,
            nav: true,
            rtl: true,
            center: true,
            margin: 30,
            smartSpeed: 1000,
            mouseDrag: true,
            autoplayHoverPause: true,
            responsiveClass: true,
            dots: true,
            navText: ["<i class='flaticon-left-arrow-key'></i>", "<i class='flaticon-keyboard-right-arrow-button'></i>"],
            navText: ["<i class='flaticon-left-arrow-key'></i>", "<i class='flaticon-keyboard-right-arrow-button'></i>"],
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
    </script>

@endsection
@section('content')

    <!-- Page banner -->
    <section class="page-banner">
        <div class="container">
            <div class=" d-flex justify-content-between">

                <p><a href="{{route('site.index')}}">صفحه اصلی</a> /{{$place->name}}</p>

            </div>
        </div>
    </section>
    <!-- End Page banner -->
    <!-- Blog section -->
    <div class="blog-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="blog-details">

                        <div class="owl-carousel   owl-single-image">
                            @foreach($place->image as $image)
                                <div class="item">
                                    <img src="{{$image}}" alt="">
                                </div>
                            @endforeach
                        </div>

                        <div class="blog-details-content">
                            <div class="d-flex justify-content-between">
                                <h3 class="heading">{{$place->name}}</h3>
                                <a href="{{route('panel.setOrder',['hall'=>$place->id])}}" class="button btn-h">رزو سالن</a>
                            </div>

                            <ul class="blog-list">
                                <li>
                                    <a href="#">
                                        <i class="icofont-user-alt-4"></i>
                                        {{$place->categories->title}}
                                    </a>
                                </li>
                                <li>
                                    <i class="icofont-calendar"></i>
                                    <span>
                                          <span>نفر</span>
                                        <span>{{$place->index}}</span>
                                     </span>
                                </li>
                            </ul>

                            <div class="blog-details-text">
                                {!! $place->desc !!}
                            </div>

                            <div class="post-tag-media">
                                <ul class="tag">
                                    <li><span>برچسب ها:</span></li>

                                    @if($place->tags)
                                    @foreach($place->tags as $tag)
                                        <li>
                                            <a href="{{route('site.archive.tag',['tags'=>$tag])}}"># {{$tag}}</a>
                                        </li>
                                    @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <section class="testimonials-section pt-0">
                            <div class="container">
                                <div class="section-title">
                                    <h2>گالری عکس ها</h2>
                                </div>
                                <div class="testimonials-slider">
                                    @foreach($place->files as $img)
                                        <div class="single_blog">
                                            <div class="blog-image">
                                                <a>
                                                    <img src="{{$img}}" alt="">
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </section>
                        <section class="testimonials-section pt-0">
                            <div class="container">
                                <div class="section-title">
                                    <h2>تالار های مشابه</h2>
                                </div>
                                <div class="testimonials-slider">
                                    @foreach($related_loc as $r_loc)
                                        <div class="single_blog">
                                            <div class="blog-image">
                                                <a href="{{route('single.place',$r_loc->id)}}">
                                                    <img src="{{$r_loc->image[0]}}" alt="">
                                                </a>
                                            </div>
                                            <div class="blog-item">
                                                <a href="{{route('single.place',$r_loc->id)}}"><h3>{{$r_loc->name}}</h3>
                                                </a>
                                                <a href="{{route('single.place',$r_loc->id)}}" class="button">مشاهده
                                                    بیشتر</a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Blog section -->
@endsection
