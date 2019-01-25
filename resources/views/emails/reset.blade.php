<h3>
    <a href="{{ config('app.url') }}">{{ config('app.name') }}</a>
</h3>
<p>
    {{ __('下のＵＲＬにアクセスしてパスワードをリセットしてください') }}<br>
    {{ __('このメールに心当たりのない方は、このまま削除してください。') }}
</p>
<p>
    {{ $actionText }}: <a href="{{ $actionUrl }}">{{ $actionUrl }}</a>
</p>

