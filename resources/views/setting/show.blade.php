@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">設定</div>

                <div class="card-body">
					<div class="page-header">
						<h1>Setting / Show #{{$setting->id}}</h1>
						<form action="{{ route('setting.destroy', $setting->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
							<input type="hidden" name="_method" value="DELETE">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="btn-group pull-right" role="group" aria-label="...">
								<a class="btn btn-warning btn-group" role="group" href="{{ route('setting.edit', $setting->id) }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
								<button type="submit" class="btn btn-danger">Delete <i class="glyphicon glyphicon-trash"></i></button>
							</div>
						</form>
						</div>
					<div class="row">
						<div class="col-md-12">

							<form action="#">
								<div class="form-group">
									<label for="nome">ID</label>
									<p class="form-control-static">{{$setting->id}}</p>
								</div>
								<div class="form-group">
									 <label for="title">GROUP</label>
									 <p class="form-control-static">{{$setting->settingGroup}}</p>
								</div>
									<div class="form-group">
									 <label for="body">NAME</label>
									 <p class="form-control-static">{{$setting->settingName}}</p>
								</div>
								<div class="form-group">
									<label for="nome">STRING</label>
									<p class="form-control-static">{{$setting->settingString}}</p>
								</div>
								<div class="form-group">
									 <label for="title">VALUE</label>
									 <p class="form-control-static">{{$setting->settingValue}}</p>
								</div>
								<div class="form-group">
									 <label for="title">PROJECT_ID</label>
									 <p class="form-control-static">{{$setting->project_id}} {{ $setting->projectatuser->name }}</p>
								</div>
								<div class="form-group">
									 <label for="body">TimeStamp</label>
									 <p class="form-control-static">{{$setting->timestamps}}</p>
								</div>
							</form>

							<a class="btn btn-link" href="{{ route('setting.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>

						</div>
					</div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection