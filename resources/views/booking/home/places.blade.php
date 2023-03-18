<section class="tab-section">
    <div class="container-fluid">
        <div class="section-title">
            <h2>سالن های حوزه هنری </h2>
            <p>لورم ایپسوم ساختار چاپ و متن را در بر می گیرد. لورم ایپسوم استاندارد صنعت بوده است. لورم ایپسوم چاپ و
                متن را در بر می گیرد. لورم ایپسوم استاندارد صنعت بوده است.</p>
        </div>

        <div class="row align-items-center bg-style">
            <div class="col-lg-6 p-0">
                <div class="tab-video">
                    <div class="video-btn">
                        <a href="https://www.youtube.com/watch?v=dEkqfPc88LU" class="popup-youtube">
                            <i class="flaticon-play-button"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 ">
                <div class="tab tab-style-area">
                    <ul class="tabs-work">
                        @foreach($places as $place)
                            <li>
                                <a href="{{route('single.place',['id'=>$place->id])}}">{{$place->name}}</a>
                            </li>
                        @endforeach
                    </ul>

                    <div class="tab_content">
                        @foreach($places as $place)
                            <div class="tabs_item">
                                <div class="tab-inner-content">
                                {!! $place->desc !!}
                                    <div class="tab-btn">
                                        <a href="{{route('single.place',['id'=>$place->id])}}" class="button">بیشتر بدانید</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
