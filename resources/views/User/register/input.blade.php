@extends('base')

@section('title', 'ユーザー登録入力画面')

@section('content')

        <h3>ユーザー登録入力画面</h3>

        <form method="POST">
            @csrf
            <ul>
                <li>
                    <label for="name">名前：</label>
                    <input type="text" id="name" name="last_name" value="{{$post['last_name']}}" required>
                    <input type="text" id="name" name="first_name" value="{{$post['first_name']}}" required>
                </li>
                <li>
                    <label for="birthday">生年月日：</label>
                    <input type="date" id="birthday" name="birthday" value="{{$post['birthday']}}" required>
                </li>

                <div class="submit">
                    <input class="button" type="submit" formaction="/user/register/confirm" value="確認">
                </div>
            </ul>
        </form>
@endsection
