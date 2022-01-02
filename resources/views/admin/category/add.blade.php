@extends('layout.web')
@section('title', 'إدارة المهام')

@section('content')

                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-10">
                                    <div class="box box-primary px-5">
                                <div class="box-header">
                                  <h3 class="box-title"> بيانات  التصنيف</h3>
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
                                                        اساسية</a>
                                                </li>

                                                <li class="nav-item">
                                                    <a class="nav-link text-dark" id="custom-tabs-one-2-tab" data-toggle="pill"
                                                        href="#custom-tabs-one-2" role="tab"
                                                        aria-controls="custom-tabs-one-2" aria-selected="false">الصور </a>
                                                </li>

                                            </ul>
                                        </div>
                                        <div class="box-body">
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
                                                                            <label for=""> الاسم عربى</label>
                                                                            <input type="text"
                                                                                value="{{ old('ar_name') }}"
                                                                                name="ar_name" class="form-control" id="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for=""> الاسم انجليزى</label>
                                                                            <input type="text"
                                                                                value="{{ old('en_name') }}"
                                                                                name="en_name" class="form-control" id="">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="">الوصف عربى</label>
                                                                            <textarea class="form-control summernote" name="ar_description">{{ old('ar_description') }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="">الوصف انجليزى</label>
                                                                            <textarea class="form-control summernote" name="en_description">{{ old('en_description') }}</textarea>
                                                                        </div>
                                                                    </div>


                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="">الترتيب</label>
                                                                            <input type="number"
                                                                                value="{{ old('order') }}"
                                                                                name="order" class="form-control"
                                                                                id="">
                                                                        </div>
                                                                    </div>


                                                                    </div>
                                                                </div>
                                                                <!-- /.card-body -->
                                                                <div class="card-footer">
                                                                    <button type="submit"
                                                                        class="btn btn-primary">حفظ</button>
                                                                    <a href="{{ route('category.index') }}"
                                                                        class="btn btn-danger">إلغاء</a>

                                                                </div>
                                                        </form>
                                                    </div>
                                                </div>

                                            <div class="tab-pane fade" id="custom-tabs-one-2" role="tabpanel"
                                                aria-labelledby="custom-tabs-one-2-tab">
                                                @include('admin.category.images')
                                                <hr />


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
