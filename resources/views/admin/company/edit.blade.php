@extends('layout.web')

@section('title', 'عن الشركة')

@section('content')

<div class="row">
    <!-- left column -->
    <div class="col-md-10">
            <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">تعديل</h3>
        </div>






                  <form action="{{route('admin-company.update',$row->id)}}" method="POST">
                @method('PUT')
				  @csrf
                  <div class="box-body">


                    <div class="col-sm-6">
                        <div class="form-group">
                            <label  >{{ __(' عن الشركه عربى') }}</label>
                                <input type="text" id="newTitle" name="ar_about_title" value="{{$row->ar_about_title}}" class="form-control"
                                   placeholder=" عن الشركه عربى">
                            </div>
                        </div>
                        <div class="col-sm-6">
                        <div class="form-group">
                            <label  >{{ __('عن الشركه انجليزى') }}</label>
                                <input type="text" id="newTitle" name="en_about_title" value="{{$row->en_about_title}}" class="form-control"
                                   placeholder=" عن الشركه انجليزى">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label  >{{ __('  نص عنا عربي') }}</label>
                                <textarea class="form-control summernote" name="ar_about">{{$row->ar_about}}</textarea>


                            </div>
                            </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label  >{{ __(' نص عنا انجليزى') }}</label>
                                <textarea class="form-control summernote" name="en_about">{{$row->en_about}}</textarea>


                            </div>
                    </div>
                    <hr>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label  >{{ __(' عن الشركه 2  عربى') }}</label>
                                <input type="text" id="newTitle" name="ar_vision_title" value="{{$row->ar_vision_title}}" class="form-control"
                                   placeholder=" عن الشركه عربى">
                            </div>
                        </div>
                        <div class="col-sm-6">
                        <div class="form-group">
                            <label  >{{ __('عن الشركه  2 انجليزى') }}</label>
                                <input type="text" id="newTitle" name="en_vision_title" value="{{$row->en_vision_title}}" class="form-control"
                                   placeholder=" عن الشركه انجليزى">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label  >{{ __('  نص عنا 2 عربي') }}</label>
                                <textarea class="form-control summernote" name="ar_vision">{{$row->ar_vision}}</textarea>


                            </div>
                            </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label  >{{ __(' نص عنا 2 انجليزى') }}</label>
                                <textarea class="form-control summernote" name="en_vision">{{$row->en_vision}}</textarea>


                            </div>
                    </div>
                    <hr>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label  >{{ __(' عن الشركه 3 عربى') }}</label>
                                <input type="text" id="newTitle" name="ar_mission_title" value="{{$row->ar_mission_title}}" class="form-control"
                                   placeholder=" عن الشركه عربى">
                            </div>
                        </div>
                        <div class="col-sm-6">
                        <div class="form-group">
                            <label  >{{ __('عن الشركه 3 انجليزى') }}</label>
                                <input type="text" id="newTitle" name="en_mission_title" value="{{$row->en_mission_title}}" class="form-control"
                                   placeholder=" عن الشركه انجليزى">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label  >{{ __('  نص عنا 3 عربي') }}</label>
                                <textarea class="form-control summernote" name="ar_mission">{{$row->ar_mission}}</textarea>


                            </div>
                            </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label  >{{ __(' نص عنا 3 انجليزى') }}</label>
                                <textarea class="form-control summernote" name="en_mission">{{$row->en_mission}}</textarea>


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
