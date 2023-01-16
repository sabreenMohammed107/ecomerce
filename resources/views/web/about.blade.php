@extends('layout.web.web')
@section('style')

    <!-- SPECIFIC CSS -->
    <link href="{{ asset('comassets/css/about.css') }}" rel="stylesheet">
@endsection
@section('content')
    <main class="bg_gray">
        <div class="container margin_60_35 add_bottom_30">
            <div class="main_title">
                <h2>{{ __('links.about_us') }}</h2>
            </div>
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-5">
                    <div class="box_about">
                        <h2>
                            @if (LaravelLocalization::getCurrentLocale() === 'en')
                                {{ $company->en_about_title }}
                            @else
                                {{ $company->ar_about_title }}
                            @endif
                        </h2>
                        @if (LaravelLocalization::getCurrentLocale() === 'en')
                            {!! $company->en_about !!}
                        @else
                            {!! $company->ar_about !!}
                        @endif
                        </p>
                        <img src="{{ asset('comassets/img/arrow_about.png') }}" alt="" class="arrow_1">
                    </div>
                </div>
                <div class="col-lg-5 pl-lg-5 text-center d-none d-lg-block">
                    <img src="{{ asset('comassets/img/about_1.png') }}" alt="" class="img-fluid" width="350"
                        height="268">
                </div>
            </div>
            <!-- /row -->
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-5 pr-lg-5 text-center d-none d-lg-block">
                    <img src="{{ asset('comassets/img/about_2.png') }}" alt="" class="img-fluid" width="350"
                        height="268">
                </div>
                <div class="col-lg-5">
                    <div class="box_about">
                        <h2>
                            @if (LaravelLocalization::getCurrentLocale() === 'en')
                                {{ $company->en_vision_title }}
                            @else
                                {{ $company->ar_vision_title }}
                            @endif
                        </h2>
                        <p class="lead">
                            @if (LaravelLocalization::getCurrentLocale() === 'en')
                                {!! $company->en_vision !!}
                            @else
                                {!! $company->ar_vision !!}
                            @endif
                        </p>
                        <img src="{{ asset('comassets/img/arrow_about.png') }}" alt="" class="arrow_2">
                    </div>
                </div>
            </div>
            <!-- /row -->
            <div class="row justify-content-center align-items-center ">
                <div class="col-lg-5">
                    <div class="box_about">
                        <h2>
                            @if (LaravelLocalization::getCurrentLocale() === 'en')
                                {{ $company->en_mission_title }}
                            @else
                                {{ $company->ar_mission_title }}
                            @endif
                        </h2>
                        <p class="lead">
                            @if (LaravelLocalization::getCurrentLocale() === 'en')
                                {!! $company->en_mission !!}
                            @else
                                {!! $company->ar_mission !!}
                            @endif
                        </p>
                    </div>

                </div>
                <div class="col-lg-5 pl-lg-5 text-center d-none d-lg-block">
                    <img src="{{ asset('comassets/img/about_3.png') }}" alt="" class="img-fluid" width="350"
                        height="316">
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->

        <div class="bg_white">
            <div class="container margin_60_35">
                <div class="main_title">
                    <h2>{{ __('links.why_us') }}</h2>

                </div>
                <div class="row">
                    @dd($whyRows)
                    @foreach ($whyRows as $key=>$xx)

                        <div class="col-lg-4 col-md-6">
                            <div class="box_feat">
                                @if ($key == 0)
                                    <i class="ti-medall-alt"></i>

                                <h3 style="color: black">
                                    {{ $xx->ar_title }}
                               </h3>
                                @endif
                                @if ($key == 1)
                                    <i class="ti-help-alt"></i>

                                @endif
                                @if ($key == 2)
                                    <i class="ti-gift"></i>
                                @endif
                                @if ($key == 3)
                                    <i class="ti-headphone-alt"></i>
                                @endif
                                @if ($key == 4)
                                    <i class="ti-wallet"></i>
                                @endif
                                @if ($key == 5)
                                    <i class="ti-comments"></i>
                                @endif

                                <h3 style="color: black">  @if (LaravelLocalization::getCurrentLocale() === 'en')
                                    {{ $xx->en_title }}
                                @else
                                    {{ $xx->ar_title }}
                                @endif</h3>
                                <p>@if (LaravelLocalization::getCurrentLocale() === 'en')
                                    {!! $xx->en_breif !!}
                                @else
                                    {!! $xx->ar_brief !!}
                                @endif</p>
                            </div>
                        </div>
                    @endforeach

                </div>
                <!--/row-->
            </div>
        </div>
        <!-- /bg_white -->

    </main>
    <!--/main-->
@endsection
