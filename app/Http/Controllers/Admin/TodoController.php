<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Todo;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::orderByRaw(DB::raw("FIELD(status, 'open', 'pending', 'close')"))
            ->latest()->paginate();
        return view('admin.todo.index', compact('todos'));
    }


    public function create()
    {
        return view('admin.todo.create');
    }


    public function store(Request $request)
    {
        $input = $request->all();
        //use current user as the creator
        $input['creator_id'] = auth()->user()->id;

        Todo::create($input);

        flash()->success('您剛剛新增了待辦事項!');
        return redirect(route('admin.todo.index'));
    }

    public function show(Todo $todo)
    {
        return view('admin.todo.show', compact('todo'));
    }

    public function edit(Todo $todo)
    {
        return view('admin.todo.edit', compact('todo'));
    }

    public function update(Request $request, Todo $todo)
    {
        $todo->update($request->all());
        flash()->success('您剛剛修改了待辦事項!');
        return redirect(route('admin.todo.index'));
    }


    public function processCommand(Todo $todo, $action)
    {
        if ($action == 'done') {
            flash()->success('您剛剛修改了待辦事項!');
            $todo->update([
                'status' => 'close',
                'finished_at' => Carbon::now(),
                'done_recorder_id' => auth()->user()->id
            ]);
        }

        if ($action == 'pending') {
            flash()->success('您剛剛修改了待辦事項!');
            $todo->update([
                'status' => 'pending',
                'done_recorder_id' => auth()->user()->id
            ]);
        }
        return redirect(route('admin.todo.index'));
    }
}
