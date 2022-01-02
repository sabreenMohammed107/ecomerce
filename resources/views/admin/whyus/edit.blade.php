@extends('layout.web')

@section('title', 'بيانات التواصل')

@section('content')

<div class="row">
    <!-- left column -->
    <div class="col-md-10">
            <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">تعديل</h3>
        </div>






                  <form action="{{route('whyus.update',$row->id)}}" method="POST">
                @method('PUT')
				  @csrf
                  <div class="box-body">


                    <div class="col-sm-6">
                        <div class="form-group">
                            <label  >{{ __('  العنوان عربى') }}</label>
                                <input type="text" id="newTitle" name="ar_title" value="{{$row->ar_title}}" class="form-control"
                                   placeholder=" العنوان">
                            </div>
                        </div>
                        <div class="col-sm-6">
                        <div class="form-group">
                            <label  >{{ __('  العنوان انجليزى') }}</label>
                                <input type="text" id="newTitle" name="en_title" value="{{$row->en_title}}" class="form-control"
                                   placeholder=" العنوان">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label  >{{ __('  النص عربى') }}</label>
                                <textarea class="form-control summernote" name="ar_brief">{{$row->ar_brief}}</textarea>


                            </div>
                            </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label  >{{ __('  النص انجليزى') }}</label>
                                <textarea class="form-control summernote" name="en_breif">{{$row->en_breif}}</textarea>


                            </div>
                    </div>
                <div class="col-xs-6 col-sm-6 col-md-6 text-center">
                    <button type="submit" class="btn btn-primary">حفظ</button>
                    <a href="{{route('whyus.index')}}" class="btn btn-danger">إلغاء</a>
                </div>
                </div>

                  </form>
              </div>
    </div>

@endsection
