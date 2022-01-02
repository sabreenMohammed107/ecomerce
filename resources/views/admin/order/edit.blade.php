@extends('layout.web')
@section('title', 'إدارة الاوردر')

@section('content')
<div class="row">
    <!-- left column -->
    <div class="col-md-10">
            <div class="box box-primary px-5">
        <div class="box-header">
          <h3 class="box-title"> بيانات  الاوردر</h3>
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
                                                        الاوردر</a>
                                                </li>



                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content" id="custom-tabs-one-tabContent">
                                                <div class="tab-pane fade in active" id="custom-tabs-one-1"
                                                    role="tabpanel" aria-labelledby="custom-tabs-one-1-tab">
                                                    <div class="card card-primary">
                                                        <!-- form start -->
                                                        <form action="{{route('admin-order.update',$row->id)}}" method="POST">
                                                            @method('PUT')
                                                              @csrf
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="">   رقم الاوردر</label>
                                                                            <input type="text" readonly
                                                                                value="{{ $row->order_no ?? '' }}"
                                                                                name="ar_name" class="form-control" id="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="">  اسم المستخدم</label>
                                                                            <input type="text" readonly
                                                                                value="{{ $row->user->username ?? '' }}"
                                                                                name="ar_name" class="form-control" id="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="">   العنوان</label>
                                                                            <input type="text" readonly
                                                                                value="{{ $row->address ?? '' }} "
                                                                                name="en_name" class="form-control" id="">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for=""> تاريخ الاوردر</label>
                                                                            <input type="text" readonly
                                                                            value="{{ $row->order_date ?? '' }} "
                                                                            name="order_date" class="form-control" id="">                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for=""> اجمالى قبل الدليفرى</label>
                                                                            <input type="number" readonly
                                                                            value="{{$row->subtotally}}"
                                                                            name="subtotally" class="form-control" id="subtotally">                                                                          </div>
                                                                    </div>


                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="">قيمه الدليفرى</label>
                                                                            <input type="number"
                                                                                value="{{ $row->delivery_cost}}"
                                                                                name="delivery_cost" oninput="changeTotal()" class="form-control"
                                                                                id="delivery_cost">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for=""> اجمالى التكلفه</label>
                                                                            <input type="number"
                                                                                value="{{ $row->total ?? '' }}"
                                                                                name="total" class="form-control"
                                                                                id="total">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="">الحالة</label>
                                                                            <select name="status"
                                                                            class="form-control"
                                                                            id="">

                                                                            <option
                                                                                    value="0"
                                                                                    {{ 0 == $row->status ? 'selected' : '' }}>
                                                                                    لم يتم الاستلام
                                                                                </option>
                                                                                <option
                                                                                    value="1"
                                                                                    {{ 1 == $row->status ? 'selected' : '' }}>
                                                                                     تم الاستلام
                                                                                </option>
                                                                                <option
                                                                                    value="2"
                                                                                    {{ 2 == $row->status ? 'selected' : '' }}>
                                                                                   تم الالغاء
                                                                                </option>

                                                                        </select>

                                                                        </div>
                                                                    </div>

                                                                    </div>
                                                                </div>
                                                                <div class="card-footer">
                                                                    <button type="submit" class="btn btn-primary">حفظ</button>
                                                                    <a href="{{ route('admin-order.index') }}"
                                                                        class="btn btn-danger">إلغاء</a>

                                                                </div>
                                                        </form>
                                                                <hr>
                                                                <table id="example2" class="table table-bordered table-striped">
                                                                    <thead class="bg-info">
                                                                        <tr>
                                                                            <th>#</th>

                                                                            <th> اسم المنتج</th>
                                                                            <th>  السعر</th>
                                                                            <th>الكمية</th>

                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>

                                                                        @foreach ($items as $index => $row)
                                                                            <tr>
                                                                                <th>{{ $index + 1 }}</th>
                                                                                <th>{{ $row->product->ar_name ?? '' }} </th>

                                                                                <th>{{ $row->product->price ?? '' }} </th>
                                                                                <th>{{ $row->quantity ?? '' }} </th>


                                                                            </tr>
                                                                            @endforeach

                                                                        </tbody>
                                                                        </table>
                                                                <!-- /.card-body -->

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

        @section('scripts')
        <script>
            function changeTotal(){
var subtotally=$('#subtotally').val();
 var delivery_cost=$('#delivery_cost').val();
 $('#total').val((parseFloat(delivery_cost) + parseFloat(subtotally)));

// $("#total").attr('value', ((parseFloat(subtotally) + parseFloat(delivery_cost))));
}
            </script>

        @endsection
