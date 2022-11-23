@extends('base')

@section('title', '受診記録一覧')

@section('content')

        <h3>受診記録一覧</h3>

        <select>
            @foreach($yearlist as $year)
            <option @if ($year->year === $targetyear) selected @endif >{{$year->year}}</option>
            @endforeach
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
                    <td><a href="/user/detail/{{$examination->user_id}}">{{$examination->last_name}} {{$examination->first_name}}</a></td>
                    <td>
                        @if ($examination->course === 1) 1日人間ドック @endif
                        @if ($examination->course === 2) 基本検診 @endif
                    </td>
                    <td>{{$examination->place}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
@endsection
