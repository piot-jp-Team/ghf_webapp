@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">設定１</div>

                <div class="card-body">
					<div class="page-header clearfix">
						<h1>
							<i class="glyphicon glyphicon-align-justify"></i> プロジェクト
							<a class="btn btn-success pull-right" href="{{ route('projectatusers.create') }}"><i class="glyphicon glyphicon-plus"></i> 新規</a>
						</h1>
					</div>
					<div class="row">
						<div class="col-md-12">
							@if($projectatusers->count())
								<table class="table table-condensed table-striped">
									<thead>
										<tr>
											<th>ID</th>
											<th>プロジェクト名</th>

										</tr>
									</thead>

									<tbody>
										@foreach($projectatusers as $projectatuser)
											<tr>
												<td>{{$projectatuser->id}}</td>
												<td>{{$projectatuser->name}}</td>
									<td>{{$projectatuser->body}}</td>
												<td class="text-right">
													<a class="btn btn-xs btn-primary" href="{{ route('projectatusers.show', $projectatuser->id) }}"><i class="glyphicon glyphicon-eye-open"></i> 表示</a>
													<a class="btn btn-xs btn-warning" href="{{ route('projectatusers.edit', $projectatuser->id) }}"><i class="glyphicon glyphicon-edit"></i> 編集</a>
													<form action="{{ route('projectatusers.destroy', $projectatuser->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
														<input type="hidden" name="_method" value="DELETE">
														<input type="hidden" name="_token" value="{{ csrf_token() }}">
														<button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> 削除</button>
													</form>
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>
								{!! $projectatusers->render() !!}
							@else
								<h3 class="text-center alert alert-info">Empty!</h3>
							@endif

						</div>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
