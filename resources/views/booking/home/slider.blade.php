@foreach($mainSlider as $slide)
    <div class="main-banner" style="background-image:url({{ asset($slide->img_src) }});">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="hero-slider-content">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="get-appointment-form">
                                <h1>{{$slide->title}}</h1>
                                {!! $slide->content !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
