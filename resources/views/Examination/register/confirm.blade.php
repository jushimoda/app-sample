@extends('base')

@section('title', '受診記録一覧')

@section('content')

        <h3>受診記録登録確認画面</h3>

        <form method="POST">
            @csrf
            <ul>
                <li>
                    <label for="examination_date">受診日：</label>
                    {{$post['examination_date']}}
                </li>
                <li>
                    <label for="course">受診コース：</label>
                    @if ($post['course'] === '1') 1日人間ドック @endif
                    @if ($post['course'] === '2') 基本検診 @endif
                </li>
                <li>
                    <label for="place">受診場所：</label>
                    {{$post['place']}}
                </li>

                <input type="hidden" name="examination_date" value="{{$post['examination_date']}}">
                <input type="hidden" name="course" value="{{$post['course']}}">
                <input type="hidden" name="place" value="{{$post['place']}}">

                <div class="submit">
                    <input class="button" type="submit" formaction="/examination/register/{{$post['userid']}}/execute" value="登録">
                    <input class="button" type="submit" formaction="/examination/register/{{$post['userid']}}/input" value="修正">
                </div>
            </ul>
        </form>
  
@endsection
