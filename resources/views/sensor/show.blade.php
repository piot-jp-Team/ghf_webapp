@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">センサー</div>

                <div class="card-body">
					<div class="page-header">
						<h1>Sensor / Show #{{$sensor->id}}</h1>
						<form action="{{ route('sensor.destroy', $sensor->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
							<input type="hidden" name="_method" value="DELETE">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="btn-group pull-right" role="group" aria-label="...">
								<a class="btn btn-warning btn-group" role="group" href="{{ route('sensor.edit', $sensor->id) }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
								<button type="submit" class="btn btn-danger">Delete <i class="glyphicon glyphicon-trash"></i></button>
							</div>
						</form>
						</div>
					<div class="row">
						<div class="col-md-12">

							<form action="#">
								<div class="form-group">
									<label for="nome">ID</label>
									<p class="form-control-static">{{$sensor->id}}</p>
								</div>
								<div class="form-group">
									 <label for="title">NAME</label>
									 <p class="form-control-static">{{$sensor->name}}</p>
								</div>
								<div class="form-group">
									 <label for="body">ADDRESS</label>
									 <p class="form-control-static">{{$sensor->address}}</p>
								</div>

								<div class="form-group">
									 <label for="body">CTGAIN</label>
									 <p class="form-control-static">{{$sensor->ctgain}}</p>
								</div>

								<div class="form-group">
									 <label for="body">CTOFFSET</label>
									 <p class="form-control-static">{{$sensor->ctoffset}}</p>
								</div>

								<div class="form-group">
									 <label for="body">Y SCALE MAX</label>
									 <p class="form-control-static">{{$sensor->yscalemax}}</p>
								</div>

								<div class="form-group">
									 <label for="body">Y SCALE MIN</label>
									 <p class="form-control-static">{{$sensor->yscalemin}}</p>
								</div>
								
								<div class="form-group">
									 <label for="body">アラート上限</label>
									 <p class="form-control-static">{{$sensor->limitupper}}</p>
								</div>
								<div class="form-group">
									 <label for="body">アラート下限</label>
									 <p class="form-control-static">{{$sensor->limitunder}}</p>
								</div>		
								<div class="form-group">
									 <label for="body">アラートモード</label>
									 <p class="form-control-static">{{$sensor->alertmode}}</p>
								</div>							

								<div class="form-group">
									<label for="nome">SENSUNIT_ID</label>
									<p class="form-control-static">{{$sensor->sensunit_id}} {{ $sensor->sensunit->name }}</p>
								</div>
		
								<div class="form-group">
									 <label for="title">PROJECT_ID</label>
									 <p class="form-control-static">{{$sensor->project_id}} {{ $sensor->projectatuser->name }}</p>
								</div>
								<div class="form-group">
									 <label for="body">TimeStamp</label>
									 <p class="form-control-static">{{$sensor->timestamps}}</p>
								</div>
							</form>

							<a class="btn btn-link" href="{{ route('sensor.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>

						</div>
					</div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection