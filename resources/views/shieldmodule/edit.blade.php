@extends('layouts.app')
@section('css')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css" rel="stylesheet">
@endsection
@section('content')
    @include('error')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">モジュール</div>

                <div class="card-body">

    <div class="page-header">
        <h1><i class="glyphicon glyphicon-edit"></i> Shieldmodule / Edit #{{$shieldmodule->id}}</h1>
    </div>




    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('shieldmodule.update', $shieldmodule->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

					<div class="form-group @if($errors->has('name')) has-error @endif">
                       <label for="name-field">name</label>
                    <input type="text"  class="form-control" id="name-field" rows="3" name="name" value="{{ is_null(old("name")) ? $shieldmodule->name : old("name") }}"/>
                       @if($errors->has("name"))
                        <span class="help-block">{{ $errors->first("name") }}</span>
                       @endif
                    </div>
                    
					<div class="form-group @if($errors->has('module_id')) has-error @endif">
                       <label for="module_id-field">module_id</label>
                    <input type="text"  class="form-control date-picker" id="module_id-field" rows="3" name="module_id" value="{{ is_null(old("module_id")) ? $shieldmodule->module_id : old("module_id") }}"/>
                       @if($errors->has("module_id"))
                        <span class="help-block">{{ $errors->first("module_id") }}</span>
                       @endif
                    </div>
			<div class="form-group @if($errors->has('project_id')) has-error @endif">
                       <label for="project_id-field">project_id</label>
						{{-- セレクトボックス --}}
						{{ Form::select('project_id',
							$projectatusers,
							isset($shieldmodule->project_id) ? $shieldmodule->project_id : null, ['class' => 'form-control','id' => 'project_id-field'] )

						}}
                    </div>
				
                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-link pull-right" href="{{ route('shieldmodule.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
                </div>
            </form>

        </div>
    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script>
  <script>
    $('.date-picker').datepicker({
		todayBtn: "linked",
        autoclose: true,
        todayHighlight: true,
        format: "yyyy-mm-dd",
        language: 'ja'
    });
  </script>
@endsection
