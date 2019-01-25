@extends('layouts.app')
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.css" rel="stylesheet">
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">設定</div>

                <div class="card-body">
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-plus"></i> 設定 / 登録 </h1>
    </div>

    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('statistics.store') }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">


                    <input type="hidden"  class="form-control" id="settingGroup-field" rows="3" name="settingGroup" value="TMPL_INTEG_ST_DATE"/>

                    
					<div class="form-group @if($errors->has('settingName')) has-error @endif">
                       <label for="settingName-field">名称</label>
                    <input type="text"  class="form-control date-picker" id="settingName-field" rows="3" name="settingName" value="{{ old("settingName") }}"/>
                       @if($errors->has("settingName"))
                        <span class="help-block">{{ $errors->first("settingName") }}</span>
                       @endif
                    </div>
				
					<div class="form-group @if($errors->has('settingString')) has-error @endif" id="datepicker-default">
						<label for="settingString-field">開始日 YYYY-MM-DD</label>
						<div class="input-group date">
							<input type="text"  class="form-control" id="settingString-field" rows="3" name="settingString" value="{{ old("settingString") }}"/>
							@if($errors->has("settingString"))
							<span class="help-block">{{ $errors->first("settingString") }}</span>
							@endif
							<div class="input-group-addon" style="padding: 6px 20px;">
							<i class="glyphicon glyphicon-calendar"></i>
							</div>
						</div>
					</div>

					<div class="form-group @if($errors->has('settingString2')) has-error @endif" id="datepicker-default">
						<label for="settingString2-field">終了日 YYYY-MM-DD (指定なしの場合は今日)</label>
						<div class="input-group date">
							<input type="text"  class="form-control" id="settingString2-field" rows="3" name="settingString2" value="{{ old("settingString2") }}"/>
							@if($errors->has("settingString2"))
							<span class="help-block">{{ $errors->first("settingString2") }}</span>
							@endif
							<div class="input-group-addon" style="padding: 6px 20px;">
							<i class="glyphicon glyphicon-calendar"></i>
							</div>
						</div>
					</div>
					
					@if(isset($sensors))
					<div class="form-group @if($errors->has('settingValue')) has-error @endif">
                       <label for="settingValue-field">センサーID</label>
					@if(!$sensors)
					<a class="btn btn-link pull-right" href="{{ route('sensor.index') }}">センサーがありません。センサー登録はこちら</a>
                    @endif
						{{-- セレクトボックス --}}
						{{ Form::select('settingValue',
							$sensors,
							isset($setting->settingValue) ? $setting->settingValue : null, ['class' => 'form-control','id' => 'settingValue-field'] )

						}}
                    </div>
					@endif

					<div class="form-group @if($errors->has('project_id')) has-error @endif">
                       <label for="sdflug-field">プロジェクト</label>
						@if(!$projectatusers)
						<a class="btn btn-link pull-right" href="{{ route('projectatusers.index') }}">プロジェクトがありません。プロジェクト登録はこちら</a>
						@endif
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
					@if($sensors&&$projectatusers)
                    <button type="submit" class="btn btn-primary">Create</button>
					@else
					<button type="button" class="btn btn-default">Create</button>
					@endif
                    <a class="btn btn-link pull-right" href="{{ route('statistics.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
                </div>
            </form>

        </div>
    </div>
	                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/locales/bootstrap-datepicker.ja.min.js"></script>
<script>
$(function(){
    //Default
    $('#datepicker-default .date').datepicker({
        format: "yyyy-mm-dd",
        language: 'ja'
    });
     
});
</script>

@endsection

