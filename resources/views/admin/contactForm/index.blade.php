@extends('layout.web')

@section('title', 'بريد التواصل')

@section('content')





            <div class="box">
                <div class="box-header">
                  <h3 class="box-title">  البيانات</h3>

                </div>
            <div class="box-body">

                <div class="box-body">
                    <table id="table" data-toggle="table" data-pagination="true" data-search="true"  data-resizable="true" data-cookie="true"
                    data-show-export="true" data-locale="ar-SA"  style="direction: rtl" >
               						<thead>
                                        <th data-field="state" data-checkbox="false"></th>
                                        <th data-field="id">#</th>
                            <th>  تليفون</th>
                            <th> الاسم </th>
                            <th> البريد الالكتروني</th>
                            <th>  الرسالة</th>
						</thead>
						<tbody>
						@foreach($rows as $index => $row)
							<tr>
                                <td></td>
							<td>{{ $index +1 }}</td>
                            <td>{{$row->mobile}} </td>
                            <td>{{$row->name}} </td>
                            <td>{{$row->email}} </td>
                            <td>{{$row->message}} </td>
							</tr>

							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
