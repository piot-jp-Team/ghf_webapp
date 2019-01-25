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
                <div class="card-header">データリスト</div>

                <div class="card-body">

    <div class="page-header">
        <h1><i class="glyphicon glyphicon-edit"></i> Sensdata / Edit #{{$sensdata->id}}</h1>
    </div>




    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('sensdata.update', $sensdata->id) }}" method="POST">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

					<div class="form-group @if($errors->has('sensoer_id')) has-error @endif">
                       <label for="sensoer_id-field">sensoer_id</label>
                    <input type="text"  class="form-control" id="sensoer_id-field" rows="3" name="sensoer_id" value="{{ is_null(old("sensoer_id")) ? $sensdata->sensoer_id : old("sensoer_id") }}"/>
                       @if($errors->has("sensoer_id"))
                        <span class="help-block">{{ $errors->first("sensoer_id") }}</span>
                       @endif
                    </div>
                    
					<div class="form-group @if($errors->has('sddate')) has-error @endif">
                       <label for="sddate-field">sddate</label>
                    <input type="text"  class="form-control date-picker" id="sddate-field" rows="3" name="sddate" value="{{ is_null(old("sddate")) ? $sensdata->sddate : old("sddate") }}"/>
                       @if($errors->has("sddate"))
                        <span class="help-block">{{ $errors->first("sddate") }}</span>
                       @endif
                    </div>
				
					<div class="form-group @if($errors->has('sdtime')) has-error @endif">
                       <label for="sdtime-field">sdtime</label>
                    <input type="text"  class="form-control" id="sdtime-field" rows="3" name="sdtime" value="{{ is_null(old("sdtime")) ? $sensdata->sdtime : old("sdtime") }}"/>
                       @if($errors->has("sdtime"))
                        <span class="help-block">{{ $errors->first("sdtime") }}</span>
                       @endif
                    </div>
				
					<div class="form-group @if($errors->has('sddatetime')) has-error @endif">
                       <label for="sddatetime-field">sddatetime</label>
                    <input type="text"  class="form-control" id="sddatetime-field" rows="3" name="sddatetime" value="{{ is_null(old("sddatetime")) ? $sensdata->sddatetime : old("sddatetime") }}"/>
                       @if($errors->has("sddatetime"))
                        <span class="help-block">{{ $errors->first("sddatetime") }}</span>
                       @endif
                    </div>

					<div class="form-group @if($errors->has('sddvalue')) has-error @endif">
                       <label for="sddvalue-field">sddvalue</label>
                    <input type="text"  class="form-control" id="sddvalue-field" rows="3" name="sddvalue" value="{{ is_null(old("sddvalue")) ? $sensdata->sddvalue : old("sddvalue") }}"/>
                       @if($errors->has("sddvalue"))
                        <span class="help-block">{{ $errors->first("sddvalue") }}</span>
                       @endif
                    </div>

					<div class="form-group @if($errors->has('sdivalue')) has-error @endif">
                       <label for="sdivalue-field">sdivalue</label>
                    <input type="text"  class="form-control" id="sdivalue-field" rows="3" name="sdivalue" value="{{ is_null(old("sdivalue")) ? $sensdata->sdivalue : old("sdivalue") }}"/>
                       @if($errors->has("sdivalue"))
                        <span class="help-block">{{ $errors->first("sdivalue") }}</span>
                       @endif
                    </div>

					<div class="form-group @if($errors->has('sdflug')) has-error @endif">
                       <label for="sdflug-field">sdflug</label>
                    <input type="text"  class="form-control" id="sdflug-field" rows="3" name="sdflug" value="{{ is_null(old("sdflug")) ? $sensdata->sdflug : old("sdflug") }}"/>
                       @if($errors->has("sdflug"))
                        <span class="help-block">{{ $errors->first("sdflug") }}</span>
                       @endif
                    </div>

					<div class="form-group @if($errors->has('project_id')) has-error @endif">
                       <label for="project_id-field">project_id</label>
						{{-- セレクトボックス --}}
						{{ Form::select('project_id',
							$projectatusers,
							isset($sensdata->project_id) ? $sensdata->project_id : null, ['class' => 'form-control','id' => 'project_id-field'] )

						}}
                    </div>
				
                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-link pull-right" href="{{ route('sensdata.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
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
