<header class="version_1">
    <div class="layer"></div><!-- Mobile menu overlay mask -->
    <div class="main_header">
        <div class="container">
            <div class="row small-gutters">
                <div class="col-xl-3 col-lg-3 d-lg-flex align-items-center">
                    <div id="logo">
                        <a href="index.html"><img src="{{ asset('comassets/img/logo.png') }}" alt="" width="100"
                                height="35"></a>
                    </div>
                </div>
                <nav class="col-xl-6 col-lg-7">
                    <a class="open_close" href="javascript:void(0);">
                        <div class="hamburger hamburger--spin">
                            <div class="hamburger-box">
                                <div class="hamburger-inner"></div>
                            </div>
                        </div>
                    </a>
                    <!-- Mobile menu button -->
                    <div class="main-menu">
                        <div id="header_menu">
                            <a href="index.html"><img src="{{ asset('comassets/img/logo_black.svg') }}" alt=""
                                    width="100" height="35"></a>
                            <a href="#" class="open_close" id="close_in"><i class="ti-close"></i></a>
                        </div>
                        <ul>
                            <li>
                                <a href="{{ LaravelLocalization::localizeUrl('/') }}"
                                    class="show-submenu">{{ __('links.home') }}</a>

                            </li>


                            <li>
                                <a href="{{ LaravelLocalization::localizeUrl('/about-us') }}"
                                    class="show-submenu">{{ __('links.about_us') }}</a>

                            </li>


                            <li>
                                <a href="index.html" class="show-submenu">{{ __('links.offers') }}</a>

                            </li>




                            <li>
                                <a
                                    href="{{ LaravelLocalization::localizeUrl('/blogs') }}">{{ __('links.blog') }}</a>
                            </li>
                            <li>
                                <a
                                    href="{{ LaravelLocalization::localizeUrl('/contact') }}">{{ __('links.contact_us') }}</a>
                            </li>
                        </ul>
                    </div>
                    <!--/main-menu -->
                </nav>
                <div class="col-xl-3 col-lg-2 d-lg-flex align-items-center justify-content-end text-end">
                    <a class="phone_top"
                        href="tel://9438843343"><strong><span>{{ __('links.needHelp') }}</span>{{ $contact->phone }}</strong></a>
                </div>
            </div>
            <!-- /row -->
        </div>
    </div>
    <!-- /main_header -->

    <div class="main_nav Sticky">
        <div class="container">
            <div class="row small-gutters">
                <div class="col-xl-3 col-lg-3 col-md-3">
                    <nav class="categories">
                        <ul class="clearfix">
                            <li><span>
                                    <a href="#">
                                        <span class="hamburger hamburger--spin">
                                            <span class="hamburger-box">
                                                <span class="hamburger-inner"></span>
                                            </span>
                                        </span>
                                        {{ __('links.categories') }}
                                    </a>
                                </span>
                                <div id="menu">
                                    <ul>
                                        @foreach ($categories as $category)
                                            <li><span><a
                                                        href="{{ LaravelLocalization::localizeUrl('/products/' . $category->id) }}">
                                                        @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                            {{ $category->en_name }}
                                                        @else
                                                            {{ $category->ar_name }}
                                                        @endif

                                                    </a></span>

                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="col-xl-6 col-lg-7 col-md-6 d-none d-md-block">
                    <div class="custom-search-input">
                        <input type="text" placeholder="{{ __('links.search_text') }}">
                        <button type="submit"><i class="header-icon_search_custom"></i></button>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-2 col-md-3">
                    <ul class="top_tools">
                        <li>
                            <div class="dropdown dropdown-cart">
                                <?php
                                if(Auth::user()){
                                    $items = \App\Models\Cart_item::whereHas('cart', function ($query) {
                                    $query->where('status', '=', 0)->where('user_id', Auth::user()->id);
                                })->get();
                                $count = $items->count();
                                }

                                ?>
                                <a href="cart.html" class="cart_bt"><strong>@if(Auth::user()){{ $count }} @endif</strong></a>
                                <div class="dropdown-menu">
                                    <ul>
                                        <?php
                                        $rowtotal=0;
                                         $footTotal=0;
                                        ?>
