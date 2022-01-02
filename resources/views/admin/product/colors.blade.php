<div class="box-body">

<h3 class="card-title float-sm-left"><a href="" class="btn btn-success"
    data-toggle="modal" data-target="#add-tab-color">إضافة</a></h3>
<table id="example1" class="table table-bordered table-striped">
    <thead class="bg-info">
        <tr>
            <th>#</th>
            <th>اسم اللون</th>

            <th>رقم اللون</th>


            <th>الإجراءات</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($colors as $index=>$row)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{$row->color->ar_name ?? ''}} </td>
            <td>{{$row->color->colorid ?? ''}} </td>



            <td>
                <div class="btn-group">
                    <a href="#edit-tab7{{ $row->id }}" data-toggle="modal" data-target="#edit-tab7{{$row->id}}"><p class=" fa fa-cogs"></p></button>
                        @can('delete')
                        <a href="#del7{{ $row->id }}" data-toggle="modal"
                        data-target="#del7{{ $row->id }}"><p class="fa  fa-times"></p></button>
                                         @endcan

                    </div>
                </th>
            </tr>
<!-- Delete Modal -->
<div class="modal modal-danger" id="del7{{ $row->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('productColor.destroy', $row->id) }}" method="POST">
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
 <!-- Edit Tab-7 Modal -->
 <div class="modal fade dir-rtl" id="edit-tab7{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel">تعديل البيانات </h5>
                <button type="button" class="close m-0 p-0 text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <h3><i class="fa fa-edit text-success"></i></h3>
                <form action="{{route('productColor.update',$row->id)}}" method="POST" enctype="multipart/form-data" >
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="product_id" value="@isset($product)
                    {{$product->id}}
                    @endisset">
                    <div class="box-body">
                        <div class="box-body">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ __('اللون') }}</label>

                                        <select name="color_id"
                                            class="form-control"
                                            id="">
                                            @foreach ($mainColors as $type)
                                                <option
                                                    value="{{ $type->id }}"
                                                    {{ $type->id == $row->color_id ? 'selected' : '' }}>
                                                    {{ $type->ar_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                </div>
                            </div>




                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-success">تأكيد</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

@endforeach
    </tbody>
</table>

</div>

      <!-- Add Tab-7 Modal -->
      <div class="modal fade dir-rtl" id="add-tab-color" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title" id="exampleModalLabel">إضافة  لون</h5>
                    <button type="button" class="close m-0 p-0 text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <h3><i class="fa fa-edit text-success"></i></h3>
                    <form action="{{route('productColor.store')}}" method="POST" enctype="multipart/form-data" >
                        @csrf
                        <input type="hidden" name="product_id" value="@isset($product)
                        {{$product->id}}
                        @endisset">
                        <div class="box-body">
                            <div class="box-body">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{ __('اللون') }}</label>
                                        {{-- <div class="input-group"> --}}

                                            <select name="color_id" class="form-control" id="">
                                                @foreach ($mainColors as $type)
                                                    <option value="{{ $type->id }}">{{ $type->ar_name }}</option>
                                                @endforeach
                                            </select>
                                        {{-- </div> --}}
                                    </div>
                                </div>


                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                            <button type="submit" class="btn btn-success">تأكيد</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

