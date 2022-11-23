@extends('base')

@section('title', '受診記録一覧')

@section('content')

        <h3>ユーザー登録確認画面</h3>

        <form method="POST">
            @csrf
            <ul>
                <li>
                    <label for="name">名前：</label>
                    {{$post['last_name']}} {{$post['first_name']}}
                </li>
                <li>
                    <label for="birthday">生年月日：</label>
                    {{$post['birthday']}}
                </li>

                <input type="hidden" name="last_name" value="{{$post['last_name']}}">
                <input type="hidden" name="first_name" value="{{$post['first_name']}}">
                <input type="hidden" name="birthday" value="{{$post['birthday']}}">

                <div class="submit">
                    <input class="button" type="submit" formaction="/user/register/execute" value="登録">
                    <input class="button" type="submit" formaction="/user/register/input" value="修正">
                </div>
            </ul>
        </form>
  
@endsection
