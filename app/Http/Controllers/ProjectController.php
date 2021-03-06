<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreProjectRequest;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::get();
        return view('projects.index', ['projects' => $projects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $project = new Project();

        return view('projects.create', [
            'project' => $project
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        \DB::beginTransaction();
        try {
            $project = Project::create([
                'title' => $request->title,
                'description' => $request->description,
                'user_id' => Auth::id(),
            ]);
        } catch (\Throwable $error) {
            \DB::rollback();
            return back()->withInput();
        }
        \DB::commit();

        return redirect('projects')->with('status', 'Success: Project Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $project = Project::findOrFail($project->id);

        return view('projects.show', [
            'project' => $project
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $project = Project::findOrFail($project->id);

        return view('projects.create', [
            'project' => $project
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProjectRequest $request, Project $project)
    {
        \DB::beginTransaction();
        try {
            $project = Project::where('id', $project->id)->update([
                'title' => $request->title,
                'description' => $request->description
            ]);
        } catch (\Throwable $error) {
            \DB::rollback();
            return back()->withInput();
        }
        \DB::commit();

        return redirect('projects')->with('status', 'Success: Project Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        \DB::beginTransaction();
        try {
            DB::table('tasks')->where('project_id',$project->id)->delete();
            $project->delete();
        } catch (\Throwable $error) {
            \DB::rollback();
            return back()->withInput();
        }
        \DB::commit();

        return redirect('projects')->with('status', 'Success: Project Deleted!');

    }
}
