@extends('layout.web.web')
@section('style')
    <!-- SPECIFIC CSS -->
    <link href="{{ asset('comassets/css/product_page.css') }}" rel="stylesheet">
@endsection
@section('content')
    <main>
        <div class="container margin_30">
            <div class="row">
                <div class="col-md-6">
                    <div class="all">
                        <div class="slider">
                            <div class="owl-carousel owl-theme main">
                                @isset($row->images)
                                    @foreach ($row->images as $key => $img)
                                        <div style="background-image: url({{ asset('uploads/attachment')}}/{{$img->img}});"
                                            class="item-box"></div>
                                    @endforeach
                                @endisset



                            </div>
                            <div class="left nonl"><i class="ti-angle-left"></i></div>
                            <div class="right"><i class="ti-angle-right"></i></div>
                        </div>
                        <div class="slider-two">
                            <div class="owl-carousel owl-theme thumbs">
                                @isset($row->images)
                                    @foreach ($row->images as $key => $img)
                                        <div style="background-image: url({{asset('uploads/attachment')}}/{{$img->img}});"
                                            class="item {{ $key == 0 ? 'active' : '' }} "></div>
                                    @endforeach
                                @endisset


                            </div>
                            <div class="left-t nonl-t"></div>
                            <div class="right-t"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="{{ LaravelLocalization::localizeUrl('/') }}">{{ __('links.home') }}</a></li>
                            <li><a
                                    href="{{ LaravelLocalization::localizeUrl('/category') }}">{{ __('links.categories') }}</a>
                            </li>
                            {{-- <li><a href="#">Category</a></li> --}}

                        </ul>
                    </div>
                    <!-- /page_header -->
                    <div class="prod_info">
                        <form id="mycardForm" action="{{ LaravelLocalization::localizeUrl('/add-to-my-cart') }}" method="post">
                            {{-- <form id="mycardForm" action="#" method="post" > --}}
                            @csrf

                            <h1>
                                @if (LaravelLocalization::getCurrentLocale() === 'en')
                                    {{ $row->en_name ?? '' }}
                                @else
                                    {{ $row->ar_name ?? '' }}
                                @endif
                            </h1>
                            <span class="rating">
                                @foreach (range(1, 5) as $i)
                                    @if ($row->avgRating() >= $i)
                                        <i class="icon-star voted"></i>
                                    @else
                                        <i class="icon-star"></i>
                                    @endif
                                @endforeach

                                <em>{{ $row->review->count() }} {{ __('links.reviews') }}</em>
                            </span>
                            <p>
                                @if (LaravelLocalization::getCurrentLocale() === 'en')
                                    {{ Illuminate\Support\Str::limit(strip_tags($row->en_description ?? ''), $limit = 100, $end = '...') }}
                                @else
                                    {{ Illuminate\Support\Str::limit(strip_tags($row->ar_description ?? ''), $limit = 100, $end = '...') }}
                                @endif
                            </p>
                            <div class="prod_options">
                                <div class="row">
                                    <label
                                        class="col-xl-5 col-lg-5  col-md-6 col-6 pt-0"><strong>{{ __('links.color') }}</strong></label>
                                    <div class="col-xl-4 col-lg-5 col-md-6 col-6 colors">
                                        <ul>
                                            @foreach ($row->color as $key => $color)
                                                <li><a href="#0" data-category="{{ $color->id }}"
                                                        class="earch_category color" {{-- class="search_category color  {{ $key == 0 ? 'active' : '' }}" --}}
                                                        style="background-color: {{ $color->colorid }}">

                                                    </a></li>
                                            @endforeach


                                        </ul>

                                        <input type="hidden" id="category" name="product_color"
                                            @isset($row->color[0])
                                           value="{{ $row->color[0]->id }}"
                                           @endisset>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-xl-5 col-lg-5 col-md-6 col-6"><strong>{{ __('links.size') }}</strong>
                                        - {{ __('links.size_guide') }} <a href="#0" data-bs-toggle="modal"
                                            data-bs-target="#size-modal"><i class="ti-help-alt"></i></a></label>
                                    <div class="col-xl-4 col-lg-5 col-md-6 col-6">
                                        <div class="custom-select-form">
                                            <select class="wide" name="product_size">
                                                @foreach ($row->sizes as $key => $size)
                                                    <option value="{{ $size->id }}">{{ $size->ar_name }}</option>
                                                @endforeach
                                                {{-- <option value="">M</option>
                                        <option value=" ">L</option>
                                        <option value=" ">XL</option> --}}
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label
                                        class="col-xl-5 col-lg-5  col-md-6 col-6"><strong>{{ __('links.quantity') }}</strong></label>
                                    <div class="col-xl-4 col-lg-5 col-md-6 col-6">
                                        <div class="numbers-row">
                                            <input type="text" value="1" id="quantity_1" class="qty2"
                                                name="quantity">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5 col-md-6">
                                    <div class="price_main"><span class="new_price">{{ $row->price_after_discount }}</span>
                                        <span class="old_price">
                                            @if ($row->discount)
                                                {{ $row->price }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="btn_add_to_cart">
                                        @if (Auth::user())
                                            <input type="hidden" name="product_id" value="{{ $row->id }}">
                                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                            <button class="btn_1"
                                            onclick="this.closest('form').submit();return false;" >{{ __('links.add_cart') }}</button>
                                        @else
                                            {{-- <button class="btn_1" onclick="document.getElementById('mycardForm').submit();" >{{ __('links.login') }}</button> --}}
                                            <a class="btn_1" href="{{ route('user-login') }}">{{ __('links.login') }}</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /prod_info -->
                    <div class="product_actions">
                        <ul>
                            <li>
                                @if(Auth::user())
                                <form id="myfavForm" action="{{ LaravelLocalization::localizeUrl('/add-to-fav') }}" method="post">

                                @csrf
                                <input type="hidden" name="fav_id" value="{{ $row->id }}">
                                <input type="hidden" name="client_id" value="{{ Auth::user()->id }}">
                                <a
                                onclick="this.closest('form').submit();return false;" class="tooltip-1" data-bs-toggle="tooltip"
                                    data-bs-placement="left"  title="{{ __('links.add_favorites') }}"><i class="ti-heart"></i><span>{{ __('links.add_favorites') }}</span></a>

                        </form>
                        @else

                        <a
                         class="tooltip-1" data-bs-toggle="tooltip"  href="{{ route('user-login') }}"
                            data-bs-placement="left"  title="{{ __('links.add_favorites') }}"><i class="ti-heart"></i><span>{{ __('links.add_favorites') }}</span></a>
                        @endif
                    </li>
                            <li>
                                <a href="#"><i
                                        class="ti-control-shuffle"></i><span>{{ __('links.share_product') }}</span></a>
                            </li>
                        </ul>
                    </div>
                    <!-- /product_actions -->
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->

        <div class="tabs_product">
            <div class="container">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a id="tab-A" href="#pane-A" class="nav-link active" data-bs-toggle="tab"
                            role="tab">{{ __('links.description') }}</a>
                    </li>
                    <li class="nav-item">
                        <a id="tab-B" href="#pane-B" class="nav-link" data-bs-toggle="tab"
                            role="tab">{{ __('links.reviews') }}</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /tabs_product -->
        <div class="tab_content_wrapper">
            <div class="container">
                <div class="tab-content" role="tablist">
                    <div id="pane-A" class="card tab-pane fade active show" role="tabpanel" aria-labelledby="tab-A">
                        <div class="card-header" role="tab" id="heading-A">
                            <h5 class="mb-0">
                                <a class="collapsed" data-bs-toggle="collapse" href="#collapse-A" aria-expanded="false"
                                    aria-controls="collapse-A">
                                    {{ __('links.description') }}
                                </a>
                            </h5>
                        </div>
                        <div id="collapse-A" class="collapse" role="tabpanel" aria-labelledby="heading-A">
                            <div class="card-body">
                                <div class="row justify-content-between">
                                    <div class="col-lg-12">
                                        @if (LaravelLocalization::getCurrentLocale() === 'en')
                                            {!! $row->en_description !!}
                                        @else
                                            {!! $row->ar_description !!}
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /TAB A -->
                    <div id="pane-B" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-B">
                        <div class="card-header" role="tab" id="heading-B">
                            <h5 class="mb-0">
                                <a class="collapsed" data-bs-toggle="collapse" href="#collapse-B" aria-expanded="false"
                                    aria-controls="collapse-B">
                                    {{ __('links.reviews') }}
                                </a>
                            </h5>
                        </div>
                        <div id="collapse-B" class="collapse" role="tabpanel" aria-labelledby="heading-B">
                            <div class="card-body">
                                <div class="row justify-content-between">
                                    @foreach ($row->review as $key => $review)
                                        <div class="col-lg-6">
                                            <div class="review_content">
                                                <div class="clearfix add_bottom_10">
                                                    <span class="rating">
                                                        @foreach (range(1, 5) as $i)
                                                            @if ($review->rate_no >= $i)
                                                                <i class="icon-star voted"></i>
                                                            @else
                                                                {{-- <i class="icon-star"></i>x --}}
                                                            @endif
                                                        @endforeach
                                                        <em>{{ $review->rate_no }}/5.0</em>
                                                    </span>
                                                    <em>Published @if ($review->created_at)
                                                            {{ $review->created_at->diffForHumans() }}
                                                        @endif
                                                    </em>
                                                </div>

                                                <p>
                                                    {!! $review->ar_comment !!} </p>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                                <!-- /row -->

                                <p class="text-end">
                                    @if (Auth::user())
                                        <a href="{{ LaravelLocalization::localizeUrl('/leave-comment/' . $row->id) }}"
                                            class="btn_1">{{ __('links.leave_review') }}</a>
                                    @else
                                        <a class="btn_1" href="{{ route('user-login') }}">{{ __('links.login') }}</a>
                                    @endif

                                </p>
                            </div>
                            <!-- /card-body -->
                        </div>
                    </div>
                    <!-- /tab B -->
                </div>
                <!-- /tab-content -->
            </div>
            <!-- /container -->
        </div>
        <!-- /tab_content_wrapper -->

        <div class="container margin_60_35">
            <div class="main_title">
                <h2>{{ __('links.related') }}</h2>
                <span>{{ __('links.products') }}</span>
                <p>Cum doctus civibus efficiantur in imperdiet deterruisset.</p>
            </div>
            <div class="owl-carousel owl-theme products_carousel">
                @foreach ($related as $rel)
                    <div class="item">

                        <div class="grid_item">

                            <figure>
                                <a href="{{ LaravelLocalization::localizeUrl('/single-product/' . $rel->id) }}">
                                    <img class="owl-lazy"
                                        src="{{ asset('uploads/attachment') }}/{{ $rel->images[0]->img }}"
                                        data-src="{{ asset('uploads/attachment') }}/{{ $rel->images[0]->img }}"
                                        alt="">
                                </a>
                            </figure>
                            <div class="rating">
                                @foreach (range(1, 5) as $i)
                                    @if ($rel->avgRating() >= $i)
                                        <i class="icon-star voted"></i>
                                    @else
                                        <i class="icon-star"></i>
                                    @endif
                                @endforeach
                            </div>
                            <a href="{{ LaravelLocalization::localizeUrl('/single-product/' . $rel->id) }}">
                                <h3>
                                    @if (LaravelLocalization::getCurrentLocale() === 'en')
                                        {{ $rel->en_name }}
                                    @else
                                        {{ $rel->ar_name }}
                                    @endif
                                </h3>
                            </a>
                            <div class="price_box">
                                <span class="new_price">{{ $rel->price_after_discount }}</span>
                            </div>
                            <ul>
                                <li>
                                    @if(Auth::user())
                                    <form id="myfavForm" action="{{ LaravelLocalization::localizeUrl('/add-to-fav') }}" method="post">

                                    @csrf
                                    <input type="hidden" name="fav_id" value="{{ $rel->id }}">
                                    <input type="hidden" name="client_id" value="{{ Auth::user()->id }}">
                                    <a
                                    onclick="this.closest('form').submit();return false;" class="tooltip-1" data-bs-toggle="tooltip"
                                        data-bs-placement="left"  title="{{ __('links.add_favorites') }}"><i class="ti-heart"></i><span>{{ __('links.add_favorites') }}</span></a>

                            </form>
                            @else

                            <a
                             class="tooltip-1" data-bs-toggle="tooltip"  href="{{ route('user-login') }}"
                                data-bs-placement="left"  title="{{ __('links.add_favorites') }}"><i class="ti-heart"></i><span>{{ __('links.add_favorites') }}</span></a>
                            @endif
                        </li>
                                <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip"
                                        data-bs-placement="left" title="{{ __('links.share_product') }}"><i
                                            class="ti-control-shuffle"></i><span>{{ __('links.share_product') }}</span></a>
                                </li>
                                @if (Auth::user())

                                    <li>
                                        <form id="mycardForm" action="{{ LaravelLocalization::localizeUrl('/add-to-my-cart') }}" method="post">
                                            {{-- <form id="mycardForm" action="#" method="post" > --}}
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $rel->id }}">
                                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                            <a
                                            onclick="this.closest('form').submit();return false;" class="tooltip-1" data-bs-toggle="tooltip"
                                                data-bs-placement="left" title="{{ __('links.add_cart') }}"><i
                                                    class="ti-shopping-cart"></i><span></span></a>

                                    </form>
                                            </li>
                                @endif
                            </ul>
                        </div>

                        <!-- /grid_item -->
                    </div>
                    <!-- /item -->
                @endforeach
            </div>
            <!-- /products_carousel -->
        </div>
        <!-- /container -->




    </main>
    <!-- /main -->
@endsection
@section('scripts')
    <!-- SPECIFIC SCRIPTS -->
    <script src="{{ asset('comassets/js/carousel_with_thumbs.js') }}"></script>
    <script>
        $(".search_category").click(function(e) {

            $("#category").val($(this).attr("data-category"));

        });
    </script>
@endsection
