<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::all()->sortBy("priority");
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $task = new Task();
        $projects = Project::get();
        return view('tasks.create', compact('task', 'projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \DB::beginTransaction();
        try {
            $task = Task::create([
                'title' => $request->title,
                'priority' => $request->priority,
                'project_id' => $request->project_id,
            ]);
        } catch (\Throwable $error) {
            \DB::rollback();
            return back()->withInput();
        }
        \DB::commit();

        return redirect('tasks')->with('status', 'Success: Task Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        $task = Task::findOrFail($task->id);

        return view('tasks.show', [
            'task' => $task
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        if (($previous = url()->previous()) && ($current = url()->current())) {
            if ((parse_url($previous)['host'] ?? null) == (parse_url($current)['host'] ?? null)) {
                // ホスト部分どうしで比較
                if (($previous = url()->previous()) != ($current = url()->current())) {
                    session(['url.intended' => parse_url($previous)['path']]);
                }
            }
        }

        $task = Task::findOrFail($task->id);
        $projects = Project::get();

        return view('tasks.create', compact('task', 'projects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        \DB::beginTransaction();
        try {
            $task = Task::where('id', $task->id)->update([
                'title' => $request->title,
                'priority' => $request->priority,
                'project_id' => $request->project_id,
            ]);
        } catch (\Throwable $error) {
            \DB::rollback();
            return back()->withInput();
        }
        \DB::commit();

        if(session('url.intended')) {
            return redirect(session('url.intended'))->with('status', 'Success: Task Updated!');
        } else {
            return redirect('tasks')->with('status', 'Success: Task Updated!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        \DB::beginTransaction();
        try {
            $task->delete();
        } catch (\Throwable $error) {
            \DB::rollback();
            return back()->withInput();
        }
        \DB::commit();

        return redirect('tasks')->with('status', 'Success: Task Deleted!');

    }
}
