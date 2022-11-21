@extends('base')

@section('title', 'ユーザー詳細')

@section('content')

        <h3>ユーザー詳細</h3>

        <a href="/examination/register/{{$userinfo->id}}/input">受診記録新規登録</a>

        <table>
            <thead>
                <tr>
                    <th>ユーザーID</td>
                    <th>名前</td>
                    <th>生年月日</td>
                    <th>年度年齢</td>
                    <th>今年度の受診コース</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$userinfo->id}}</td>
                    <td>{{$userinfo->name}}</td>
                    <td>{{$userinfo->birthday}}</td>
                    <td>{{$userinfo->age}}</td>
                    <td>@if ($userinfo->age >= 35) 1日人間ドック @else 基本健診 @endif</td>
                </tr>
            </tbody>
        </table>

        <h3>受診記録一覧</h3>

        <table>
            <thead>
                <tr>
                    <th>受診年度</td>
                    <th>受診日</td>
                    <th>受診コース</td>
                    <th>受診場所</td>
                </tr>
            </thead>
            <tbody>
                @foreach($examinations as $examination)
                <tr>
                    <td>{{$examination->year}}</td>
                    <td>{{$examination->examination_date}}</td>
                    <td>{{$examination->course}}</td>
                    <td>{{$examination->place}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

@endsection
