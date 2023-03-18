<section class="gallery-section">
    <div class="container">
        <div class="section-title">
            <h2>گالری عکس</h2>
        </div>
        <ul class="filter-menu">
            <li class="filter active" data-filter="all">همه</li>
            @foreach($categories as $place)

                <li class="filter" data-filter=".hall_{{$place->id}}"> {{$place->title}}</li>
                {{--            <li class="filter" data-filter=".kitchen">رستوران</li>--}}
            @endforeach
        </ul>

        <div id="Container" class="row">
            @foreach($places as $place)

                <div class="col-lg-4 col-sm-6 mix hall_{{$place->categories->id}}">

                    <div class="single-work">
                        <div class="work-image">
                            <img src="{{$place->image[0]}}" alt="gallery">
                            <a href="{{route('single.place',['id'=>$place->id])}}"
                               class="popup-btn">{{$place->name}}</a>
                        </div>
                    </div>

                </div>

            @endforeach


        </div>
{{--        <div class="gallery-btn">--}}
{{--            <a href="#" class="button">مشاهده بیشتر</a>--}}
{{--        </div>--}}
    </div>
</section>
