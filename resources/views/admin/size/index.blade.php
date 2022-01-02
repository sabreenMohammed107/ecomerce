@extends('layout.web')

@section('title', 'المقاسات')

@section('content')
<div class="box">
                <div class="box-header">
                  <h3 class="box-title">جميع  المقاسات</h3>
                  @can('create')

                  <a href="#" data-toggle="modal" data-target="#addNationalities" class="btn btn-info btn-lg pull-right"> اضافة </a>
                  @endcan

                </div>
            <div class="box-body">

                <div class="box-body">
                    <table id="table" data-toggle="table" data-pagination="true" data-search="true"  data-resizable="true" data-cookie="true"
                    data-show-export="true" data-locale="ar-SA"  style="direction: rtl" >
               						<thead>
                                        <th data-field="state" data-checkbox="false"></th>
                                        <th data-field="id">#</th>
							<th>{{ __('الاسم عربى') }}</th>
                            <th>{{ __('الاسم انجليزى') }}</th>
							<th>{{ __('الإجراء') }}</th>
						</thead>
						<tbody>
						@foreach($rows as $index => $row)
							<tr>
                                <td></td>
							<td>{{ $index +1 }}</td>
			  						<td>{{$row->ar_name}}</td>
                                      <td>{{$row->en_name}}</td>

                                      <td>
                                        <div class="btn-group">

                                            <a href="{{ route('size.edit', $row->id) }}"><p class=" fa fa-cogs"></p></a>
                                            <a href="#del{{$row->id}}" data-toggle="modal" data-target="#del{{$row->id}}"><p class="fa  fa-times"></p></a>
  </div>
                                    </td>
							</tr>
                             <!-- Delete Modal -->
                             <div class="modal modal-danger" id="del{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <form action="{{ route('size.destroy', $row->id) }}"  method="POST" >
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-content">
                                        <div class="modal-header ">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h5 class="modal-title" id="exampleModalLabel">تأكيد الحذف</h5>
                                        </button>
                                        </div>
                                        <div class="modal-body bg-light" >
                                            <p><i class="fa fa-fire "></i></p>
                                            <p>حذف جميع البيانات ؟</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">الغاء</button>
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
<!-- Add Model -->
<div class="modal modal-light" id="addNationalities" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content ">

            <div class="modal-body">

            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <div class="ms-auth-container row no-gutters">
    <h5 class="modal-title" id="exampleModalLabel"> اضافه جديد</h5>

              <div class="box-body">
                  <form action="{{route('size.store')}}" method="POST">
                  @csrf
                      <div class="ms-auth-container ">

                          <div class="col-md-6">

                              <div class="form-group">
                                  <label  >{{ __('الاسم عربى') }}</label>
                                  <div class="input-group">
                                      <input type="text" id="newTitle" name="ar_name" class="form-control"
                                        >
                                  </div>
                              </div>
                          </div>

                          <div class="col-sm-6">
                            <div class="form-group">
                                <label  >{{ __('الاسم انجليزى') }}</label>
                                <div class="input-group">
                                    <input type="text" id="newTitle" name="en_name" class="form-control"
                                      >
                                </div>
                            </div>
                            </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">الغاء</button>
                        <button type="submit" class="btn btn-info">حفظ </button>
                      </div>
                      </div>
                      </form>
                  </div>
      </div>
        </div>
            </div>
          </div>
        </div>
    </div>
    <!-- end model -->
@endsection

