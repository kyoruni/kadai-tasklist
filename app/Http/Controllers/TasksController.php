<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;

class TasksController extends Controller
{
    // 一覧表示
    public function index()
    {
        if (\Auth::check()) {
            $user  = \Auth::user();
            $tasks = $user->tasks()->orderBy('id', 'desc')->paginate(25);

            // View側で呼び出すtasksに、$tasksを渡しておく
            return view('tasks.index', ['tasks' => $tasks,]);
        }
        // ログインしていなかったら、task取得しないでindexへ
        return view('tasks.index');
    }

    // 新規作成ページ
    public function create()
    {
        // 新規taskのインスタンスを作成する
        $task = new Task;

        return view('tasks.create', ['task' => $task,]);
    }

    // 新規作成処理
    public function store(Request $request)
    {
        // ステータスが入力されていて、10文字以上でない場合のみOK
        // タスクが入力されていて、191文字以上でない場合のみOK
        $this->validate($request, ['status'  => 'required|max:10',
                                   'content' => 'required|max:191',]);

        // フォームから送られてきたcontentはrequestに入っているので、requestから取り出して登録
        $task = new Task;

        $request->user()->tasks()->create([
            'status'  => $request->status,
            'content' => $request->content,
        ]);

        return redirect('/');
    }

    // 個別表示ページ
    public function show($id)
    {
        $task = \App\Task::find($id);

        // ログインユーザー = タスク作成者なら表示画面へ
        if (\Auth::id() === $task->user_id) {
            return view('tasks.show', ['task' => $task,]);
        }
        // 編集画面へ入れなかった場合はトップページへ
        return redirect('/');
    }

    // 編集ページ
    public function edit($id)
    {
        $task = Task::find($id);

        // ログインユーザー = タスク作成者なら編集画面へ
        if (\Auth::id() === $task->user_id) {
            return view('tasks.edit', ['task' => $task,]);
        }
        // 編集画面に入れなかった場合はトップページへ
        return redirect('/');
    }

    // 編集処理
    public function update(Request $request, $id)
    {
        // ステータスが入力されていて、10文字以上でない場合のみOK
        // タスクが入力されていて、191文字以上でない場合のみOK
        $this->validate($request, ['status'  => 'required|max:10',
                                   'content' => 'required|max:191',]);

        // フォームから送られてきたcontentはrequestに入っているので、requestから取り出して登録
        $task = \App\Task::find($id);

        // ログインユーザー = タスク作成者なら編集処理へ
        if (\Auth::id() === $task->user_id) {
            $task->status  = $request->status;
            $task->content = $request->content;
            $task->save();
        }
        return redirect('/');
    }

    // 削除処理
    public function destroy($id)
    {
        $task = \App\Task::find($id);
        if (\Auth::id() === $task->user_id) {
            $task->delete();
        }
        return redirect('/');
    }
}
