<section class="about-section">
    <div class="container">
        <div class="section-title">
            <h2>درباره ما</h2>
            <p>{{$aboutUs->name}}</p>
        </div>

        <div class="row align-items-center">
            <div class="col-xl-6 col-lg-12">
                <div class="about-content">
{{--                    <div class="about-text">--}}
{{--                        <i class="icofont-star"></i>--}}
{{--                        <h4>موقعیت مکانی</h4>--}}
{{--                        <p>لورم ایپسوم به سادگی ساختار چاپ و متن را در بر می گیرد. لورم ایپسوم به مدت 40 سال استاندارد--}}
{{--                            صنعت بوده است.</p>--}}
{{--                    </div>--}}

                    {!! $aboutUs->content !!}
                </div>
            </div>

            <div class="col-xl-6 col-lg-12">
                <div class="property-slider">
                    @foreach(explode(',',$aboutUs->img_src) as $img)
                        <div class="item">
                            <img src="{{$img}}">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
