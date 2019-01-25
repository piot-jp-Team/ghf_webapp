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
                <div class="card-header">ユニット</div>

                <div class="card-body">

    <div class="page-header">
        <h1><i class="glyphicon glyphicon-edit"></i> Sensunit / Edit #{{$sensunit->id}}</h1>
    </div>




    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('sensunit.update', $sensunit->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

					<div class="form-group @if($errors->has('name')) has-error @endif">
                       <label for="name-field">name</label>
                    <input type="text"  class="form-control" id="name-field" rows="3" name="name" value="{{ is_null(old("name")) ? $sensunit->name : old("name") }}"/>
                       @if($errors->has("name"))
                        <span class="help-block">{{ $errors->first("name") }}</span>
                       @endif
                    </div>
                    
					<div class="form-group @if($errors->has('channel')) has-error @endif">
                       <label for="channel-field">channel</label>
                    <input type="text"  class="form-control date-picker" id="channel-field" rows="3" name="channel" value="{{ is_null(old("channel")) ? $sensunit->channel : old("channel") }}"/>
                       @if($errors->has("channel"))
                        <span class="help-block">{{ $errors->first("channel") }}</span>
                       @endif
                    </div>
				
					<div class="form-group @if($errors->has('shield_id')) has-error @endif">
                       <label for="shield_id-field">shield_id</label>
						{{-- セレクトボックス --}}
						{{ Form::select('shield_id',
							$shieldmodules,
							isset($sensunit->shield_id) ? $sensunit->shield_id : null, ['class' => 'form-control','id' => 'project_id-field'] )

						}}
                    </div>

					<div class="form-group @if($errors->has('project_id')) has-error @endif">
                       <label for="project_id-field">project_id</label>
						{{-- セレクトボックス --}}
						{{ Form::select('project_id',
							$projectatusers,
							isset($sensunit->project_id) ? $sensunit->project_id : null, ['class' => 'form-control','id' => 'project_id-field'] )

						}}
                    </div>
				
                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-link pull-right" href="{{ route('sensunit.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
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
