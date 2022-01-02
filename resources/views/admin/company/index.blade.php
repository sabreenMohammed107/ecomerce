@extends('layout.web')

@section('title', ' عن الشركة')

@section('content')


<div class="box">
    <div class="box-header">
      <h3 class="box-title">عن الشركة</h3>
      {{-- <a href="{{ route('admin-company.create') }}" class="btn btn-info btn-lg pull-right"> اضافة </a> --}}

    </div><!-- /.box-header -->
    <div class="box-body">

            <div class="box-body">
                <table id="table" data-toggle="table" data-pagination="true" data-search="true"  data-resizable="true" data-cookie="true"
                data-show-export="true" data-locale="ar-SA"  style="direction: rtl" >
                                   <thead>
                                    <th data-field="state" data-checkbox="false"></th>
                                    <th data-field="id">#</th>
                                        <th>عن  عربى </th>
                                        <th>عن  انجليزى</th>
                                        <th>  نص عنا عربي</th>
                                        <th>نص عنا انجليزى</th>

                                        <th>عن  2 عربى </th>
                                        <th>عن  2 انجليزى</th>
                                        <th>  نص عنا 2 عربي</th>
                                        <th>نص عنا 2 انجليزى</th>

                                        <th>عن  3 عربى </th>
                                        <th>عن 3 انجليزى</th>
                                        <th>  نص عنا 3 عربي</th>
                                        <th>نص عنا 3 انجليزى</th>
							<th>{{ __('الإجراء') }}</th>
						</thead>
						<tbody>
						@foreach($rows as $index => $row)
							<tr>
                                <td></td>
                                <td>{{ $index + 1 }}</td>
                                <td>{{$row->ar_about_title}}</td>
                                <td>{{$row->en_about_title}}</td>
                                <td>
                                    {{Illuminate\Support\Str::limit(strip_tags($row->ar_about ?? ''), $limit = 100, $end = '...')}}
                                </td>

                                <td>
                                     {{Illuminate\Support\Str::limit(strip_tags($row->en_about ?? ''), $limit = 100, $end = '...')}}

                                </td>

                                <td>{{$row->ar_vision_title}}</td>
                                <td>{{$row->en_vision_title}}</td>
                                <td>
                                    {{Illuminate\Support\Str::limit(strip_tags($row->ar_vision ?? ''), $limit = 100, $end = '...')}}
                                </td>

                                <td>
                                     {{Illuminate\Support\Str::limit(strip_tags($row->en_vision ?? ''), $limit = 100, $end = '...')}}
                                </td>


                                <td>{{$row->ar_mission_title}}</td>
                                <td>{{$row->en_mission_title}}</td>
                                <td>
                                     {{Illuminate\Support\Str::limit(strip_tags($row->ar_mission ?? ''), $limit = 100, $end = '...')}}
                                </td>

                                <td>
                                    {{Illuminate\Support\Str::limit(strip_tags($row->en_mission ?? ''), $limit = 100, $end = '...')}}
                                </th>

                                      <td>
                                        <div class="btn-group">
                                            @can('edit')

                                            <a href="{{ route('admin-company.edit', $row->id) }}">
                                                <p class=" fa fa-cogs"></p>
                                            </a>

                                        @endcan


                                        </div>
                                    </td>
							</tr>

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


