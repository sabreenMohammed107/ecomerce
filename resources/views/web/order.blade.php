@extends('layout.web.web')
@section('style')

    <!-- SPECIFIC CSS -->
    <link href="{{ asset('comassets/css/checkout.css') }}" rel="stylesheet">
@endsection
@section('content')
    <main class="bg_gray">


        <div class="container margin_30">
            <div class="page_header">
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Category</a></li>
                        <li>Page active</li>
                    </ul>
                </div>
                <h1>Sign In or Create an Account</h1>

            </div>
            <!-- /page_header -->
            <form action="{{ LaravelLocalization::localizeUrl('/saving-order') }}" method="post">
                @csrf
                <div class="row">
                    {{-- <form action="" method=""> --}}
                    <div class="col-lg-6 col-md-6">
                        <div class="step first">
                            <h3>1. User Info and Billing address</h3>
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <div class="tab-content checkout">
                                <div class="tab-pane fade show active" id="tab_1" role="tabpanel" aria-labelledby="tab_1">
                                    <div class="form-group">
                                        <input type="email" name="email" value="{{ $user->email }}" class="form-control"
                                            placeholder="Email">
                                    </div>

                                    <div class="row no-gutters">
                                        <div class="col-6 form-group pr-1">
                                            <input type="text" name="username" value="{{ $user->username }}"
                                                class="form-control" placeholder="Name">
                                        </div>
                                        <div class="col-6 form-group pl-1">
                                            <input type="text" name="l_name" value="{{ $user->l_name }}"
                                                class="form-control" placeholder="Last Name">
                                        </div>
                                    </div>
                                    <!-- /row -->
                                    <div class="form-group">
                                        <input type="text" name="address" class="form-control" placeholder="Full Address">
                                    </div>
                                    <div class="row no-gutters">
                                        <div class="col-12 form-group pr-1">
                                            <div class="custom-select-form">
                                                <select class="wide add_bottom_15" onchange="editDelivery()" name="city"
                                                    id="City">
                                                    @foreach ($cities as $city)
                                                        <option value="{{ $city->id }}">
                                                            @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                                {{ $city->en_name }}
                                                            @else
                                                                {{ $city->ar_name }}
                                                            @endif
                                                        </option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- /row -->

                                    <!-- /row -->
                                    <div class="form-group">
                                        <input type="text" name="phone" value="{{ $user->phone }}" class="form-control"
                                            placeholder="phone">
                                    </div>




                                </div>
                                <!-- /tab_1 -->
                                <div class="tab-pane fade" id="tab_2" role="tabpanel" aria-labelledby="tab_2"
                                    style="position: relative;">

                                </div>
                                <!-- /tab_2 -->
                            </div>
                        </div>
                        <!-- /step -->
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <div class="step last">
                            <h3>2. Order Summary</h3>
                            <div class="box_general summary">
                                <input type="hidden" name="cart_id" id="cart_id" value="{{ $cart->id }}">
                                <ul>
                                    <?php
                                    $rowtotal = 0;
                                    $footTotal = 0;
                                    $totalAfterDel = 0;
                                    ?>
                                    @foreach ($cart->items as $item)
                                        <?php
                                        $rowtotal = $item->product->price_after_discount * $item->quantity;
                                        $footTotal += $rowtotal;
                                        $totalAfterDel = $footTotal + $cities[0]->delivery;
                                        ?>
                                        <li class="clearfix"><em>
                                                @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                    {{ $item->product->en_name ?? '' }} / {{ $item->quantity }}
                                                @else
                                                    {{ $item->product->ar_name ?? '' }} / {{ $item->quantity }}
                                            </em>
                                    @endif
                                    <span>{{ $rowtotal }}</span></li>

                                    @endforeach

                                </ul>
                                <ul>
                                    <li class="clearfix"><em><strong>Subtotal</strong></em>
                                        <span>{{ $footTotal }}</span></li>
                                    <input type="hidden" id="subTotal" value="{{ $footTotal }}">

                                    <li class="clearfix"><em><strong>Shipping</strong></em> <span
                                            id="delveryCosting">{{ $cities[0]->delivery }}</span></li>

                                </ul>

                                <div class="total clearfix">TOTAL <span id="totalAfterDel">{{ $totalAfterDel }}</span>
                                </div>
                                <input type="hidden" id="Total" name="subtotally" value="{{ $totalAfterDel }}">
                                <div class="col-sm-8">
                                    <div class="apply-coupon">
                                        <div class="form-group">
                                            <div class="row g-2">
                                                <div class="col-md-6"><input type="text" id="coupon"
                                                        name="coupon_code" value="" placeholder="Promo code"
                                                        class="form-control"></div>
                                                <div class="col-md-4">
                                                    <button type="button" id="apply"  class="btn_1 outline">Apply Coupon</button></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="coponAdd" name="promo" value="">
                                <div class="total clearfix">TOTAL Final<span
                                        id="totalAfterPromo">{{ $totalAfterDel }}</span></div>
                                <input type="hidden" id="afterPromo" name="total" value="{{ $totalAfterDel }}">

                                <div class="form-group">
                                    <label class="container_check">Register to the Newsletter.
                                        <input type="checkbox" checked>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <button class="btn_1 full-width" type="submit">Confirm and Pay</button>
                                {{-- <a href="confirm.html" class="btn_1 full-width">Confirm and Pay</a> --}}
                            </div>
                            <!-- /box_general -->
                        </div>
                        <!-- /step -->
                    </div>
                    {{-- </form> --}}
                </div>
            </form>
            <!-- /row -->
        </div>
        <!-- /container -->
    </main>
    <!--/main-->

