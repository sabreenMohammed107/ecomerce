@extends('layout.web.web')

@section('style')
    <!-- SPECIFIC CSS -->
    <link href="{{ asset('comassets/css/leaveComment.css') }}" rel="stylesheet">
    <link href="{{ asset('comassets/css/custom.css') }}" rel="stylesheet">
@endsection
@section('content')
    <main class="bg_gray">


        <div class="container margin_60_35">

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="write_review">
                        <h1>تقيم المنتجات</h1>
                        <form action="{{route('saveReview')}}" method="POST">

{{-- @csrf --}}
                            <div class="rating_submit">
                                <div class="form-group">
                                    <label class="d-block">التقيم</label>
                                    <input type="hidden" name="product_id" value="{!! $product->id !!}">
                                    <input type="hidden" name="user_id" value="{!! Auth::user()->id !!}">

                                    <span class="rating mb-0">
                                        <input type="radio" name="rate_no" class="rating-input" id="5_star"
                                            value="5"><label for="5_star" class="rating-star"></label>
                                        <input type="radio" name="rate_no" class="rating-input" id="4_star"
                                            value="4"><label for="4_star" class="rating-star"></label>
                                        <input type="radio" name="rate_no" class="rating-input" id="3_star"
                                            value="3"><label for="3_star" class="rating-star"></label>
                                        <input type="radio" name="rate_no" class="rating-input" id="2_star"
                                            value="2"><label for="2_star" class="rating-star"></label>
                                        <input type="radio" name="rate_no" class="rating-input" id="1_star"
                                            value="1"><label for="1_star" class="rating-star"></label>
                                    </span>
                                </div>
                            </div>
                            <!-- /rating_submit -->

                            <div class="form-group">
                                <label>اكتب تعليقك</label>
                                <textarea class="form-control" style="height: 180px;" name="ar_comment" required=""></textarea>
                            </div>


                            <button type="submit" class="btn_1">ارسال تقيمك</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </main>
@endsection
