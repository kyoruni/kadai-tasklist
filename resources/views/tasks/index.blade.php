@extends('layouts.app')

@section('content')

    <h1>タスク一覧</h1>

    <!-- Controller から渡された $tasks 1つ以上あれば
    foreach で1つずつ $task として取り出して表示 -->
    @if (count($tasks) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>タスク</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                <tr>
                    <!-- リンク先:show リンク文字:idの数字 URL:id-->
                    <td>{!! link_to_route('tasks.show', $task->id, ['id' => $task->id]) !!}</td>
                    <td>{{ $task->content }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <!-- 新規作成ボタン -->
    {!! link_to_route('tasks.create', '新規タスクの作成', null, ['class' => 'btn btn-primary']) !!}
@endsection