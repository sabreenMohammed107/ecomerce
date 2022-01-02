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




                <form action="{{ route('articles.update',$row->id) }}"  id="form-id" method="post" enctype="multipart/form-data" >
                    @method('PUT')
                    @csrf
                <div class="box-body">
                    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>عنوان المقال عربى:</strong>
            <input type="text"
            value="{{$row->ar_title}}"
            name="ar_title" class="form-control" id="">
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>عنوان المقال انجليزي:</strong>
            <input type="text"
            value="{{$row->en_title}}"
            name="en_title" class="form-control" id="">
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label for="">النص عريى</label>
            <textarea class="form-control summernote" name="ar_text">{{$row->ar_text}}</textarea>

           </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label for="">النص انجليزى</label>
            <textarea class="form-control summernote" name="en_text">{{$row->en_text}}</textarea>

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
                    for="inputGroupFile02">{{ $row->img }}</label>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>الروابط:</strong>
            <select class="form-control" id="tag" name="tag[]" multiple>
                @foreach ($tags as $tag)
                                {{-- <option value="{{$branch->id}}" {{ ( $user->id == $inv->type_id) ? 'selected' : '' }}>{{$branch->name}}</option> --}}
                @if(in_array($tag->id, $selectTags))
                        <option value="{{ $tag->id }}" selected="true">{{ $tag->ar_name }}</option>
                        @else
                        <option value="{{ $tag->id }}">{{ $tag->ar_name }}</option>
                        @endif
                @endforeach
               </select>


        </div>
    </div>




    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">حفظ</button>
        <a href="{{route('articles.index')}}" class="btn btn-danger">إلغاء</a>

    </div>
</div>
                </form>
                        </div>
        </div>
    </div>
</div>
@endsection
