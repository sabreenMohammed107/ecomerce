@extends('layout.web')
@section('title', ' الكارت')

@section('content')
<div class="row">
    <!-- left column -->
    <div class="col-md-10">
            <div class="box box-primary px-5">
        <div class="box-header">
          <h3 class="box-title"> بيانات  الكارت</h3>
        </div>







<div class="box">
    <div class="box-body">
                                <div class="col-12">
                                    <div class="card card-info card-tabs">
                                        <div class="card-header p-0 pt-1 bg-white">
                                            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                                <li class="nav-item active">
                                                    <a class="nav-link text-dark active" id="custom-tabs-one-1-tab" data-toggle="pill"
                                                        href="#custom-tabs-one-1" role="tab"
                                                        aria-controls="custom-tabs-one-1" aria-selected="true">بيانات
                                                        الكارت</a>
                                                </li>



                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content" id="custom-tabs-one-tabContent">
                                                <div class="tab-pane fade in active" id="custom-tabs-one-1"
                                                    role="tabpanel" aria-labelledby="custom-tabs-one-1-tab">
                                                    <div class="card card-primary">
                                                        <!-- form start -->
                                                        <form role="form" action="{{route('category.store')}}"
                                                            method="post">
                                                            @csrf
                                                            <div class="card-body">
                                                                <div class="row">

                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="">  اسم المستخدم</label>
                                                                            <input type="text"
                                                                                value="{{ $row->user->username ?? '' }}"
                                                                                name="ar_name" class="form-control" id="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="">  اسم المنتج</label>
                                                                            <input type="text"
                                                                                value="{{ $row->product->ar_name ?? '' }} "
                                                                                name="en_name" class="form-control" id="">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for=""> المقاس</label>
                                                                            <input type="text"
                                                                            value="{{ $row->size->size->ar_name ?? '' }} "
                                                                            name="en_name" class="form-control" id="">                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for=""> اللون</label>
                                                                            <input type="text"
                                                                            value="{{ $row->color->color->ar_name ?? '' }} "
                                                                            name="en_name" class="form-control" id="">                                                                          </div>
                                                                    </div>


                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="">الكميه</label>
                                                                            <input type="number"
                                                                                value="{{ $row->quantity ?? '' }}"
                                                                                name="order" class="form-control"
                                                                                id="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="">الحالة</label>
                                                                            <input type="text"
                                                                            @if($row->status==1) value="مؤكده" @else value="غير مؤكده" @endif
                                                                                name="order" class="form-control"
                                                                                id="">
                                                                        </div>
                                                                    </div>

                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <table id="example2" class="table table-bordered table-striped">
                                                                    <thead class="bg-info">
                                                                        <tr>
                                                                            <th>#</th>

                                                                            <th> اسم المنتج</th>
                                                                            <th>  السعر</th>

                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($items as $index => $row)
                                                                            <tr>
                                                                                <th>{{ $index + 1 }}</th>
                                                                                <th>{{ $row->product->ar_name ?? '' }} </th>

                                                                                <th>{{ $row->price ?? '' }} </th>


                                                                            </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                        </table>
                                                                <!-- /.card-body -->
                                                                <div class="card-footer">

                                                                    <a href="{{ route('admin-cart.index') }}"
                                                                        class="btn btn-danger">إلغاء</a>

                                                                </div>
                                                        </form>
                                                    </div>
                                                </div>



                                        </div>
                                    </div>
                                    <!-- /.card -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.col -->



        @endsection

        @section('scripts')

        @endsection
