@extends('layout.web')

@section('title', 'المقاسات')

@section('content')
<div class="row">
    <!-- left column -->
    <div class="col-md-10">
            <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">تعديل</h3>
        </div>



                  <form action="{{route('size.update',$row->id)}}" method="POST">
                @method('PUT')
				  @csrf
                  <div class="box-body">
                    <div class="col-md-12">

                        <div class="col-md-6">

                            <div class="form-group">
                                <label  >{{ __('الاسم عربى') }}</label>
                                <div class="input-group">
                                    <input type="text" id="newTitle" name="ar_name" value="{{$row->ar_name}}" class="form-control"
                                      >
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group">
                              <label  >{{ __('الاسم انجليزى') }}</label>
                              <div class="input-group">
                                  <input type="text" id="newTitle" name="en_name" value="{{$row->en_name}}" class="form-control"
                                    >
                              </div>
                          </div>
                          </div>
                    </div>


                      <div class="col-xs-12 col-sm-12 col-md-12 ">
                        <button type="submit" class="btn btn-primary">حفظ</button>
                        <a href="{{route('size.index')}}" class="btn btn-danger">إلغاء</a>
                    </div>
                </div>
            </div>

                  </form>
              </div>

</div>
@endsection
