@extends('layout.web')


@section('content')
<div class="row">
    <!-- left column -->
    <div class="col-md-10">
            <div class="box box-primary px-5">
        <div class="box-header">
          <h3 class="box-title">عرض</h3>
        </div>







{!! Form::model($data, ['method' => 'PATCH','route' => ['users.update', $data->id]]) !!}  <div class="box-body">
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>الاسم الاول:</strong>
            {!! Form::text('f_name', null, array('class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>الاسم الأخير:</strong>
            {!! Form::text('l_name', null, array('class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>إسم المستخدم:</strong>
            {!! Form::text('username', null, array('class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>البريد الإلكترونى:</strong>
            {!! Form::text('email', null, array('class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>رقم التليفون:</strong>
            {!! Form::text('phone', null, array('class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong> العنوان:</strong>
            <input type="text" class="form-control" value="{{$user->address->name ?? ''}}">
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6 text-center">
        {{-- <button type="submit" class="btn btn-primary">حفظ</button> --}}
        <a href="{{route('clients.index')}}" class="btn btn-danger">إلغاء</a>
    </div>
</div>
{!! Form::close() !!}
    </div>
</div>
{{-- </div> --}}

@endsection
