<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;

class TasksController extends Controller
{
    // getでtasks/にアクセスされた場合の「一覧表示処理」
    
    public function index()
    {
        $data = [];
        if (\Auth::check()) {
            $user = \Auth::user();
            $tasks = $user->tasklist()->orderBy('created_at', 'desc')->paginate(10);
            
            $data = [
                'user' => $user,
                'tasks' => $tasks,
            ];
            return view('tasks.index', [
                'tasks' => $tasks,
            ]);
        }
        
        return view('welcome', $data);
    }
    
    

    // getでtasks/createにアクセスされた場合の「新規登録画面表示処理」
    public function create()
    {
        $task = new task;

        return view('tasks.create', [
            'task' => $task,
        ]);
    }


    // getでtasks/idにア                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   クセスされた場合の「取得表示処理」
    public function show($id)
    {
        $task = task::find($id);

        return view('tasks.show', [
            'task' => $task,
        ]);
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'status' => 'required|max:10',
        ]);
        $task = new Task;
        $task->content = $request->content;
        $task->status = $request->status;
        $task->user_id = \Auth::id();
        
        $task->save();
        

        return redirect('index');
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
        $this->validate($request, [
            'status' => 'required|max:10',
        ]);
        $task = task::find($id);
        $task->content = $request->content;
        
        $task->status = $request->status;
        $task->save();
        return redirect('index');
    }
    public function destroy($id)
    {
        $task = task::find($id);
        $task->delete();

        return redirect('index');
    }
}