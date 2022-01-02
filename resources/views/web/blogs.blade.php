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
                        <li><a href="#">{{ __('links.home') }}</a></li>
                        <li>{{ __('links.blog') }}</li>

                    </ul>
                </div>
                <h1> {{ __('links.blog') }} &amp; {{ __('links.news') }}</h1>
            </div>
            <!-- /page_header -->
            <div class="row">
                <div class="col-lg-9">
                    <div class="widget search_blog d-block d-sm-block d-md-block d-lg-none">
                        <div class="form-group">
                            <input type="text" name="search" id="search" class="form-control" placeholder="Search..">
                            <button type="submit"><i class="ti-search"></i></button>
                        </div>
                    </div>
                    <!-- /widget -->

                    <div id="table_data">

                        @include('web.blogList')



                    </div>
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
                                        <a href="#0"><img src="{{ asset('uploads/blogs') }}/{{ $latest->img }}"
                                                alt=""></a>
                                    </div>
                                    <small>
                                        @if (LaravelLocalization::getCurrentLocale() === 'en')
                                            {{ $latest->en_title }}
                                        @else
                                            {{ $latest->ar_title }}
                                        @endif
                                    </small>
                                    <h3><a href="#" title="">
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
                                <li><a href="#"> @if (LaravelLocalization::getCurrentLocale() === 'en')
                                    {{ $category->en_name }}
                                @else
                                    {{ $category->ar_name }} <span>({{ $count }})</span></a></li>
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
{{-- @foreach ($blogs as $blog)
@foreach ($blog->tag->distinct() as $tag)
<a href="#">@if (LaravelLocalization::getCurrentLocale() === 'en')
    {{ $tag->en_name }}
@else
    {{ $tag->ar_name }}
@endif </a>
@endforeach
@endforeach --}}
                            {{-- <a href="#">Food</a>
                            <a href="#">Bars</a>
                            <a href="#">Cooktails</a>
                            <a href="#">Shops</a>
                            <a href="#">Best Offers</a>
                            <a href="#">Transports</a>
                            <a href="#">Restaurants</a> --}}
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
@section('scripts')
    <script>
        $(document).ready(function() {

            $(document).on('click', '.pagination a', function(event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                fetch_data(page);
            });

            function fetch_data(page) {
                $.ajax({
                    url: "/blogs/fetch_data?page=" + page,
                    success: function(data) {
                        $('#table_data').html(data);
                    }
                });
            }

        });
    </script>
@endsection
