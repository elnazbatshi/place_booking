@extends('booking.layouts.master')
@section('content')
    <section class="page-banner">
        <div class="container">
            @if(request()->tags)
                <p><a href="{{route('site.index')}}">صفحه اصلی</a>/ کلید واژه {{request()->tags}} </p>
            @else
                <p><a href="{{route('site.index')}}">صفحه اصلی</a> /  تالارها</p>
            @endif
            <div class="page-banner-content">
                @if(request()->tags)
                    <h2> #{{request()->tags}}</h2>
                @else
                    @if(request()->category)
                        <h2>همه سالن ها</h2>
                    @else
                        <h2>{{request()->category}}</h2>
                    @endif

                @endif
            </div>
        </div>
    </section>
    <div class="blog-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="blog-sidebar">
                        @if(!request()->tags)
                            <div class="widget widget_categories">
                                <h3 class="title">دسته بندی ها</h3>
                                <ul>
                                    <li>
                                        <a class="{{(request()->category==NULL)?'color-title' : "" }}"
                                           href="{{route('archive.place')}}">همه ی تالار ها</a>
                                    </li>
                                    @foreach($categories as $category)
                                        <li>
                                            <a class="{{(request()->category==$category->id)?'color-title' : "" }}"
                                               href="{{route('archive.place',$category->id)}}">{{$category->title}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="widget widget_tags">
                                <h3 class="title">برچسب ها</h3>
                                <ul>

                                    @foreach($allTags as $tag)
                                        @if($tag!==null)
                                        <li>
                                            <a href="{{route('site.archive.tag',['tags'=>$tag])}}">{{$tag}}</a>
                                        </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
                @if(request()->tags)
                <div class="col-lg-12">
                    @else
                        <div class="col-lg-9">
                    @endif
                    <div class="row">

                        @foreach($places as $place)
                            <div class="col-lg-4 col-md-6">
                                <div class="single_blog">
                                    <div class="blog-image">
                                        <a href="#">
                                            <img src="{{$place->image[0]}}" alt="">
                                        </a>
                                    </div>
                                    <div class="blog-item">
                                        <a href="{{route('single.place',$place->id)}}"><h3>{{$place->name}}</h3></a>
                                        <a href="{{route('single.place',$place->id)}}" class="button">مشاهده بیشتر</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
{{--                    @include('booking.parcial.pagination')--}}
                </div>

            </div>
        </div>
    </div>
@endsection
