<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $projects = Project::get();
        return view('dashboard', ['projects' => $projects]);
    }

    public function taskFilter(Request $request)
    {
        $task = Task::where('project_id', $request->id)->get();

        return json_encode($task);
    }
}
