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
            <ul>
                <li>
                    <label for="examination_date">受診日：</label>
                    <input type="date" id="examination_date" name="examination_date" value="{{old('examination_date', $post['examination_date'])}}" required>
                </li>

                <li>
                    <label for="course">受診コース：</label>
                    <select id="course" name="course" required>
                        <option value="1" @if (old('course', $post['course']) === '1' or (old('course', $post['course']) === '' and $userinfo->age >= 35)) selected @endif>1日人間ドック</option>
                        <option value="2" @if (old('course', $post['course']) === '2' or (old('course', $post['course']) === '' and $userinfo->age < 35)) selected @endif>基本検診</option>
                    </select>
                </li>

                <li>
                    <label for="place">受診場所：</label>
                    <input type="text" id="place" name="place" value="{{old('place', $post['place'])}}" required>
                </li>

                <div class="submit">
                    <input class="button" type="submit" id="confirm" formaction="/examination/register/{{$post['userid']}}/confirm" value="確認">
                </div>
            </ul>
        </form>
@endsection
