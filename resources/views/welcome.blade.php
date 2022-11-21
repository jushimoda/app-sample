@extends('base')

@section('title', '画面一覧')

@section('content')

    <table>
    <thead>
        <tr>
            <th>画面名</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><a href="/user/list">ユーザー一覧</a></td>
        </tr>
        <tr>
            <td><a href="/examination/list/">受診記録一覧</a></td>
        </tr>
    </tbody>
    </table>
@endsection
