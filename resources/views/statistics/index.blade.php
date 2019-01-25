<?php
//var_dump($statistics);exit;
?>

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
		@if(isset($statisticsdt))
            <div class="card">
			@foreach ($statisticsdt as $statisticdata)
				<div class="card-header statistics">
					統計情報　　{{$statisticdata[0]->name}}
					@foreach ($projectatusers as $key=>$val)
						@if($statisticdata[0]->project_id==$key)
						<a class="btn btn-info pull-right btn-lg" href="{{ route('statistics.edit', $statisticdata[0]->settingid) }}"><i class="glyphicon glyphicon-cog"></i></a>
						@endif
					@endforeach
				</div>
                <div class="card-body">
    
                        <div class="alert alert-success statistics">
                        開始日：    {{$statisticdata[0]->start_date}}
                        </div>
                        <div class="alert alert-success statistics">
                        終了日：    {{$statisticdata[0]->end_date}}
                        </div>
                        <div class="alert alert-success statistics">
                        積算気温：    {{$statisticdata[0]->integrate_temp}}
                        </div>
                </div>
			@endforeach	
			</div>
		@else
			<h3 class="text-center alert alert-info">Empty!</h3>
		@endif
					<div class="page-header clearfix">
						<h1>
							<a class="btn btn-success pull-right" href="{{ route('statistics.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
						</h1>
					</div>
        </div>
    </div>
</div>
@endsection
