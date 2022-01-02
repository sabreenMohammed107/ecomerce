@extends('layout.web')

@section('title', 'المقالات')

@section('content')

                <div class="row">
                    <!-- left column -->
                    <div class="col-md-10">
                            <div class="box box-primary px-5">
                        <div class="box-header">
                          <h3 class="box-title"> بيانات  المقال</h3>
                        </div>






{{-- {!! Form::open(array('route' => 'articles.store','method'=>'POST')) !!} --}}
<form action="{{route('articles.store')}}" id="form-id" method="post" enctype="multipart/form-data" >
    @csrf
    <div class="box-body">
        <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>عنوان المقال عربى:</strong>
            {!! Form::text('ar_title', null, array('placeholder' => 'عنوان المقال عربي','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>عنوان المقال انجليزي:</strong>
            {!! Form::text('en_title', null, array('placeholder' => 'عنوان المقال انجليزى','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label for="">النص عريى</label>
            <textarea class="form-control summernote" name="ar_text">{{ old('ar_text') }}</textarea>

           </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label for="">النص انجليزى</label>
            <textarea class="form-control summernote" name="en_text">{{ old('en_text') }}</textarea>

           </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label for="">اضافة  صورة</label>
            {{-- <div class="custom-file">
                <input type="file" class="custom-file-input" name="name" id="customFile">
                <label class="custom-file-label" for="customFile">إختار ملف</label>
            </div> --}}
            <input type="file" name="img" class="custom-file-input"
            id="inputGroupFile02" />

            {{-- <div class="custom-file">
                <input type="file" name="img" class="custom-file-input" id="inputGroupFile02"/>
                <label class="custom-file-label" for="inputGroupFile02">إختار ملف</label>
            </div> --}}
        </div>
    </div>


    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>الروابط:</strong> <button type="button" class="btn btn-default" onclick="show1();"><i class="fas fa-plus"></i>رابط جديد</button>
           <style>
               .hide{
                   display: none;
               }
           </style>
            <div id="addingTag" class="modal-body text-center" style="display: none">
                <div class="form-group col-md-12" >
                    <label for="">الاسم عريى</label>
                    <input type="text" class="form-control" value="" name="ar_name">
                </div>
                <div class="form-group col-md-12" >
                    <label for="">النص انجليزى</label>
                    <input type="text" class="form-control" value="" name="en_name">
                </div>
                <button name="action" value="save" onclick="document.getElementById('form-id').submit();" class="btn btn-success">تأكيد</button>
            </div>
            {{-- {!! Form::select('branches[]', $branches,[], array('class' => 'form-control ','multiple')) !!} --}}
            <select class="form-control" id="tag" name="tag[]" multiple>
                @foreach ($tags as $tag)
                <option value="{{$tag->id}}">{{$tag->ar_name}}</option>
                @endforeach
               </select>
        </div>
    </div>




    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button name="action" value="confirm" onclick="document.getElementById('form-id').submit();" class="btn btn-primary">حفظ</button>
        <a href="{{route('articles.index')}}" class="btn btn-danger">إلغاء</a>

    </div>
</div>
</form>
            </div>
        </div>
    </div>
</div>


@endsection

@section('scripts')
<script>
      function show1() {
document.getElementById('addingTag').style.display = 'block';
}
</script>