@foreach ($items as $item)
<?php
$rowtotal=$item->product->price_after_discount*$item->quantity;
$footTotal+=$rowtotal;
?>
<li>
    <a href="product-detail-1.html">
        <figure><img
                src="{{ asset('uploads/attachment') }}/{{$item->product->images[0]->img ?? ''}}" data-src="{{ asset('uploads/attachment') }}/{{$item->product->images[0]->img ?? ''}}"

                alt="" width="50" height="50" class="lazy"></figure>
        <strong><span>@if (LaravelLocalization::getCurrentLocale() === 'en')
            {{ $item->product->en_name  ?? ''}}
        @else
            {{ $item->product->ar_name ??'' }}
        @endif</span>{{ $item->product->price_after_discount ?? '' }}</strong>
    </a>
    <a href="#0" class="action"><i class="ti-trash"></i></a>
</li>
@endforeach


                                    </ul>
                                    <div class="total_drop">
                                        <div class="clearfix">
                                            @if($footTotal>0)
                                            <strong>{{ __('links.total') }}</strong><span>{{$footTotal}}</span>
                                       @endif
                                        </div>
                                        @guest
                                            <a href="cart.html" class="btn_1 outline">{{ __('links.signin_up') }}</a>

                                        @else
                                            <a href="{{ LaravelLocalization::localizeUrl('/my-cart/' . Auth::user()->id) }}"
                                                class="btn_1 outline">{{ __('links.view_cart') }}</a>

                                        @endguest
                                        <a href="checkout.html" class="btn_1">{{ __('links.checkout') }}</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /dropdown-cart-->
                        </li>
                        <li>
                            <a href="#0" class="wishlist"><span>{{ __('links.wishlist') }}</span></a>
                        </li>
                        <li>
                            <div class="dropdown dropdown-access">
                                <a href="account.html"
                                    class="access_link"><span>{{ __('links.account') }}</span></a>
                                <div class="dropdown-menu">
                                    @guest
                                        <a href="account.html" class="btn_1">{{ __('links.signin_up') }}</a>
                                    @else
                                        <a href="account.html" class="btn_1">{{ Auth::user()->username }}</a>
                                        <ul>
                                            <li>
                                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                                    <i class="ti-close"></i>{{ __('Logout') }}</a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                    class="d-none">
                                                    @csrf
                                                </form>
                                            </li>
                                        </ul>
                                    @endguest

                                    <ul>

                                        <li>
                                            <a href="track-order.html"><i
                                                    class="ti-truck"></i>{{ __('links.track_order') }}</a>
                                        </li>
                                        <li>
                                            <a href="account.html"><i
                                                    class="ti-package"></i>{{ __('links.my_order') }}</a>
                                        </li>
                                        <li>
                                            <a href="account.html"><i
                                                    class="ti-user"></i>{{ __('links.my_profile') }}</a>
                                        </li>
                                        <li>
                                            <a href="help.html"><i
                                                    class="ti-help-alt"></i>{{ __('links.help_fqa') }}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /dropdown-access-->
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="btn_search_mob"><span> {{ __('links.search') }}
                                </span></a>
                        </li>
                        <li>
                            <a href="#menu" class="btn_cat_mob">
                                <div class="hamburger hamburger--spin" id="hamburger">
                                    <div class="hamburger-box">
                                        <div class="hamburger-inner"></div>
                                    </div>
                                </div>
                                {{ __('links.categories') }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /row -->
        </div>
        <div class="search_mob_wp">
            <input type="text" class="form-control" placeholder="{{ __('links.search_text') }}">
            <input type="submit" class="btn_1 full-width" value="Search">
        </div>
        <!-- /search_mobile -->
    </div>
    <!-- /main_nav -->
</header>
<!-- /header -->
