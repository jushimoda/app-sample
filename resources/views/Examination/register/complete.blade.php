@extends('base')

@section('title', '受診記録登録完了画面')

@section('content')

        <h3>受診記録登録完了画面</h3>

        <p>登録が完了しました</p>

        <form method="GET">
            <input type="submit" formaction="/examination/list/" value="一覧に戻る">
        </form>
@endsection
