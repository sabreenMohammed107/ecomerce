@extends('layout.web.web')
@section('style')
<!-- SPECIFIC CSS -->
<link href="{{asset('comassets/css/home_1.css')}}" rel="stylesheet">
@endsection
@section('content')
    <main>
        <div id="carousel-home">
            <div class="owl-carousel owl-theme">
                @foreach ($homeSliders as $slide)
                    <div class="owl-slide cover"
                        style="background-image: url({{ asset('uploads/home_sliders') }}/{{ $slide->image }});">
                        <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                            <div class="container">
                                <div class="row justify-content-center justify-content-md-end">
                                    <div class="col-lg-6 static">
                                        <div class="slide-text text-end white">
                                            <h2 class="owl-slide-animated owl-slide-title">

                                                @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                    {{ $slide->en_title }}
                                                @else
                                                    {{ $slide->ar_title }}
                                                @endif
                                            </h2>
                                            <p class="owl-slide-animated owl-slide-subtitle">
                                                @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                    {!! $slide->en_text !!}
                                                @else
                                                    {!! $slide->ar_text !!}
                                                @endif
                                            </p>
                                            <div class="owl-slide-animated owl-slide-cta">
                                                <a class="btn_1" @if ($slide->category_id)
                                                    href="{{ LaravelLocalization::localizeUrl('/products/' . $slide->category_id) }}"
                                                @else
                                                    href="{{ LaravelLocalization::localizeUrl('/single-product/'.$slide->product_id) }}"
                @endif
                role="button">
                {{ __('links.shop_now') }}</a>
            </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        @endforeach


        </div>
        <div id="icon_drag_mobile"></div>
        </div>
        <!--/carousel-->

        <div class="container margin_60_35">
            <div class="main_title">
                <h2>{{ __('links.categories') }}</h2>
                <span>{{ __('links.categories') }}</span>

            </div>

            <div class="cleaner-h2"></div>
            <div class="row">
                @foreach ($categories as $category)
                    <div class="col-lg-2 col-md-2 col-xl-3">
                        <div class="gemy-item">
                            @forelse ($category->images as $img)
                                <a href="{{ LaravelLocalization::localizeUrl('/products/'.$category->id) }}"> <img src="{{ asset('uploads/attachment') }}/{{ $img->img }}"
                                        class="img-fluid" /></a>
                            @break
                            @empty
                                {{-- If for some reason the business has no images, you can put here some kind of placeholder image, using 3rd party services or maybe your own generic image --}}
                                <img src="//via.placeholder.com/150x150" alt="" class="img-fluid" />
                    @endforelse

                    <a href="{{ LaravelLocalization::localizeUrl('/products/'.$category->id) }}">
                        <h3>@if (LaravelLocalization::getCurrentLocale() === 'en')
                                {{ $category->en_name }}
                            @else
                                {{ $category->ar_name }}
                            @endif
                        </h3>
                    </a>


                </div>
                <!--end grid-item-->
            </div>
            <!--end col-2-->

            @endforeach

            </div>
            <!--end rows-->
            </div>
            <!--end conatiner-->


            <!--/banners_grid -->

            <div class="container margin_60_35">
                <div class="main_title">
                    <h2>{{ __('links.latest_product') }}</h2>
                    <span>{{ __('links.products') }}</span>

                </div>

                <div class="cleaner-h2"></div>

                <div class="row small-gutters">
                    @foreach ($latestProduct as $latest)
                    <div class="col-6 col-md-4 col-xl-3">

                        <div class="grid_item">
                            <figure>
                                <a href="{{ LaravelLocalization::localizeUrl('/single-product/'.$latest->id) }}">

