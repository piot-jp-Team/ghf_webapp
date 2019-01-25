@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">データリスト</div>

                <div class="card-body">
					<div class="page-header clearfix">
						<h1>
							<i class="glyphicon glyphicon-align-justify"></i> Sensdata
							<a class="btn btn-success pull-right" href="{{ route('sensdata.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
						</h1>

					</div>

					<div class="row">
						<div class="col-md-12">
							@if($sensdatas->count())
                                                                                    <div class="row">
                                                                                        <div class="col-lg-8">
                                                                                            <div class="row">
                                                                                                
                                                                                                <div class="col-xs-4 col-md-1">id </div>
                                                                                                <div class="col-xs-4 col-md-1">sensoer_id</div>
                                                                                                <div class="col-xs-4 col-md-1">sddate</div>
                                                                                                <div class="col-xs-4 col-md-1">sdtime</div>
                                                                                                <div class="col-xs-4 col-md-1">sddatetime</div>
                                                                                                <div class="col-xs-4 col-md-1">sddvalue </div>
                                                                                                <div class="col-xs-4 col-md-1">sdivalue </div>
                                                                                                <div class="col-xs-4 col-md-1">sdflug </div>
																								<div class="col-xs-4 col-md-1">ctgain </div>
																								<div class="col-xs-4 col-md-1">ctoffset </div>
                                                                                                <div class="col-xs-4 col-md-1">project_id</div>
                                                                                                <div class="col-xs-4 col-md-1">created_at</div>
                                                                                                <div class="col-xs-4 col-md-1">updated_at</div>
                                                                                            </div>
                                                                                        </div>
                                                                                            <div class="col-lg-4">
																								<button class="btn btn-xs btn-default"  disabled="disabled"><i class="glyphicon glyphicon-eye-open"></i>View</button>
																								<button class="btn btn-xs btn-default"  disabled="disabled"><i class="glyphicon glyphicon-edit"></i>Edit</button>
																								<button class="btn btn-xs btn-default"  disabled="disabled"><i class="glyphicon glyphicon-trash"></i>Delete</button>

                                                                                            </div>
                                                                                        </div>
                                                                                       


									
										@foreach($sensdatas as $sensdata)
                                                                                <div class="row">
                                                                                    <div class="col-lg-8">
                                                                                        <div class="row">
												<div class="col-xs-4 col-md-1">{{$sensdata->id}}</div>
												<div class="col-xs-4 col-md-1">{{$sensdata->sensoer_id}}</div>
												<div class="col-xs-4 col-md-1">{{$sensdata->sddate}}</div>
												<div class="col-xs-4 col-md-1">{{$sensdata->sdtime}}</div>
												<div class="col-xs-4 col-md-1">{{$sensdata->sddatetime}}</div>
												<div class="col-xs-4 col-md-1">{{$sensdata->sddvalue}}</div>
												<div class="col-xs-4 col-md-1">{{$sensdata->sdivalue}}</div>
												<div class="col-xs-4 col-md-1">{{$sensdata->sdflug}}</div>
												<div class="col-xs-4 col-md-1">{{$sensdata->ctgain}}</div>
												<div class="col-xs-4 col-md-1">{{$sensdata->ctoffset}}</div>
												<div class="col-xs-4 col-md-1">{{$sensdata->project_id}} {{ $sensdata->projectatuser->name }}</div>
												<div class="col-xs-4 col-md-1">{{$sensdata->created_at}}</div>
												<div class="col-xs-4 col-md-1">{{$sensdata->updated_at}}</div>
												
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-4">
													<a class="btn btn-xs btn-primary" href="{{ route('sensdata.show', $sensdata->id) }}"><i class="glyphicon glyphicon-eye-open"></i> View</a>
													<a class="btn btn-xs btn-warning" href="{{ route('sensdata.edit', $sensdata->id) }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
													<form action="{{ route('sensdata.destroy', $sensdata->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
														<input type="hidden" name="_method" value="DELETE">
														<input type="hidden" name="_token" value="{{ csrf_token() }}">
														<button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
													</form>
                                                                                    </div>
										</div>		
											
										@endforeach
									
								
								{!! $sensdatas->render() !!}
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