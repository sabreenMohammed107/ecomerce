@extends('layout.web')

@section('title', 'العملاء')

@section('content')




    <div class="box">
        <div class="box-header">
            <h3 class="box-title">بيانات الرئيسية</h3>
            {{-- <a href="{{ route('users.create') }}" class="btn btn-info btn-lg pull-right"> اضافة </a> --}}

        </div><!-- /.box-header -->
        <div class="box-body"  >

            {{-- <div class="box-body"> --}}


                    <table id="table" data-toggle="table" data-pagination="true" data-search="true"  data-resizable="true" data-cookie="true"
                    data-show-export="true" data-locale="ar-SA"  style="direction: rtl" >
               						<thead>
                                        <th data-field="state" data-checkbox="false"></th>
                                        <th data-field="id">#</th>
                            <th>الاسم كامل</th>
                            <th>اسم العميل</th>
                            <th>البريد الالكتروني </th>
                            <th>التليفون </th>
                            {{-- <th>الحالة</th> --}}

                            <th>الاجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $index => $row)
                            <tr>
                               <td></td>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $row->f_name . ' ' . $row->l_name }}</td>
                                <td>{{ $row->username }}</td>
                                <td>{{ $row->email }}</td>
                                <td>{{ $row->phone }}</td>

                                {{-- <td>
                                @if ($row->status == 1)
                                <span class="badge badge-success">نشط</span>
                                @else
                                <span class="badge badge-danger">غير نشظ</span>
                                @endif
                            </td> --}}
                                <td>
                                    <div class="btn-group">


                                            <a href="{{ route('clients.show', $row->id) }}">
                                                <p class=" fa fa-eye"></p>
                                            </a>


                                            <a href="#del{{ $row->id }}" data-toggle="modal"
                                                data-target="#del{{ $row->id }}">
                                                <p class="fa  fa-times"></p>
                                            </a>

                                    </div>
                                </td>
                            </tr>
                            <!--/Edit Customer-->
                            <!-- Delete Modal -->

                            <div class="modal modal-danger" id="del{{ $row->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form action="{{ route('clients.destroy', $row->id) }}" method="POST">
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

            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
    </div>
    <!-- /.row -->
@endsection
@section('style')
<link rel="stylesheet" href="{{ asset('webassets/plugins/test/data-table/bootstrap-table.css') }}">
        <link rel="stylesheet" href="{{ asset('webassets/plugins/test/data-table/bootstrap-editable.css') }}">
        <style>
            .fixed-table-toolbar .bs-bars, .fixed-table-toolbar .search, .fixed-table-toolbar .columns {
                float: right !important;
            }
        </style>
@endsection
@section('scripts')
 <!-- data table JS
		============================================ -->


 {{-- <script src="{{asset('webassets/plugins/data-table/bootstrap-table.js')}}"></script> --}}

 {{-- <script src="{{asset('webassets/js/customDataTable.js')}}"></script> --}}
    <script>

        $(document).ready(function() {

            $("#example1").dataTable();
            $('#example2').dataTable({
                "bPaginate": true,
                "bLengthChange": false,
                "bFilter": false,
                "bSort": true,
                "bInfo": true,
                "bAutoWidth": false
            });
        });
    </script>
@endsection
