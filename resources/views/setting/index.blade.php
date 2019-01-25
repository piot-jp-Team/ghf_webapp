@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">設定</div>

                <div class="card-body">
					<div class="page-header clearfix">
						<h1>
							<i class="glyphicon glyphicon-align-justify"></i> Setting
							<a class="btn btn-success pull-right" href="{{ route('setting.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
						</h1>

					</div>

					<div class="row">
						<div class="col-md-12">
							@if($settings->count())
								<table class="table table-condensed table-striped">
									<thead>
										<tr>
											<th>id </th>
											<th>settingGroup</th>
											<th>settingName</th>
											<th>settingString</th>
											<th>settingValue</th>
											<th>project_id </th>
											<th>created_at </th>
											<th>updated_at</th>
											<th></th>
											<th></th>
											<th></th>
										</tr>
									</thead>

									<tbody>
										@foreach($settings as $setting)
											<tr>
												<td>{{$setting->id}}</td>
												<td>{{$setting->settingGroup}}</td>
												<td>{{$setting->settingName}}</td>
												<td>{{$setting->settingString}}</td>
												<td>{{$setting->settingValue}}</td>
												<td>{{$setting->project_id}} {{ $setting->projectatuser->name }}</td>
												<td>{{$setting->created_at}}</td>
												<td>{{$setting->updated_at}}</td>
												<td class="text-right">
													<a class="btn btn-xs btn-primary" href="{{ route('setting.show', $setting->id) }}"><i class="glyphicon glyphicon-eye-open"></i> View</a>
													<a class="btn btn-xs btn-warning" href="{{ route('setting.edit', $setting->id) }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
													<form action="{{ route('setting.destroy', $setting->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
														<input type="hidden" name="_method" value="DELETE">
														<input type="hidden" name="_token" value="{{ csrf_token() }}">
														<button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
													</form>
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>
								{!! $settings->render() !!}
							@else
								<h3 class="text-center alert alert-info">Empty!</h3>
							@endif

						</div>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection