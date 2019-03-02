@extends('layouts.app')

@section('content')

@if (Auth::check())
    <h1>タスク一覧</h1>

    <!-- Controller から渡された $tasks 1つ以上あれば
    foreach で1つずつ $task として取り出して表示 -->
    @if (count($tasks) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>ステータス</th>
                    <th>タスク</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                <tr>
                    <!-- リンク先:show リンク文字:idの数字 URL:id-->
                    <td>{!! link_to_route('tasks.show', $task->id, ['id' => $task->id]) !!}</td>
                    <td>{{ $task->status  }}</td>
                    <td>{{ $task->content }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <!-- ページネーション用リンク -->
    {{ $tasks->render('pagination::bootstrap-4') }}

    <!-- 新規作成ボタン -->
    {!! link_to_route('tasks.create', '新規タスクの作成', null, ['class' => 'btn btn-primary mb-4']) !!}
@else
    <div class="center jumbotron">
        <div class="text-center">
            <h1>Welcome to the Tasklist</h1>
            {!! link_to_route('signup.get', 'Sign up now!', [], ['class' => 'btn btn-lg btn-primary']) !!}
        </div>
    </div>
@endif
@endsection