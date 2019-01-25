@extends('layouts.app')
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.css" rel="stylesheet">

@section('content')
    @include('error')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">設定</div>

                <div class="card-body">

    <div class="page-header">
        <h1><i class="glyphicon glyphicon-edit"></i> 統計情報編集 #{{$setting->id}}</h1>
    </div>




    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('statistics.update', $setting->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <input type="hidden"  class="form-control" id="settingGroup-field" rows="3" name="settingGroup" value="{{ is_null(old("settingGroup")) ? $setting->settingGroup : old("settingGroup") }}"/>
                    
					<div class="form-group @if($errors->has('settingName')) has-error @endif">
                       <label for="settingName-field">名称</label>
                    <input type="text"  class="form-control " id="settingName-field" rows="3" name="settingName" value="{{ is_null(old("settingName")) ? $setting->settingName : old("settingName") }}"/>
                       @if($errors->has("settingName"))
                        <span class="help-block">{{ $errors->first("settingName") }}</span>
                       @endif
                    </div>
<?php
if(strpos($setting->settingString,'|') !== false){
	$dates = explode("|", $setting->settingString);
	$stdt=$dates[0];
	$eddt=$dates[1];
	$setting->settingString	= $stdt;		
	$setting->settingString2 = $eddt;
}
?>				
					<div class="form-group  @if($errors->has('settingString')) has-error @endif" id="datepicker-default">
						<label for="settingString-field">開始日 YYYY-MM-DD</label>
						<div class="input-group date">
							<input type="text"  class="form-control" id="settingString-field" rows="3" name="settingString" value="{{ is_null(old("settingString")) ? $setting->settingString : old("settingString") }}"/>
							   @if($errors->has("settingString"))
								<span class="help-block">{{ $errors->first("settingString") }}</span>
							   @endif
							<div class="input-group-addon" style="padding: 6px 20px;">
							<i class="glyphicon glyphicon-calendar"></i>
							</div>
						</div>					   
                    </div>
					
					<div class="form-group  @if($errors->has('settingString2')) has-error @endif" id="datepicker-default">
						<label for="settingString2-field">終了日 YYYY-MM-DD (指定なしの場合は今日)</label>
						<div class="input-group date">
							<input type="text"  class="form-control" id="settingString2-field" rows="3" name="settingString2" value="{{ is_null(old("settingString2")) ? $setting->settingString2 : old("settingString2") }}"/>
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
                       <label for="project_id-field">プロジェクト</label>
						{{-- セレクトボックス --}}
						{{ Form::select('project_id',
							$projectatusers,
							isset($setting->project_id) ? $setting->project_id : null, ['class' => 'form-control','id' => 'project_id-field'] )

						}}
						
                       @if($errors->has("project_id"))
                        <span class="help-block">{{ $errors->first("project_id") }}</span>
                       @endif
                    </div>

	
                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-link pull-right" href="{{ route('statistics.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
                </div>
            </form>
			
			
						<form action="{{ route('statistics.destroy', $setting->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
														<input type="hidden" name="_method" value="DELETE">
														<input type="hidden" name="_token" value="{{ csrf_token() }}">
														<button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> 削除</button>
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


