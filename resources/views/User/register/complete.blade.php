@extends('base')

@section('title', 'ユーザー登録完了画面')

@section('content')

        <h3>ユーザー登録完了画面</h3>

        <p>登録が完了しました</p>

        <form method="GET">
            <input class="button" type="submit" formaction="/user/list" value="一覧に戻る">
        </form>
@endsection
