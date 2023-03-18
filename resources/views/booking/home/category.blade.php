<div class="partner-section">
    <div class="container">
        <div class="section-title">
            <h2>دسته بندی</h2>

        </div>

        <div class="partner-slider owl-carousel owl-theme">
            @foreach($categories as $category)
                <div class="partner-item">
                    <a href="{{route('archive.place',['category'=>$category->id])}}"><img src="{{$category->img_src}}" alt="partner"></a>
                    <h1>{{$category->title}}</h1>
                </div>
            @endforeach
        </div>
    </div>
</div>
