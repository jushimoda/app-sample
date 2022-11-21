@extends('base')

@section('title', '受診記録一覧')

@section('content')

        <h3>ユーザー登録確認画面</h3>

        <form method="POST">
            @csrf
            <label for="name">名前：</label>
            {{$post['name']}}

            <label for="birthday">生年月日：</label>
            {{$post['birthday']}}

            <input type="hidden" name="name" value="{{$post['name']}}">
            <input type="hidden" name="birthday" value="{{$post['birthday']}}">

            <input type="submit" formaction="/user/register/execute" value="登録">
            <input type="submit" formaction="/user/register/input" value="修正">
        </form>
  
@endsection
