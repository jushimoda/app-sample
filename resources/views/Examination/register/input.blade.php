@extends('base')

@section('title', '受診記録登録入力画面')

@section('content')

        <h3>受診記録登録入力画面</h3>

        <form method="POST">
            @csrf
            <label for="examination_date">受診日：</label>
            <input type="date" id="examination_date" name="examination_date" value="{{$post['examination_date']}}" required>

            <label for="course">受診コース：</label>
            <select id="course" name="course" required>
                <option value="">選択してください</option>
                <option value="1" @if ($post['course'] === '1') selected @endif>1日人間ドック</option>
                <option value="2" @if ($post['course'] === '2') selected @endif>基本検診</option>
            </select>

            <label for="place">受診場所：</label>
            <textarea id="place" name="place">{{$post['place']}}</textarea>

            <input type="submit" formaction="/examination/register/{{$post['userid']}}/confirm" value="確認">
        </form>
@endsection
