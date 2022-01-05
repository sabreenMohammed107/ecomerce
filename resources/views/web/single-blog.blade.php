@extends('layout.web.web')
@section('style')

    <!-- SPECIFIC CSS -->
    <link href="{{ asset('comassets/css/blog.css') }}" rel="stylesheet">
@endsection
@section('content')
    <main class="bg_gray">
        <div class="container margin_30">
            <div class="page_header">
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="{{ LaravelLocalization::localizeUrl('/') }}">{{ __('links.home') }}</a></li>
                        <li><a href="{{ LaravelLocalization::localizeUrl('/blogs') }}">{{ __('links.blog') }}</a></li>
                        <li> @if (LaravelLocalization::getCurrentLocale() === 'en')
                            {{ $blog->en_title }}
                        @else
                            {{ $blog->ar_title }}
                        @endif</li>
                    </ul>
                </div>
            </div>
            <!-- /page_header -->
            <div class="row">
                <div class="col-lg-9">
                    <div class="singlepost">
                        <figure><img alt="{{ asset('uploads/blogs') }}/{{$blog->img}}" class="img-fluid w-100" style="height: 350px" src="{{ asset('uploads/blogs') }}/{{$blog->img}}">
                        </figure>
                        <h1> @if (LaravelLocalization::getCurrentLocale() === 'en')
                            {{ $blog->en_title }}
                        @else
                            {{ $blog->ar_title }}
                        @endif</h1>

                        <!-- /post meta -->
                        <div class="post-content">
                            {{-- <div class="dropcaps"> --}}
                                @if (LaravelLocalization::getCurrentLocale() === 'en')
                                {!!$blog->en_text !!}
                            @else
                            {!!$blog->ar_text !!}
                            @endif
                           {{-- </div> --}}


                        </div>
                        <!-- /post -->
                    </div>
                    <!-- /single-post -->





                </div>
                <!-- /col -->


                <aside class="col-lg-3">
                    <div class="widget search_blog d-none d-sm-none d-md-none d-lg-block">
                        <div class="form-group">
                            <input type="text" name="search" id="search_blog" class="form-control" placeholder="Search..">
                            <button type="submit"><i class="ti-search"></i></button>
                        </div>
                    </div>
                    <!-- /widget -->
                    <div class="widget">
                        <div class="widget-title">
                            <h4>{{ __('links.latest_News') }}</h4>
                        </div>
                        <ul class="comments-list">
                            @foreach ($latestPosts as $latest)
                                <li>
                                    <div class="alignleft">
                                        <a
                                            href="{{ LaravelLocalization::localizeUrl('/single-blog/' . $latest->id . '/' . $latest->slug) }}"><img
                                                src="{{ asset('uploads/blogs') }}/{{ $latest->img }}" alt=""></a>
                                    </div>
                                    <small>
                                        @if (LaravelLocalization::getCurrentLocale() === 'en')
                                            {{ $latest->en_title }}
                                        @else
                                            {{ $latest->ar_title }}
                                        @endif
                                    </small>
                                    <h3><a href="{{ LaravelLocalization::localizeUrl('/single-blog/' . $latest->id . '/' . $latest->slug) }}"
                                            title="">
                                            @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                {{ Illuminate\Support\Str::limit(strip_tags($latest->en_text ?? ''), $limit = 50, $end = '...') }}
                                            @else
                                                {{ Illuminate\Support\Str::limit(strip_tags($latest->ar_text ?? ''), $limit = 50, $end = '...') }}
                                            @endif
                                        </a></h3>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- /widget -->
                    <div class="widget">
                        <div class="widget-title">
                            <h4>{{ __('links.categories') }}</h4>
                        </div>
                        <ul class="cats">
                            @foreach ($categories as $category)
                                <?php
                                $products = App\Models\Product::where('category_id', $category->id)->get();
                                $count = $products->count();
                                ?>
                                <li><a href="#">
                                        @if (LaravelLocalization::getCurrentLocale() === 'en')
                                            {{ $category->en_name }}
                                        @else
                                            {{ $category->ar_name }} <span>({{ $count }})</span>
                                    </a></li>
                            @endif
                            @endforeach

                        </ul>
                    </div>
                    <!-- /widget -->
                    <div class="widget">
                        <div class="widget-title">
                            <h4>{{ __('links.pop_tags') }}</h4>
                        </div>
                        <div class="tags">
                            @foreach ($tags as $tag)
                            @if(in_array($tag->id, $BlogTags))
                             <a href="#">@if (LaravelLocalization::getCurrentLocale() === 'en')
                                {{ $tag->en_name }}
                            @else
                                {{ $tag->ar_name }}
                            @endif
                        @endif </a>
                            @endforeach
                        </div>
                    </div>
                    <!-- /widget -->
                </aside>

                <!-- /aside -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </main>
    <!--/main-->
@endsection
