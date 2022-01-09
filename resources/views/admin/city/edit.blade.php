@extends('layout.web')

@section('title', 'الالوان')

@section('content')

<div class="row">
    <!-- left column -->
    <div class="col-md-10">
            <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">تعديل</h3>
        </div>






                  <form action="{{route('city.update',$row->id)}}" method="POST">
                @method('PUT')
				  @csrf
                  <div class="box-body">

                    <div class="col-md-12">
                        <div class="col-sm-6">
                        <div class="form-group">
                            <label  >{{ __('الاسم عربى') }}</label>
                            <div class="input-group">
                                <input type="text" id="newTitle" name="ar_name" value="{{$row->ar_name}}" class="form-control"
                                   placeholder="اسم ">
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label  >{{ __('الاسم انجليزى') }}</label>
                                <div class="input-group">
                                    <input type="text" id="newTitle" name="en_name" value="{{$row->ar_name}}" class="form-control"
                                       placeholder="اسم ">
                                </div>
                            </div>
                            </div>
                    </div>
                    <div class="col-md-12">
                            <div class="col-sm-6">
                        <div class="form-group">
                            <label  >{{ __('تكلفة الدليفرى') }}</label>
                            <div class="input-group">
                                <input type="color" id="newTitle" name="delivery" value="{{$row->delivery}}" class="form-control"
                                   placeholder="تكلفه">
                            </div>
                        </div>
                    </div>


                </div>

                <div class="col-xs-6 col-sm-6 col-md-6 text-center">
                    <button type="submit" class="btn btn-primary">حفظ</button>
                    <a href="{{route('city.index')}}" class="btn btn-danger">إلغاء</a>
                </div>
                </div>

                  </form>
              </div>
    </div>

@endsection