@endsection
{{-- var select_value = $('#select' + index + ' option:selected').val(); --}}
@section('scripts')
    <script>
        function editDelivery() {
            var select_value = $('#City option:selected').val();
            $.ajax({
                type: 'GET',

                url: "{{ route('getDeliverCost') }}",
                data: {

                    city: select_value,



                },
                success: function(response) {

                    $('#delveryCosting').html(response);
                    $('#totalAfterDel').html(Number(response) + Number($('#subTotal').val()))

                },
                error: function(response) {


                }
            });
        }

        function promo() {
            var select_value = $('#City option:selected').val();
            var coupon = $('#coupon').val();
            var total = $('#Total').val();
            var cart_id = $('#cart_id').val();
            $.ajax({
                type: 'GET',

                url: "{{ route('getPromoCost') }}",
                data: {

                    city: select_value,
                    coupon: coupon,
                    cart_id: cart_id,
                    total: total,



                },
                success: function(response) {
                    var result = $.parseJSON(response);
                    $('#coponAdd').val(coupon);
                    $('#afterPromo').val(Number(result[2]) + Number($('#delveryCosting').text()));
                    if (result[1] == 0) {
                        $('#totalAfterPromo').html(Number(result[2]) + Number($('#delveryCosting').text()));

                    } else {
                        $('#totalAfterPromo').html("Invalid Coupon");

                    }

                },
                error: function(response) {


                }
            });
        }

        $(document).on('click', '#apply', function(e) {
        e.preventDefault();
        var select_value = $('#City option:selected').val();
            var coupon = $('#coupon').val();
            var total = $('#Total').val();
            var cart_id = $('#cart_id').val();
            $.ajax({
                type: 'GET',

                url: "{{ route('getPromoCost') }}",
                data: {

                    city: select_value,
                    coupon: coupon,
                    cart_id: cart_id,
                    total: total,



                },
                success: function(response) {
                    var result = $.parseJSON(response);
                    $('#coponAdd').val(coupon);
                    $('#afterPromo').val(Number(result[2]) + Number($('#delveryCosting').text()));
                    if (result[1] == 0) {
                        $('#totalAfterPromo').html(Number(result[2]) + Number($('#delveryCosting').text()));

                    } else {
                        $('#totalAfterPromo').html("Invalid Coupon");

                    }

                },
                error: function(response) {


                }
            });
        });

    </script>
@endsection
