@extends('layouts.app')

<!-- Main Content -->
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>本登録・認証エラー</h1>
            <div class="panel-body">
                <span class="help-block">
                    <strong>本登録の認証に失敗しました。URLが途中で途切れている場合があります。もう一度お確かめの上、アクセスしてください。</strong>
                </span>
                <br>
                <br>
                <a href="{{url('/')}}" class="btn btn-primary">
                    トップページへ戻る
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
