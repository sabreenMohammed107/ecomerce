@extends('layout.web')
@section('style')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.6/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">

@endsection
@section('title', 'التصنيفات')

@section('content')


<div class="box">
    <div class="box-header">
      <h3 class="box-title">بيانات التصنيفات</h3>
      <a href="{{ route('category.create') }}" class="btn btn-info btn-lg pull-right"> اضافة </a>

    </div><!-- /.box-header -->
    <div class="box-body">

            <div class="box-body">
                <table id="table" data-toggle="table" data-pagination="true" data-search="true"  data-resizable="true" data-cookie="true"
                data-show-export="true" data-locale="ar-SA"  style="direction: rtl" >
                                   <thead>
                                    <th data-field="state" data-checkbox="false"></th>
                                    <th data-field="id">#</th>
                            <th>{{ __('الاسم عربى') }}</th>
                            <th>{{ __('الاسم انجليزى') }}</th>

                            <th>{{ __('الوصف عربى') }}</th>
                            <th>{{ __('الوصف انجليزى') }}</th>
                            <th>{{ __(' الترتيب') }}</th>

							<th>{{ __('الإجراء') }}</th>
						</thead>
						<tbody>
						@foreach($rows as $index => $row)
							<tr>
                                <td></td>
                                <td>{{ $index + 1 }}</td>
			  						<td>{{$row->ar_name}}</td>
                                      <td>{{$row->en_name}}</td>

                                      <td>{!! $row->ar_description !!}</td>
                                      <td>{!! $row->en_description !!}</td>
                                      <td>{{$row->order}}</td>

                                      <td>
                                        <div class="btn-group">
                                            @can('edit')

                                            <a href="{{ route('category.edit', $row->id) }}">
                                                <p class=" fa fa-cogs"></p>
                                            </a>

                                        @endcan
                                        @can('delete')
                                            <a href="#del{{ $row->id }}" data-toggle="modal"
                                                data-target="#del{{ $row->id }}">
                                                <p class="fa  fa-times"></p>
                                            </a>
                                        @endcan

                                        </div>
                                    </td>
							</tr>
                             <!-- Delete Modal -->
                             <div class="modal modal-danger" id="del{{ $row->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <form action="{{ route('category.destroy', $row->id) }}"  method="POST" >
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


