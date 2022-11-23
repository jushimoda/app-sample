@extends('base')

@section('title', '受診記録一覧')

@section('content')

<script>
$(function () {
    // プルダウン変更時に遷移
    $('select[name=year]').change(function() {
        if ($(this).val() != '') {
            window.location.href = $(this).val();
        }
    });
});
</script>

        <h3>受診記録一覧</h3>

        <select id="year" name="year">
            @foreach($yearlist as $year)
            <option value="./{{$year->year}}" @if ($year->year == $targetyear) selected @endif >{{$year->year}}</option>
            @endforeach
        </select>

        <table class="design04">
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
