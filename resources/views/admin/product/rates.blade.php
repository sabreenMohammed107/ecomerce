
    <div class="box-body">

<table id="example1" class="table table-bordered table-striped">
<thead class="bg-info">
    <tr>
        <th>#</th>
        <th>اسم المستخدم </th>

        <th> التقييم</th>
        <th>التعليق عربى</th>


        <th>الإجراءات</th>
    </tr>
</thead>
<tbody>
    @foreach ($rates as $index => $row)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $row->user->username ?? '' }} </td>
            <td> @foreach (range(1, 5) as $i)

                @if ($row->rate_no >= $i)
                    <i class="fa fa-star"></i>
                @else
                    <i class="fa fa-star-o" aria-hidden="true"></i>
                @endif


            @endforeach </td>

            <td>{{ $row->ar_comment ?? '' }} </td>


            <td>
                <div class="btn-group">
                    <a href="#edit-rate{{ $row->id }}" data-toggle="modal" data-target="#edit-rate{{$row->id}}"><p class=" fa fa-cogs"></p></button>
                        @can('delete')
                        <a href="#del18{{ $row->id }}" data-toggle="modal"
                        data-target="#del18{{ $row->id }}"><p class="fa  fa-times"></p></button>
                                         @endcan

                </div>
            </td>
        </tr>
        <!-- Delete Modal -->
        <div class="modal modal-danger" id="del18{{ $row->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="{{ route('productRate.destroy', $row->id) }}" method="POST">
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
        <div class="modal fade dir-rtl" id="edit-rate{{ $row->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h5 class="modal-title" id="exampleModalLabel"> عرض البيانات </h5>
                        <button type="button" class="close m-0 p-0 text-white" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <h3><i class="fa fa-eye text-success"></i></h3>
                        <form action="{{route('productRate.update',$row->id)}}" method="POST" enctype="multipart/form-data" >
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="product_id" value="@isset($product)
                    {{ $product->id }}
                @endisset">
                            <div class="card-body">
                                <div class="row">


                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>اسم المستخدم :  {{ $row->user->username ?? '' }}</label>

                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                   <span class="px-1"> التقييم :</span>
                                                    @foreach (range(1, 5) as $i)

                                                    @if ($row->rate_no >= $i)
                                                        <i class="fa fa-star"></i>
                                                    @else
                                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                                    @endif


                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label> التعليق</label>
                                                    <input type="text"
                                                        name="ar_value_text"
                                                        class="form-control" readonly  value="{{ $row->ar_comment }}">

                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <div class="checkbox">
                                                  <label>
                                                    {{ __('عرض') }}
                                                    <input type="checkbox" @if($product->show==1) checked @endif id="newTitle" name="show"  value="1"/>

                                                  </label>
                                                </div>

                                        </div>

                                        {{-- <div class="col-md-6">
                                            <div class="form-group">
                                                <label>النص انجليزى</label>
                                                <div class="input-group">
                                                    <input type="text"
                                                        name="en_value_text"
                                                        class="form-control"   value="{{ $row->en_comment }}">

                                                </div>
                                            </div>
                                        </div> --}}




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




