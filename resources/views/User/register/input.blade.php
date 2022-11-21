@extends('base')

@section('title', 'ユーザー登録入力画面')

@section('content')

        <h3>ユーザー登録入力画面</h3>

        <form method="POST">
            @csrf
            <label for="name">名前：</label>
            <input type="text" id="name" name="name" value="{{$post['name']}}" required>

            <label for="birthday">生年月日：</label>
            <input type="date" id="birthday" name="birthday" value="{{$post['birthday']}}" required>

            <input type="submit" formaction="/user/register/confirm" value="確認">
        </form>
@endsection
