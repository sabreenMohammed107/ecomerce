
    <div class="box-body">


<h3 class="card-title float-sm-left"><a href="" class="btn btn-success" data-toggle="modal"
    data-target="#add-tab7">إضافة</a></h3>
<table id="example1" class="table table-bordered table-striped">


    <thead class="bg-info">
        <tr>
            <th>#</th>
            <th>اسم الصورة</th>

            <th>تحميل الملف</th>


            <th>الإجراءات</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($attachments as $index=>$row)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td><img src="{{ asset('uploads/attachment')}}/{{$row->img}}" widtd="100" height="100" alt="">
               </td>

            <td>
                <div class="btn-group">
                    <a  id="downloadCurrent" href="{{ asset('uploads/attachment')}}/{{$row->img}}" download="" class="btn btn-default"><i class="fa fa-download" title="download"></i>
                    {{-- <input type="text" name="attach" value="{{ asset('uploads/attachment')}}/{{$row->name}}" alt="{{$row->name}}" /> --}}
                </a>
                </div>
            </td>


            <td>
                <div class="btn-group">

                    <a href="#edit-tab7{{ $row->id }}" data-toggle="modal" data-target="#edit-tab7{{$row->id}}"><p class=" fa fa-cogs"></p></button>
                    @can('delete')
                    <a href="#del7{{ $row->id }}" data-toggle="modal"
                    data-target="#del7{{ $row->id }}"><p class="fa  fa-times"></p></button>
                                     @endcan
                    </div>
                </td>
            </tr>
<!-- Delete Modal -->
<div class="modal modal-danger" id="del7{{ $row->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('attachment.destroy', $row->id) }}" method="POST">
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
 <div class="modal modal-light" id="edit-tab7{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel">تعديل بيانات المرفقات</h5>
                <button type="button" class="close m-0 p-0 text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <h3><i class="fa fa-edit text-success"></i></h3>
                <form action="{{route('attachment.update',$row->id)}}" method="POST" enctype="multipart/form-data" >
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="product_id" value="@isset($product)
                    {{$product->id}}
                    @endisset">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">اضافة  صورة</label>

                                </div>
                                <div class="custom-file">
                                    <input type="file" name="img" class="custom-file-input" id="inputGroupFile02"/>
                                    <label class="custom-file-label" for="inputGroupFile02"> {{$row->img}}</label>
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
      <div class="modal modal-light" id="add-tab7" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title" id="exampleModalLabel">إضافة  الصورة</h5>
                    <button type="button" class="close m-0 p-0 text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <h3><i class="fa fa-edit text-success"></i></h3>
                    <form action="{{route('attachment.store')}}" method="POST" enctype="multipart/form-data" >
                        @csrf
                        <input type="hidden" name="product_id" value="@isset($product)
                        {{$product->id}}
                        @endisset">
                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">اضافة  صورة</label>
                                        {{-- <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="name" id="customFile">
                                            <label class="custom-file-label" for="customFile">إختار ملف</label>
                                        </div> --}}

                                        <div class="custom-file">
                                            <input type="file" name="img" class="custom-file-input" id="inputGroupFile02"/>
                                            {{-- <label class="custom-file-label" for="inputGroupFile02">إختار ملف</label> --}}
                                        </div>
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

