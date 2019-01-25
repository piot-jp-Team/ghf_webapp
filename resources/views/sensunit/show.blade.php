@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">ユニット</div>

                <div class="card-body">
					<div class="page-header">
						<h1>Sensunit / Show #{{$sensunit->id}}</h1>
						<form action="{{ route('sensunit.destroy', $sensunit->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
							<input type="hidden" name="_method" value="DELETE">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="btn-group pull-right" role="group" aria-label="...">
								<a class="btn btn-warning btn-group" role="group" href="{{ route('sensunit.edit', $sensunit->id) }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
								<button type="submit" class="btn btn-danger">Delete <i class="glyphicon glyphicon-trash"></i></button>
							</div>
						</form>
						</div>
					<div class="row">
						<div class="col-md-12">

							<form action="#">
								<div class="form-group">
									<label for="nome">ID</label>
									<p class="form-control-static">{{$sensunit->id}}</p>
								</div>
								<div class="form-group">
									 <label for="title">NAME</label>
									 <p class="form-control-static">{{$sensunit->name}}</p>
								</div>
									<div class="form-group">
									 <label for="body">CHANNEL</label>
									 <p class="form-control-static">{{$sensunit->channel}}</p>
								</div>
								<div class="form-group">
									<label for="nome">SHIELD_ID</label>
									<p class="form-control-static">{{$sensunit->shield_id}} {{ $sensunit->shieldmodule->name }}</p>
								</div>
								<div class="form-group">
									 <label for="title">PROJECT_ID</label>
									 <p class="form-control-static">{{$sensunit->project_id}} {{ $sensunit->projectatuser->name }}</p>
								</div>
								<div class="form-group">
									 <label for="body">TimeStamp</label>
									 <p class="form-control-static">{{$sensunit->timestamps}}</p>
								</div>
							</form>

							<a class="btn btn-link" href="{{ route('sensunit.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>

						</div>
					</div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection