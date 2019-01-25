@extends('layouts.app')
@section('css')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css" rel="stylesheet">
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">設定</div>

                <div class="card-body">
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-plus"></i> Setting / Create </h1>
    </div>

    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('setting.store') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

					<div class="form-group @if($errors->has('settingGroup')) has-error @endif">
                       <label for="settingGroup-field">settingGroup</label>
                    <input type="text"  class="form-control" id="settingGroup-field" rows="3" name="settingGroup" value="{{ old("settingGroup") }}"/>
                       @if($errors->has("settingGroup"))
                        <span class="help-block">{{ $errors->first("settingGroup") }}</span>
                       @endif
                    </div>
                    
					<div class="form-group @if($errors->has('settingName')) has-error @endif">
                       <label for="settingName-field">settingName</label>
                    <input type="text"  class="form-control date-picker" id="settingName-field" rows="3" name="settingName" value="{{ old("settingName") }}"/>
                       @if($errors->has("settingName"))
                        <span class="help-block">{{ $errors->first("settingName") }}</span>
                       @endif
                    </div>
				
					<div class="form-group @if($errors->has('settingString')) has-error @endif">
                       <label for="settingString-field">settingString</label>
                    <input type="text"  class="form-control" id="settingString-field" rows="3" name="settingString" value="{{ old("settingString") }}"/>
                       @if($errors->has("settingString"))
                        <span class="help-block">{{ $errors->first("settingString") }}</span>
                       @endif
                    </div>
				
					<div class="form-group @if($errors->has('settingValue')) has-error @endif">
                       <label for="settingValue-field">settingValue</label>
                    <input type="text"  class="form-control" id="settingValue-field" rows="3" name="settingValue" value="{{ old("settingValue") }}"/>
                       @if($errors->has("settingValue"))
                        <span class="help-block">{{ $errors->first("settingValue") }}</span>
                       @endif
                    </div>

					<div class="form-group @if($errors->has('project_id')) has-error @endif">
                       <label for="sdflug-field">project_id</label>
						{{-- セレクトボックス --}}
						{{ Form::select('project_id',
							$projectatusers,
							isset($setting->project_id) ? $setting->project_id : null, ['class' => 'form-control','id' => 'project_id-field'] )

						}}
                       @if($errors->has("sdflug"))
                        <span class="help-block">{{ $errors->first("project_id") }}</span>
                       @endif
                    </div>
				
                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a class="btn btn-link pull-right" href="{{ route('setting.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
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
