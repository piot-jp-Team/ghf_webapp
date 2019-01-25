@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">ユニット</div>

                <div class="card-body">
					<div class="page-header clearfix">
						<h1>
							<i class="glyphicon glyphicon-align-justify"></i> Sensunit
							<a class="btn btn-success pull-right" href="{{ route('sensunit.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
						</h1>

					</div>

					<div class="row">
						<div class="col-md-12">
							@if($sensunits->count())
								<table class="table table-condensed table-striped">
									<thead>
										<tr>
											<th>id </th>
											<th>name</th>
											<th>channel</th>
											<th>shield_id</th>
											<th>project_id </th>
											<th>created_at </th>
											<th>updated_at</th>
											<th></th>
											<th></th>
											<th></th>
										</tr>
									</thead>

									<tbody>
										@foreach($sensunits as $sensunit)
											<tr>
												<td>{{$sensunit->id}}</td>
												<td>{{$sensunit->name}}</td>
												<td>{{$sensunit->channel}}</td>
												<td>{{$sensunit->shield_id}}{{ $sensunit->shieldmodule->name }}</td>
		
												<td>{{$sensunit->project_id}}{{ $sensunit->projectatuser->name }}</td>
												<td>{{$sensunit->created_at}}</td>
												<td>{{$sensunit->updated_at}}</td>
												<td class="text-right">
													<a class="btn btn-xs btn-primary" href="{{ route('sensunit.show', $sensunit->id) }}"><i class="glyphicon glyphicon-eye-open"></i> View</a>
													<a class="btn btn-xs btn-warning" href="{{ route('sensunit.edit', $sensunit->id) }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
													<form action="{{ route('sensunit.destroy', $sensunit->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
														<input type="hidden" name="_method" value="DELETE">
														<input type="hidden" name="_token" value="{{ csrf_token() }}">
														<button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
													</form>
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>
								{!! $sensunits->render() !!}
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