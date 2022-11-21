@extends('base')

@section('title', 'ユーザー一覧')

@section('content')

        <h3>ユーザー一覧</h3>

        <a href="/user/register/input">新規登録</a>

        <table>
            <thead>
                <tr>
                    <th>ユーザーID</td>
                    <th>名前</td>
                    <th>年度年齢</td>
                    <th>今年度の受診コース</td>
                    <th>受診回数</td>
                </tr>
            </thead>
            <tbody>
                @foreach($userinfos as $userinfo)
                <tr>
                    <td><a href="/user/detail/{{$userinfo->id}}">{{$userinfo->id}}</a></td>
                    <td>{{$userinfo->name}}</td>
                    <td>{{$userinfo->age}}</td>
                    <td>@if ($userinfo->age >= 35) 1日人間ドック @else 基本健診 @endif</td>
                    <td>@if (is_null($userinfo->cnt)) 0 @else {{$userinfo->cnt}} @endif</td>
                </tr>
                @endforeach
            </tbody>
        </table>
@endsection
