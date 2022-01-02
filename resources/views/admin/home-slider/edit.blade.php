@extends('layout.web')
@section('title', 'إدارة المهام')

@section('content')
<div class="row">
    <!-- left column -->
    <div class="col-md-10">
            <div class="box box-primary px-5">
        <div class="box-header">
          <h3 class="box-title">تفاصيل البانر</h3>
        </div>







<div class="box">
    <div class="box-body">
<div class="col-12">
                                    <div class="card card-info card-tabs">
                                        <div class="card-header p-0 pt-1 bg-white">
                                            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                                <li class="nav-item active">
                                                    <a class="nav-link text-dark active" id="custom-tabs-one-1-tab"
                                                        data-toggle="pill" href="#custom-tabs-one-1" role="tab"
                                                        aria-controls="custom-tabs-one-1" aria-selected="true">بيانات
                                                        اساسية</a>
                                                </li>



                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content" id="custom-tabs-one-tabContent">
                                                <div class="tab-pane fade in active" id="custom-tabs-one-1"
                                                    role="tabpanel" aria-labelledby="custom-tabs-one-1-tab">
                                                    <div class="card card-primary">
                                                        <!-- form start -->
                                                        <form role="form"
                                                            action="{{ route('admin-slider.update', $row->id) }}"
                                                            method="post" enctype="multipart/form-data">
                                                            @method('PUT')
                                                            @csrf
                                                            <div class="box">
                                                                <div class="box-body">
                                                                    <div class="col-md-12">
                                                                        <div class="col-sm-6 ">
                                                                            <input type="radio" name="tab" value="igotnone"
                                                                                disabled @if ($row->category_id) checked @endif
                                                                                onclick="show1();" /> تصنيف
                                                                            <input type="radio" name="tab" value="igottwo"
                                                                                disabled @if ($row->product_id) checked @endif
                                                                                onclick="show2();" /> منتج
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <div id="div1"  style="width: 100%"
                                                                                class=" @if ($row->product_id) hide @endif">

                                                                                        <label>تصنيفات</label>
                                                                                        <select
                                                                                            class="js-example-basic-single"
                                                                                            id="category_id"
                                                                                            style="width: 100%"
                                                                                            name="category_id">
                                                                                            <option value="">اختر</option>
                                                                                            @foreach ($categories as $data)
                                                                                                <option
                                                                                                    {{ $row->category_id == $data->id ? 'selected' : '' }}
                                                                                                    value="{{ $data->id }}">
                                                                                                    {{ $data->ar_name }}
                                                                                                </option>

                                                                                            @endforeach
                                                                                        </select>

                                                                            </div>
                                                                            <style>
                                                                                .hide {
                                                                                    display: none;
                                                                                }

                                                                            </style>
                                                                            <div id="div2" @if ($row->category_id) style="width: 100% ; display: none" @endif
                                                                                class=" @if ($row->category_id) hide @endif">
                                                                                <div style="width: 100% ;">
                                                                                    <label>المنتجات</label>
                                                                                    <select class="js-example-basic-single"
                                                                                        id="product_id" style="width: 100%"
                                                                                        name="product_id">
                                                                                        <option value="">اختر</option>
                                                                                        @foreach ($products as $data)
                                                                                            <option
                                                                                                {{ $row->product_id == $data->id ? 'selected' : '' }}
                                                                                                value="{{ $data->id }}">
                                                                                                {{ $data->ar_name }}
                                                                                            </option>

                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
<br>
<br>
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group">
                                                                                <label for=""> العنوان عربى</label>
                                                                                <input type="text"
                                                                                    value="{{ $row->ar_title }}"
                                                                                    name="ar_title" class="form-control"
                                                                                    id="">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group">
                                                                                <label for=""> العنوان انجليزى</label>
                                                                                <input type="text"
                                                                                    value="{{ $row->en_title }}"
                                                                                    name="en_title" class="form-control"
                                                                                    id="">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-6">
                                                                            <div class="form-group">
                                                                                <label for="">الوصف عربى</label>
                                                                                <textarea class="form-control summernote"
                                                                                    id="summernote"
                                                                                    name="ar_text">{!! $row->ar_text !!}</textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <div class="form-group">
                                                                                <label for="">الوصف انجليزى</label>
                                                                                <textarea class="form-control summernote"
                                                                                    name="en_text">{!! $row->en_text !!}</textarea>
                                                                            </div>
                                                                        </div>


                                                                        <div class="col-sm-6">
                                                                            <div class="form-group">
                                                                                <label for="">الترتيب</label>
                                                                                <input type="number"
                                                                                    value="{{ $row->order }}"
                                                                                    name="order" class="form-control"
                                                                                    id="">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="">اضافة صورة</label>
                                                                                {{-- <div class="custom-file">
                                                                                <input type="file" class="custom-file-input" name="name" id="customFile">
                                                                                <label class="custom-file-label" for="customFile">إختار ملف</label>
                                                                            </div> --}}

                                                                                <div class="custom-file">
                                                                                    <input type="file" name="img"
                                                                                        class="custom-file-input"
                                                                                        id="inputGroupFile02" />
                                                                                    <label class="custom-file-label"
                                                                                        for="inputGroupFile02">{{ $row->image }}</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <img src="{{ asset('uploads/home_sliders') }}/{{ $row->image }}"
                                                                                style="width: 200px;height:100px">
                                                                        </div>
                                                                    </div>

                                                                    </div>
                                                                </div>
                                                                <!-- /.card-body -->
                                                                <div class="card-footer">
                                                                    <button type="submit"
                                                                        class="btn btn-primary">حفظ</button>
                                                                    <a href="{{ route('admin-slider.index') }}"
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
            @section('style')
            <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
           @endsection
            @section('scripts')
                <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
                <script>
                    $(document).ready(function() {
                        $('#category_id').select2();
                        $('#product_id').select2();


                        var radio = $('input[name="tab"]:checked').val();
                        if (radio == "igotnone") {
                            show1();
                        } else {
                            show2();
                        }
                    });

                    function show1() {

                        document.getElementById('div1').style.display = 'inline-flex';
                        document.getElementById('div2').style.display = 'none';
                    }

                    function show2() {
                        document.getElementById('div1').style.display = 'none';
                        document.getElementById('div2').style.display = 'inline-flex';
                    }
                </script>
            @endsection
