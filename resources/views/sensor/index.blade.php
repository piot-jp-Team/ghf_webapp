@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">センサー</div>

                <div class="card-body">
					<div class="page-header clearfix">
						<h1>
							<i class="glyphicon glyphicon-align-justify"></i> Sensor
							<a class="btn btn-success pull-right" href="{{ route('sensor.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
						</h1>

					</div>

					<div class="row">
						<div class="col-md-12">
							@if($sensors->count())
								<table class="table table-condensed table-striped">
									<thead>
										<tr>
											<th>id </th>
											<th>name</th>
											<th>address</th>
											<th>sensunit_id</th>
											<th>project_id </th>
											<th>ctgain </th>
											<th>ctoffset </th>
											<th>yscalemax </th>
											<th>yscalemin </th>
											<th>アラート上限 </th>
											<th>アラート下限 </th>
											<th>アラートモード </th>
											<th>created_at </th>
											<th>updated_at</th>
											<th></th>
											<th></th>
											<th></th>
										</tr>
									</thead>

									<tbody>
										@foreach($sensors as $sensor)
											<tr>
												<td>{{$sensor->id}}</td>
												<td>{{$sensor->name}}</td>
												<td>{{$sensor->address}}</td>
												<td>{{$sensor->sensunit_id}} {{ $sensor->sensunit->name }}</td>
												<td>{{$sensor->project_id}} {{ $sensor->projectatuser->name }}</td>
												<td>{{$sensor->ctgain}}</td>
												<td>{{$sensor->ctoffset}}</td>
												<td>{{$sensor->yscalemax}}</td>
												<td>{{$sensor->yscalemin}}</td>
												<td>{{$sensor->limitupper}}</td>
												<td>{{$sensor->limitunder}}</td>
												<td>{{$sensor->alertmode}}</td>
												<td>{{$sensor->created_at}}</td>
												<td>{{$sensor->updated_at}}</td>
												<td class="text-right">
													<a class="btn btn-xs btn-primary" href="{{ route('sensor.show', $sensor->id) }}"><i class="glyphicon glyphicon-eye-open"></i> View</a>
													<a class="btn btn-xs btn-warning" href="{{ route('sensor.edit', $sensor->id) }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
													<form action="{{ route('sensor.destroy', $sensor->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
														<input type="hidden" name="_method" value="DELETE">
														<input type="hidden" name="_token" value="{{ csrf_token() }}">
														<button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
													</form>
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>
								{!! $sensors->render() !!}
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