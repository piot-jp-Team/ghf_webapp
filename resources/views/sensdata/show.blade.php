@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">データリスト</div>

                <div class="card-body">
					<div class="page-header">
						<h1>Sensdata / Show #{{$sensdata->id}}</h1>
						<form action="{{ route('sensdata.destroy', $sensdata->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
							<input type="hidden" name="_method" value="DELETE">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="btn-group pull-right" role="group" aria-label="...">
								<a class="btn btn-warning btn-group" role="group" href="{{ route('sensdata.edit', $sensdata->id) }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
								<button type="submit" class="btn btn-danger">Delete <i class="glyphicon glyphicon-trash"></i></button>
							</div>
						</form>
						</div>
					<div class="row">
						<div class="col-md-12">

							<form action="#">
								<div class="form-group">
									<label for="nome">ID</label>
									<p class="form-control-static">{{$sensdata->id}}</p>
								</div>
								<div class="form-group">
									 <label for="title">SENS_ID</label>
									 <p class="form-control-static">{{$sensdata->sensoer_id}}</p>
								</div>
									<div class="form-group">
									 <label for="body">DATE</label>
									 <p class="form-control-static">{{$sensdata->sddate}}</p>
								</div>
								<div class="form-group">
									<label for="nome">TIME</label>
									<p class="form-control-static">{{$sensdata->sdtime}}</p>
								</div>
								<div class="form-group">
									 <label for="title">DATETIME</label>
									 <p class="form-control-static">{{$sensdata->sddatetime}}</p>
								</div>
									<div class="form-group">
									 <label for="body">SDDVALUE</label>
									 <p class="form-control-static">{{$sensdata->sddvalue}}</p>
								</div>
								<div class="form-group">
									<label for="nome">SDIVALUE</label>
									<p class="form-control-static">{{$sensdata->sdivalue}}</p>
								</div>
								<div class="form-group">
									<label for="nome">CTGAIN</label>
									<p class="form-control-static">{{$sensdata->ctgain}}</p>
								</div>
								<div class="form-group">
									<label for="nome">CTOFFSET</label>
									<p class="form-control-static">{{$sensdata->ctoffset}}</p>
								</div>
								<div class="form-group">
									 <label for="title">SDFLG</label>
									 <p class="form-control-static">{{$sensdata->sdflug}}</p>
								</div>
								<div class="form-group">
									 <label for="title">PROJECT_ID</label>
									 <p class="form-control-static">{{$sensdata->project_id}} {{ $sensdata->projectatuser->name }}</p>
								</div>
								<div class="form-group">
									 <label for="body">TimeStamp</label>
									 <p class="form-control-static">{{$sensdata->timestamps}}</p>
								</div>
							</form>

							<a class="btn btn-link" href="{{ route('sensdata.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>

						</div>
					</div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection