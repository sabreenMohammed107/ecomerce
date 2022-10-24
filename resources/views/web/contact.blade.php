@extends('layout.web.web')

@section('style')

    <!-- SPECIFIC CSS -->
    <link href="{{ asset('comassets/css/contact.css') }}" rel="stylesheet">
@endsection
@section('content')
<main class="bg_gray">


    <div class="container margin_60">
        <div class="main_title">
            <h2>{{ __('links.contact_us') }}</h2>
            <p>{!! __('links.contact_text') !!}</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <div class="box_contacts">
                    <i class="icon-phone"></i>
                    <h2>{{ __('links.phone') }}</h2>
                    <a href="#0">{{$contact->phone}}</a>
                    {{-- <div class="cleaner"></div>
                     <a href="#0">+94 423-23-221</a> --}}

                </div>
            </div>
            <div class="col-lg-4">
                <div class="box_contacts">
                    <i class="ti-map-alt"></i>
                    <h2>{{ __('links.address') }}</h2>
                    <div>{!!$contact->address!!}</div>

                </div>
            </div>
            <div class="col-lg-4">
                <div class="box_contacts">
                    <i class="icon-mail"></i>
                    <h2>{{ __('links.email') }}</h2>
                     <a>{{$contact->email}}</a>
                     {{-- <div class="cleaner"></div>
                      <a>order@KAPOTCHA.com</a> --}}

                </div>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
<div class="bg_white">
    @if(Session::has('flash_success'))

    <div class="alert alert-success alert-dismissible fade show" role="alert"

    <strong ><i class="fa fa-check-circle"></i> {{session('flash_danger')}}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>

@endif
    <div class="container margin_60_35">
        <h4 class="pb-3">{{ __('links.contact_us') }}</h4>
        <form action="{{ LaravelLocalization::localizeUrl('/contact-message') }}" method="post">
            @csrf
        <div class="row">
            <div class="col-lg-6 col-md-6 add_bottom_25">
                <div class="form-group">
                    <input class="form-control" name="name" type="text" placeholder="{{ __('links.name') }} *">
                </div>
                <div class="form-group">
                    <input class="form-control" name="email" type="email" placeholder="{{ __('links.email') }} *">
                </div>

                <div class="form-group">
                    <input class="form-control" name="mobile" type="text" placeholder="{{ __('links.phone') }} *">
                </div>


                <div class="form-group">
                    <textarea class="form-control" name="message" style="height: 150px;" placeholder="{{ __('links.message') }} *"></textarea>
                </div>
                <div class="form-group">
                    <input class="btn_1 min-width" type="submit" value="{{ __('links.send_msg') }}">
                </div>
            </div>

        </div>
        <!-- /row -->
        </form>
    </div>
    <!-- /container -->
</div>
<!-- /bg_white -->
</main>
<!--/main-->

@endsection
