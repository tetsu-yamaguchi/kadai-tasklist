<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;

class TasksController extends Controller
{
    // getでtasks/にアクセスされた場合の「一覧表示処理」
    
        public function index()
    {
        $tasks = Task::all();

        return view('tasks.index', [
            'tasks' => $tasks,
        ]);
    
    }

    // getでtasks/createにアクセスされた場合の「新規登録画面表示処理」
    public function create()
    {
        $task = new task;

        return view('tasks.create', [
            'task' => $task,
        ]);
    }


    // getでtasks/idにアクセスされた場合の「取得表示処理」
    public function show($id)
    {
        $task = task::find($id);

        return view('tasks.show', [
            'task' => $task,
        ]);
    }
    
    public function store(Request $request)
    {
        $task = new task;
        $task->content = $request->content;
        $task->save();

        return redirect('/');
    }

    // getでtasks/id/editにアクセスされた場合の「更新画面表示処理」
    public function edit($id)
    {
        $task = task::find($id);

        return view('tasks.edit', [
            'task' => $task,
        ]);
    }

     public function update(Request $request, $id)
    {
        $task = task::find($id);
        $task->content = $request->content;
        $task->save();

        return redirect('/');
    }
   
}