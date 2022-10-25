@extends('layout.web.web')
@section('style')

    <!-- SPECIFIC CSS -->
    <link href="{{ asset('comassets/css/cart.css') }}" rel="stylesheet">
@endsection
@section('content')


<main class="bg_gray">
    <div class="container margin_30">
    <div class="page_header">
        <div class="breadcrumbs">
            <ul>
                <li><a href="{{ LaravelLocalization::localizeUrl('/') }}">{{ __('links.home') }}</a></li>

                <li>Cart</li>
            </ul>
        </div>
        <h1>{{$user->username ?? ''}}</h1>
    </div>
    @if(Session::has('flash_success'))

    <div class="alert alert-success alert-dismissible fade show" role="alert"

    <strong ><i class="fa fa-check-circle"></i> {{session('flash_danger')}}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>

@endif
    <div id="txbody">
@include('web.cartTable')
    </div>


</main>
<!--/main-->
@endsection
@section('scripts')

<script>
    //del item
     $(document).on('click', '.delItem', function(e) {
        e.preventDefault();

        var index = $(this).closest('tr').attr('data-id');

var card = $("#cart_id" + index + "").val();

        $.ajax({
                type: 'GET',

                url: "{{route('web-item-del')}}",
                data: {

                    cart: card,



                },
                success: function(response) {

                    $('#txbody').html(response);

                },
                error: function(response) {


                }
            });
    });
//add qty
    $(document).on('click', '.inc', function(e) {
        e.preventDefault();

        var index = $(this).closest('tr').attr('data-id');

         var card = $("#cart_id" + index + "").val();

        $.ajax({
                type: 'GET',

                url: "{{route('web-fetchInc')}}",
                data: {

                    cart: card,



                },
                success: function(response) {

                    $('#txbody').html(response);

                },
                error: function(response) {


                }
            });
    });
    //sub qty
    $(document).on('click', '.dec', function(e) {
        e.preventDefault();
        var index = $(this).closest('tr').attr('data-id');

         var card = $("#cart_id" + index + "").val();

        $.ajax({
                type: 'GET',

                url: "{{route('web-fetchDec')}}",
                data: {

                    cart: card,



                },
                success: function(response) {

                    $('#txbody').html(response);

                },
                error: function(response) {


                }
            });
    });

</script>
@endsection
