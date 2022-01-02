
@extends('layout.web')

@section('title', 'الاوردر')

@section('content')



<div class="box">
    <div class="box-header">
      <h3 class="box-title"> عرض الاوردر</h3>

    </div><!-- /.box-header -->
    <div class="box-body">

            <div class="box-body">
                <table id="table" data-toggle="table" data-pagination="true" data-search="true"  data-resizable="true" data-cookie="true"
                    data-show-export="true" data-locale="ar-SA"  style="direction: rtl" >
               						<thead>
                                        <th data-field="state" data-checkbox="false"></th>
                                        <th data-field="id">#</th>
            <th>رقم الاوردر </th>
            <th>اسم المستخدم </th>

            <th>  العنوان</th>
            <th>  تاريخ الاوردر</th>
            <th>  اجمالى قبل الدليفرى</th>
            <th>قيمه الدليفرى</th>
            <th>  الاجمالى</th>
            <th>  الحالة</th>
            <th>الإجراءات</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($rows as $index => $row)
            <tr>
                <td></td>
                <td>{{ $index + 1 }}</td>
                <td>{{ $row->order_no ?? '' }} </td>
                <td>{{ $row->user->username ?? '' }} </td>
                <td>{{ $row->address ?? '' }} </td>

                <td>{{ $row->order_date ?? '' }} </td>
                <td>{{ $row->subtotally ?? '' }} </td>
                <td>{{ $row->delivery_cost ?? '' }} </td>
                <td>{{ $row->subtotally + $row->delivery_cost }} </td>

                <td>@if($row->status==1) تم الاستلام @elseif ($row->status==0) لم يتم الاستلام @else  تم الالغاء @endif </td>
                <td>
                    <div class="btn-group">
                        <a href="{{ route('admin-order.edit', $row->id) }}">
                            <p class=" fa fa-cogs"></p>

                    </div>
                </th>
            </tr>
            <!-- Delete Modal -->
            <div class="modal modal-danger" id="del18{{ $row->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="{{ route('admin-cart.destroy', $row->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-content">
                            <div class="modal-header ">
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h5 class="modal-title" id="exampleModalLabel">تأكيد الحذف</h5>
                                </button>
                            </div>
                            <div class="modal-body bg-light">
                                <p><i class="fa fa-fire "></i></p>
                                <p>حذف جميع البيانات ؟</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline pull-left"
                                    data-dismiss="modal">الغاء</button>
                                <button type="submit" class="btn btn-outline">حفظ </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


        @endforeach
    </tbody>
    </table>

</div>
</div>
</div>
</div>
</div>

@endsection