<a href="{{ LaravelLocalization::localizeUrl('/single-product/'.$latest->id) }}"> <img src="{{ asset('uploads/attachment') }}/{{$latest->images['img']}}"
        class="img-fluid lazy"  data-src="{{ asset('uploads/attachment') }}/{{$latest->images['img']}}" alt="{{ asset('uploads/attachment') }}/{{$latest->images['img']}}"/></a>
        <img class="img-fluid lazy" src="{{ asset('webassetsimg/products/product_placeholder_square_medium.jpg')}}"
        data-src="{{ asset('webassetsimg/products/shoes/1_b.jpg')}}" alt="">




                                </a>

                            </figure>
                            <div class="rating">
                                @foreach (range(1, 5) as $i)

                @if ($latest->avgRating() >= $i)
                <i class="icon-star voted"></i>
                @else
                <i class="icon-star"></i>
                @endif
                @endforeach

                            </div>
                            <a href="{{ LaravelLocalization::localizeUrl('/single-product/'.$latest->id) }}">
                                <h3>@if (LaravelLocalization::getCurrentLocale() === 'en')
                                    {{ $latest->en_name }}
                                @else
                                    {{ $latest->ar_name }}
                                @endif</h3>
                            </a>
                            <div class="price_box">
                                <span class="new_price"> {{ $latest->price_after_discount }}</span>
                                <span class="old_price"> @if($latest->discount)
                                    {{ $latest->price }}
                                @endif</span>
                            </div>
                            <ul>
                                <li>

                                        <form id="myfavForm" action="{{ LaravelLocalization::localizeUrl('/add-to-fav') }}" method="post">

                                            @csrf
                                            <input type="hidden" name="fav_id" value="{{$latest->id}}" >
                                            <input type="hidden" name="client_id" value="{{ Auth::user()->id }}">


                                            <a
                                            onclick="this.closest('form').submit();return false;"  class="tooltip-1" data-bs-toggle="tooltip"
                                                data-bs-placement="left"  title="{{ __('links.add_favorites') }}{{$latest->id}}"><i class="ti-heart"></i><span>{{$latest->id}}{{ __('links.add_favorites') }}</span></a>

                                    </form>
                                    </li>
                                <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left"
                                        title="{{ __('links.share_product') }}"><i class="ti-control-shuffle"></i><span>{{ __('links.share_product') }}</span></a>
                                </li>
                                @if(Auth::user())
                                <li>
                                    <form id="mycardForm" action="{{ LaravelLocalization::localizeUrl('/add-to-my-cart') }}" method="post">

                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $latest->id }}">
                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                        <a
                                            onclick="document.getElementById('mycardForm').submit();" class="tooltip-1" data-bs-toggle="tooltip"
                                            data-bs-placement="left" title="{{ __('links.add_cart') }}"><i
                                                class="ti-shopping-cart"></i><span></span></a>

                                </form>
                                    </li>
                            @endif
                                    </ul>
                        </div>
                        <!-- /grid_item -->
                    </div>
                    @endforeach

                </div>
                <!-- /row -->
            </div>
            <!-- /container -->


            <div class="featured lazy" data-bg="url({{asset('comassets/img/featured_home.jpg')}});" data-was-processed="true" style="background-image: url({{asset('comassets/img/featured_home.jpg')}});"
            >
                <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.5)" style="background-color: rgba(0, 0, 0, 0.5);">
                    <div class="container margin_60">
                        <div class="row justify-content-center justify-content-md-start">
                            <div class="col-lg-12 wow animated" data-wow-offset="150" style="visibility: visible;">

                               <a href="https://apps.apple.com/us/app/shesure/id1612969554"><img class="img-store first-store" src="{{asset('comassets/img/apple-store-logo-png-1-transparent.png')}}"></a>
                               <a href="https://play.google.com/store/apps/details?id=com.shesure.clothesapp"><img class="img-store" src="{{asset('comassets/img/get-it-on-google-play-badge-png-use-unwanted-payg-sim-credit-to-pay-for-apps-on-google-play-gadgetz-tv-2357.png')}}"></a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /featured -->

            <div class="container margin_60_35">
                <div class="main_title">
                    <h2>{{ __('links.latest_offers') }}</h2>
                    <span>{{ __('links.products') }}</span>

                </div>

                <div class="cleaner-h2"></div>

                <div class="owl-carousel owl-theme products_carousel">
                    @foreach ($offers as $offer)

                    <div class="item">

                        <div class="grid_item">

                            <figure>
                                <a href="{{ LaravelLocalization::localizeUrl('/single-product/'.$offer->id) }}">
                                    <a href="{{ LaravelLocalization::localizeUrl('/single-product/'.$offer->id) }}"> <img src="{{ asset('uploads/attachment') }}/{{$offer->images['img']}}"
                                        class="owl-lazy"  data-src="{{ asset('uploads/attachment') }}/{{$offer->images['img']}}" alt="{{ asset('uploads/attachment') }}/{{$offer->images['img']}}"/></a>


                                    {{-- <img class="owl-lazy" src="img/products/product_placeholder_square_medium.jpg"
                                        data-src="img/products/shoes/4.jpg" alt=""> --}}
                                </a>
                            </figure>
                            <div class="rating"> @foreach (range(1, 5) as $i)

                                @if ($offer->avgRating() >= $i)
                                <i class="icon-star voted"></i>
                                @else
                                <i class="icon-star"></i>
                                @endif
                                @endforeach </div>
                            <a href="{{ LaravelLocalization::localizeUrl('/single-product/'.$offer->id) }}">
                                <h3>@if (LaravelLocalization::getCurrentLocale() === 'en')
                                    {{ $offer->en_name }}
                                @else
                                    {{ $offer->ar_name }}
                                @endif</h3>
                            </a>
                            <div class="price_box">
                                <span class="new_price">{{ $offer->price_after_discount }}</span>
                            </div>
                            <ul>
                                <li><form id="myfavForm" action="{{ LaravelLocalization::localizeUrl('/add-to-my-fav') }}" method="post">

                                    @csrf
                                    <input type="hidden" name="fav_id" value="{{ $offer->id }}">
                                    <input type="hidden" name="client_id" value="{{ Auth::user()->id }}">
                                    <a
                                    onclick="this.closest('form').submit();return false;" class="tooltip-1" data-bs-toggle="tooltip"
                                        data-bs-placement="left"  title="{{ __('links.add_favorites') }}"><i class="ti-heart"></i><span>{{ __('links.add_favorites') }}</span></a>

                            </form>
                        </li>
                                <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left"
                                        title="{{ __('links.share_product') }}"><i class="ti-control-shuffle"></i><span>{{ __('links.share_product') }}</span></a></li>
                                        @if(Auth::user())
                                        <li><form id="mycardForm" action="{{ LaravelLocalization::localizeUrl('/add-to-my-cart') }}" method="post">
                                            {{-- <form id="mycardForm" action="#" method="post" > --}}
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $offer->id }}">
                                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                            <a
                                                onclick="document.getElementById('mycardForm').submit();" class="tooltip-1" data-bs-toggle="tooltip"
                                                data-bs-placement="left" title="{{ __('links.add_cart') }}"><i
                                                    class="ti-shopping-cart"></i><span></span></a>

                                    </form></li>
                           @endif
                                    </ul>
                        </div>
                        <!-- /grid_item -->
                    </div>
                    @endforeach

                </div>
                <!-- /products_carousel -->
            </div>
            <!-- /container -->


            <div class="bg_gray">
                <div class="container margin_60_35">
                    <div class="main_title">
                        <h2>{{ __('links.latest_News') }}</h2>
                        <span>{{ __('links.blog') }}</span>

                    </div>

                    <div class="cleaner-h3"></div>
                    <div class="row">
                        @foreach ($blogs as $blog)
                        <div class="col-lg-6">
                            <a class="box_news" href="blog.html">
                                <figure>
                                    <img src="{{ asset('uploads/blogs') }}/{{$blog->img}}" data-src="{{ asset('uploads/blogs') }}/{{$blog->img}}" alt="" width="400"
                                        height="266" class="lazy">

                                </figure>

                                <h4>@if (LaravelLocalization::getCurrentLocale() === 'en')
                                    {{ $blog->en_title }}
                                @else
                                    {{ $blog->ar_title }}
                                @endif</h4>
                                @if (LaravelLocalization::getCurrentLocale() === 'en')
                                <p style="text-align: left !important">
                                    {!! Illuminate\Support\Str::limit(strip_tags($blog->en_text ?? ''), $limit = 100, $end = '')!!}
                                </p>
                                    @else
                                <p style="text-align: right !important"> {!! Illuminate\Support\Str::limit(strip_tags($blog->ar_text ?? ''), $limit = 100, $end = '')!!}
                                @endif</p>
                            </a>
                        </div>
                        @endforeach

                        <!-- /box_news -->

                    </div>
                    <!-- /row -->
                </div>
                <!-- /container -->
            </div>
            <!--end bg-gray-->
        </main>
        <!-- /main -->

    @endsection
    @section('scripts')
    <script src="{{ asset('comassets/js/carousel-home.min.js')}}"></script>
    @endsection

