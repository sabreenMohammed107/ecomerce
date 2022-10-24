@extends('layout.web.web')

@section('style')
    <!-- SPECIFIC CSS -->
    <link href="{{ asset('comassets/css/account.css') }}" rel="stylesheet">
    <link href="{{ asset('comassets/css/custom.css') }}" rel="stylesheet">
@endsection
@section('content')

<main class="bg_gray ">
    <div class="container">
        <div class="row justify-content-center">
            {{-- <div class="col-md-5"> --}}
                <div class="row m-5 ">
                    <div class="col-xl-6 col-lg-6 col-md-6">
                        <div class="box_account">
                            <h3 class="client">Already Client</h3>
                            <div class="form_container">
                                <div class="row no-gutters">


                                </div>
                                <div class="divider"><span>Login</span></div>
                                <form action="{{route('save-user')}}" method="post" enctype="multipart/form-data">
                                       @csrf
                                       <input type="hidden" name="user_type" value="0" >
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="email" value="" id="email"
                                        placeholder="Email*">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" id="password_in" value=""
                                    placeholder="Password*">
                            </div>
                            {{-- <div class="clearfix add_bottom_15">
                                <div class="checkboxes float-start">
                                    <label class="container_check">Remember me
                                        <input type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>

                            </div> --}}
                            <div class="text-center"><input type="submit" value="تسجيل دخول" class="btn_1 full-width"></div>
                            </form>
                            <div id="forgot_pw">
                                <div class="form-group">
                                    <input type="email" class="form-control" name="email_forgot" id="email_forgot"
                                        placeholder="Type your email">
                                </div>
                                <p>A new password will be sent shortly.</p>
                                <div class="text-center"><input type="submit" value="Reset Password" class="btn_1"></div>
                            </div>
                        </div>
                        <!-- /form_container -->
                    </div>
                    <!-- /box_account -->
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6">
                    <div class="box_account">
                        <h3 class="new_client">New Client</h3> <small class="float-right pt-2">* Required Fields</small>
                        <form action="{{route('user-register')}}" method="post" enctype="multipart/form-data">
                           @csrf
                            <div class="form_container">
                                <div class="form-group">
                                    <input type="email" value="" class="form-control" name="email" id="email_2"
                                        placeholder="Email*">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password" id="password_in_2" value=""
                                        placeholder="Please Enter Your password*">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password_confirmation" id="password_in_2"
                                        value="" placeholder="Please Enter confirm password*">
                                </div>
                                <hr>

                                <div class="private box">
                                    <div class="row no-gutters">
                                        <div class="col-6 pr-1">
                                            <div class="form-group">
                                                <input type="text" value="" name="f_name" class="form-control"
                                                    placeholder="first name*">
                                            </div>
                                        </div>
                                        <div class="col-6 pl-1">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="l_name" value=""
                                                    placeholder="last name">
                                            </div>
                                        </div>

                                    </div>
                                    <!-- /row -->
                                    <div class="row no-gutters">
                                        <div class="col-6 pr-1">
                                            <div class="form-group">
                                                <input type="text" class="form-control"   name="username"
                                                placeholder="User Name">
                                            </div>
                                        </div>
                                        <div class="col-6 pl-1">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="phone" value=""
                                                    placeholder="Phone">

                                            </div>
                                        </div>
                                        {{-- <div class="col-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" autocomplete="false"  name="address"
                                                    placeholder="Full Address">
                                            </div>
                                        </div> --}}
                                    </div>
                                    <!-- /row -->



                                </div>
                                <!-- /private -->

                                <hr>

                                <div class="text-center"><input type="submit" value="Register" class="btn_1 full-width"></div>
                            </div>
                        </form>
                        <!-- /form_container -->
                    </div>
                    <!-- /box_account -->
                </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
        </div>
</main>
<!--/main-->

@endsection
