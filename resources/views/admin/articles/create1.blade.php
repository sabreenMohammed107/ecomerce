@extends('layout.web')


@section('content')
<div class="row px-5">
    <div class="col-lg-6 margin-tb">
        <div class="pull-left">
            <h2>إنشاء مقال</h2>
        </div>

    </div>
</div>






{!! Form::open(['method' => 'POST', 'route' => ['articles.store']]) !!}


        <div class="panel-body">
            <div class="row arabic px-5">
                <div class="col-xs-6 col-sm-6 col-md-6 arabic">
                <div class="col-xs-12 form-group">
                    {!! Form::label('title', 'Title', ['class' => 'control-label']) !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('title'))
                        <p class="help-block">
                            {{ $errors->first('title') }}
                        </p>
                    @endif
                </div>
                </div>
            </div>
            <div class="row arabic px-5">
                <div class="col-xs-6 col-sm-6 col-md-6 arabic">
                <div class="col-xs-12 form-group">
                    {!! Form::label('article_text', 'Article Text', ['class' => 'control-label']) !!}
                    {!! Form::textarea('article_text', old('article_text'), ['class' => 'form-control ', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('article_text'))
                        <p class="help-block">
                            {{ $errors->first('article_text') }}
                        </p>
                    @endif
                </div>
                </div>
            </div>
            <div class="row arabic px-5">
                <div class="col-xs-6 col-sm-6 col-md-6 arabic">
                <div class="col-xs-12 form-group">
                    {!! Form::label('tag', 'Tags', ['class' => 'control-label']) !!}
                    <button type="button" class="btn btn-primary btn-xs" id="selectbtn-tag">
                        Select all
                    </button>
                    <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-tag">
                        Deselect all
                    </button>
                    {!! Form::select('tag[]', $tags, old('tag'), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-tag' ]) !!}
                    <p class="help-block"></p>
                    @if($errors->has('tag'))
                        <p class="help-block">
                            {{ $errors->first('tag') }}
                        </p>
                    @endif
                </div>
            </div>
            </div>
        </div>
    </div>

    <div class="col-xs-6 col-sm-6 col-md-6 text-center">
        <button type="submit" class="btn btn-primary">حفظ</button>
        <a href="{{route('users.index')}}" class="btn btn-danger">إلغاء</a>
    </div>
        {!! Form::close() !!}

@endsection
@section('scripts')
<script>
    $("#selectbtn-tag").click(function(){
        $("#selectall-tag > option").prop("selected","selected");
        $("#selectall-tag").trigger("change");
    });
    $("#deselectbtn-tag").click(function(){
        $("#selectall-tag > option").prop("selected","");
        $("#selectall-tag").trigger("change");
    });

    $(document).ready(function () {
        $('.select2').select2();
    });
</script>
@endsection
