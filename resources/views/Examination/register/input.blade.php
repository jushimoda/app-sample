@extends('base')

@section('title', '受診記録登録入力画面')

@section('content')

        <h3>受診記録登録入力画面</h3>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
        @endif

        <form method="POST">
            @csrf
            <label for="examination_date">受診日：</label>
            <input type="date" id="examination_date" name="examination_date" value="{{old('examination_date', $post['examination_date'])}}" required>

            <label for="course">受診コース：</label>
            <select id="course" name="course" required>
                <option value="1" @if (old('course', $post['course']) === '1' or (old('course', $post['course']) === '' and $userinfo->age >= 35)) selected @endif>1日人間ドック</option>
                <option value="2" @if (old('course', $post['course']) === '2' or (old('course', $post['course']) === '' and $userinfo->age < 35)) selected @endif>基本検診</option>
            </select>

            <label for="place">受診場所：</label>
            <textarea id="place" name="place">{{old('place', $post['place'])}}</textarea>

            <input type="submit" formaction="/examination/register/{{$post['userid']}}/confirm" value="確認">
        </form>
@endsection
