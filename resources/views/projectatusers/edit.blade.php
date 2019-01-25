@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Settings</div>

                <div class="card-body">

					
					@section('css')
					  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css" rel="stylesheet">
					@endsection
					@section('header')
						<div class="page-header">
							<h1><i class="glyphicon glyphicon-edit"></i> Projectatusers / Edit #{{$projectatuser->id}}</h1>
						</div>
					@endsection


						@include('error')

						<div class="row">
							<div class="col-md-12">

								<form action="{{ route('projectatusers.update', $projectatuser->id) }}" method="POST">
									<input type="hidden" name="_method" value="PUT">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">

									<div class="form-group @if($errors->has('name')) has-error @endif">
										   <label for="title-field">プロジェクト名</label>
										<input type="text" id="title-field" name="name" class="form-control" value="{{ is_null(old("name")) ? $projectatuser->name : old("name") }}"/>
										   @if($errors->has("name"))
											<span class="help-block">{{ $errors->first("name") }}</span>
										   @endif
										</div>
									<div class="well well-sm">
										<button type="submit" class="btn btn-primary">Save</button>
										<a class="btn btn-link pull-right" href="{{ route('projectatusers.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
									</div>
								</form>

							</div>
						</div>

					@section('scripts')
					  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script>
					  <script>
						$('.date-picker').datepicker({
						});
					  </script>
					@endsection
					

                </div>
            </div>
        </div>
    </div>
</div>
@endsection





