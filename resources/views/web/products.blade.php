@extends('layout.web.web')
@section('style')

    <!-- SPECIFIC CSS -->
    <link href="{{ asset('comassets/css/listing.css') }}" rel="stylesheet">
@endsection
@section('content')

    <main>
        <div class="top_banner">
            <div class="opacity-mask bg-gemy d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.3)">
                <div class="container">
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="{{ LaravelLocalization::localizeUrl('/') }}">{{ __('links.home') }}</a></li>
                            <li><a href="{{ LaravelLocalization::localizeUrl('/categories') }}">{{ __('links.categories') }}</a></li>

                        </ul>
                    </div>
                    <h1>
                        @if (LaravelLocalization::getCurrentLocale() === 'en')
                            {{ $category->en_name }}
                        @else
                            {{ $category->ar_name }}
                        @endif
                    </h1>
                </div>
            </div>

        </div>
        <!-- /top_banner -->
        <div id="stick_here"></div>

        <!-- /toolbox -->

        <div class="container margin_30">

            <div class="row">
                <aside class="col-lg-3" id="sidebar_fixed">
                    <div class="filter_col">
                        <form id="categoryTarget" action="javascript:void(0)" method="get">
                            <input type="hidden" value="{{ csrf_token() }}" id="subCatToken" />
                            <input type="hidden" value="1" id="category_id" />
                            <div class="inner_bt"><a href="#" class="open_filters"><i class="ti-close"></i></a>
                            </div>
                            <div class="filter_type version_2">
                                <h4><a href="#filter_1" data-bs-toggle="collapse"
                                        class="opened">{{ __('links.sizes') }}</a></h4>
                                <div class="collapse show" id="filter_1">
                                    <ul>
                                        @foreach ($sizes as $size)
                                            <li>
                                                <label class="container_check">
                                                    @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                        {{ $size->en_name }}
                                                    @else
                                                        {{ $size->ar_name }}
                                                    @endif
                                                    <input name="sizeId" value="{{ $size->id }}" type="checkbox">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </li>
                                        @endforeach


                                    </ul>
                                </div>
                                <!-- /filter_type -->
                            </div>
                            <!-- /filter_type -->
                            <div class="filter_type version_2">
                                <h4><a href="#filter_2" data-bs-toggle="collapse"
                                        class="opened">{{ __('links.colors') }}</a></h4>
                                <div class="collapse show" id="filter_2">
                                    <ul>
                                        @foreach ($colors as $color)
                                            <li>
                                                <label class="container_check">
                                                    @if (LaravelLocalization::getCurrentLocale() === 'en')
                                                        {{ $color->en_name }}
                                                    @else
                                                        {{ $color->ar_name }}
                                                    @endif
                                                    <input name="colorId" value="{{ $color->id }}" type="checkbox">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </li>
                                        @endforeach

                                    </ul>
                                </div>
                            </div>
                            <!-- /filter_type -->

                            <!-- /filter_type -->
                            <div class="filter_type version_2">
                                <h4><a href="#filter_4" data-bs-toggle="collapse"
                                        class="closed">{{ __('links.price') }}</a></h4>
                                <div class="collapse" id="filter_4">
                                    <ul>

                                        @for ($i = 0; $i < count($rangeArray) - 1; $i++)
                                            <li>
                                                <label
                                                    class="container_check">{{ $rangeArray[$i] . ' - ' . $rangeArray[$i + 1] }}
                                                    <input name="priceId" value="{{ $rangeArray[$i + 1] }}"
                                                        type="checkbox">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </li>
                                        @endfor

                                    </ul>
                                </div>
                            </div>
                            <!-- /filter_type -->
                            <div class="buttons">
                                {{-- <a href="#0" class="btn_1" onclick="filter()">Filter</a> --}}
                                <button type="button" class="btn_1" onclick="filter()">{{ __('links.filter') }}</button>
                                <button type="reset" class="btn_1 gray" >{{ __('links.reset') }}</button>

                            </div>
                        </form>
                    </div>
                </aside>
                <!-- /col -->
                <div class="col-lg-9">
                    <div id="table_data">

                        @include('web.productList')



                    </div>

                </div>
                <!-- /col -->
            </div>
            <!-- /row -->

        </div>
        <!-- /container -->
    </main>
    <!-- /main -->
@endsection
@section('scripts')
    <script>
        //get brand

        function filter() {

            $("#categoryTarget").submit();

            var billColors = [];
            var billSizes = [];
            var billprices = [];
            $("input:checkbox[name=colorId]:checked").each(function() {
                billColors.push($(this).val());
            });
            $("input:checkbox[name=sizeId]:checked").each(function() {
                billSizes.push($(this).val());
            });
            $("input:checkbox[name=priceId]:checked").each(function() {
                billprices.push($(this).val());
            });
            var category = $("#category_id").val();

            $.ajax({
                type: 'GET',

                url: "{{route('web-fetchProduct')}}",
                data: {

                    category: category,
                    sizes: billSizes,
                    colors: billColors,
                    prices: billprices,


                },
                success: function(response) {


                    $('#table_data').html(response);
                    // $('#selectSort option[value="'+selection+'"]').prop('selected', true);


                },
                error: function(response) {


                }
            });
        }
        //End get brand
        $(document).ready(function() {

$(document).on('click', '#productt .pagination a', function(event) {
    event.preventDefault();
    var page = $(this).attr('href').split('page=')[1];
                var billColors = [];
                var billSizes = [];
                var billprices = [];
                $("input:checkbox[name=colorId]:checked").each(function() {
                    billColors.push($(this).val());
                });
                $("input:checkbox[name=sizeId]:checked").each(function() {
                    billSizes.push($(this).val());
                });
                $("input:checkbox[name=priceId]:checked").each(function() {
                    billprices.push($(this).val());
                });
                var category = $("#category_id").val();
                fetch_productdata(page, billColors, billSizes, billprices, category);

            });
        });
            // End paginate product
            //function of pagination product

            function fetch_productdata(page, billColors, billSizes, billprices, category) {
                // alert(category)
                $.ajax({
                    url: "/fetch-product-filter?page=" + page,
                    data: {

                        category: category,
                        sizes: billSizes,
                        colors: billColors,
                        prices: billprices,
                    },

                    success: function(response) {
                        $('#table_data').html(response);
                        // $('#selectSort option[value="'+selection+'"]').prop('selected', true);
                    },
                error: function(response) {

                }
                });
            }
            //End function of pagination product

        // });
    </script>
@endsection
