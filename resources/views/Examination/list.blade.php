@extends('base')

@section('title', '受診記録一覧')

@section('content')

        <h3>受診記録一覧</h3>

        <select>
            <option>aaa</option>
        </select>

        <table>
            <thead>
                <tr>
                    <th>受診日</td>
                    <th>受診したユーザー</td>
                    <th>受診コース</td>
                    <th>受診場所</td>
                </tr>
            </thead>
            <tbody>
                @foreach($examinations as $examination)
                <tr>
                    <td>{{$examination->examination_date}}</td>
                    <td><a href="/user/detail/{{$examination->user_id}}">{{$examination->name}}</a></td>
                    <td>{{$examination->course}}</td>
                    <td>{{$examination->place}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
@endsection
