@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">モジュール</div>

                <div class="card-body">
					<div class="page-header clearfix">
						<h1>
							<i class="glyphicon glyphicon-align-justify"></i> Shieldmodule
							<a class="btn btn-success pull-right" href="{{ route('shieldmodule.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
						</h1>

					</div>

					<div class="row">
						<div class="col-md-12">
							@if($shieldmodules->count())
								<table class="table table-condensed table-striped">
									<thead>
										<tr>
											<th>id </th>
											<th>name</th>
											<th>module_id</th>
											<th>project_id </th>
											<th>created_at </th>
											<th>updated_at</th>
											<th></th>
											<th></th>
											<th></th>
										</tr>
									</thead>

									<tbody>
										@foreach($shieldmodules as $shieldmodule)
											<tr>
												<td>{{$shieldmodule->id}}</td>
												<td>{{$shieldmodule->name}}</td>
												<td>{{$shieldmodule->module_id}}</td>
												<td>{{$shieldmodule->project_id}}{{$shieldmodule->projectatuser->name}}</td>
												<td>{{$shieldmodule->created_at}}</td>
												<td>{{$shieldmodule->updated_at}}</td>
												<td class="text-right">
													<a class="btn btn-xs btn-primary" href="{{ route('shieldmodule.show', $shieldmodule->id) }}"><i class="glyphicon glyphicon-eye-open"></i> View</a>
													<a class="btn btn-xs btn-warning" href="{{ route('shieldmodule.edit', $shieldmodule->id) }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
													<form action="{{ route('shieldmodule.destroy', $shieldmodule->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
														<input type="hidden" name="_method" value="DELETE">
														<input type="hidden" name="_token" value="{{ csrf_token() }}">
														<button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
													</form>
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>
								{!! $shieldmodules->render() !!}
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