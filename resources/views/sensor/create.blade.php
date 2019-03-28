@extends('layouts.app')
@section('css')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css" rel="stylesheet">
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">センサー</div>

                <div class="card-body">
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-plus"></i> Sensor / Create </h1>
    </div>

    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('sensor.store') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

					<div class="form-group @if($errors->has('name')) has-error @endif">
                       <label for="name-field">name</label>
                    <input type="text"  class="form-control" id="name-field" rows="3" name="name" value="{{ old("name") }}"/>
                       @if($errors->has("name"))
                        <span class="help-block">{{ $errors->first("name") }}</span>
                       @endif
                    </div>
                    
					<div class="form-group @if($errors->has('address')) has-error @endif">
                       <label for="address-field">address</label>
                    <input type="text"  class="form-control date-picker" id="address-field" rows="3" name="address" value="{{ old("address") }}"/>
                       @if($errors->has("address"))
                        <span class="help-block">{{ $errors->first("address") }}</span>
                       @endif
                    </div>

					<div class="form-group @if($errors->has('ctgain')) has-error @endif">
                       <label for="ctgain-field">ctgain</label>
                    <input type="text"  class="form-control" id="ctgain-field" rows="3" name="ctgain" value="{{ old("ctgain") }}"/>
                       @if($errors->has("ctgain"))
                        <span class="help-block">{{ $errors->first("ctgain") }}</span>
                       @endif
                    </div>

					<div class="form-group @if($errors->has('ctoffset')) has-error @endif">
                       <label for="ctoffset-field">ctoffset</label>
                    <input type="text"  class="form-control" id="ctoffset-field" rows="3" name="ctoffset" value="{{ old("ctoffset") }}"/>
                       @if($errors->has("ctoffset"))
                        <span class="help-block">{{ $errors->first("ctoffset") }}</span>
                       @endif
                    </div>
				
					<div class="form-group @if($errors->has('yscalemax')) has-error @endif">
                       <label for="yscalemax-field">yscalemax</label>
                    <input type="text"  class="form-control" id="yscalemax-field" rows="3" name="yscalemax" value="{{ old("yscalemax") }}"/>
                       @if($errors->has("yscalemax"))
                        <span class="help-block">{{ $errors->first("yscalemax") }}</span>
                       @endif
                    </div>
				
					<div class="form-group @if($errors->has('yscalemin')) has-error @endif">
                       <label for="yscalemin-field">yscalemin</label>
                    <input type="text"  class="form-control" id="yscalemin-field" rows="3" name="yscalemin" value="{{ old("yscalemin") }}"/>
                       @if($errors->has("yscalemin"))
                        <span class="help-block">{{ $errors->first("yscalemin") }}</span>
                       @endif
                    </div>

					<div class="form-group @if($errors->has('limitupper')) has-error @endif">
                       <label for="limitupper-field">limitupper</label>
                    <input type="text"  class="form-control" id="limitupper-field" rows="3" name="limitupper" value="{{ old("limitupper") }}"/>
                       @if($errors->has("limitupper"))
                        <span class="help-block">{{ $errors->first("limitupper") }}</span>
                       @endif
                    </div>
					<div class="form-group @if($errors->has('limitunder')) has-error @endif">
                       <label for="limitunder-field">limitunder</label>
                    <input type="text"  class="form-control" id="limitunder-field" rows="3" name="limitunder" value="{{ old("limitunder") }}"/>
                       @if($errors->has("limitunder"))
                        <span class="help-block">{{ $errors->first("limitunder") }}</span>
                       @endif
                    </div>
					<div class="form-group @if($errors->has('alertmode')) has-error @endif">
                       <label for="alertmode-field">alertmode</label>
                    <input type="text"  class="form-control" id="alertmode-field" rows="3" name="alertmode" value="{{ old("alertmode") }}"/>
                       @if($errors->has("alertmode"))
                        <span class="help-block">{{ $errors->first("alertmode") }}</span>
                       @endif
                    </div>
				
					<div class="form-group @if($errors->has('sensunit_id')) has-error @endif">
                       <label for="sensunit_id-field">sensunit_id</label>
						{{-- セレクトボックス --}}
						{{ Form::select('sensunit_id',
							$sensunits,
							isset($sensor->sensunit_id) ? $sensor->sensunit_id : null, ['class' => 'form-control','id' => 'project_id-field'] )

						}}
                    </div>
			
					<div class="form-group @if($errors->has('project_id')) has-error @endif">
                       <label for="sdflug-field">project_id</label>
						{{-- セレクトボックス --}}
						{{ Form::select('project_id',
							$projectatusers,
							isset($sensor->project_id) ? $sensor->project_id : null, ['class' => 'form-control','id' => 'project_id-field'] )

						}}
                    </div>
				
                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a class="btn btn-link pull-right" href="{{ route('sensor.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
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
