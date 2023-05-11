<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use App\Notifications\NewProjectAssigned;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class Developer_ProjectController extends Controller
{
    //

    public function index(){

    }

    public function store(): RedirectResponse
    {
        $attributes = request()->validate([
            'developer_id' => 'required',
            'project_id' => ['required'],
        ]);

        if(Project::find($attributes['project_id'])->developers()->where('developer_id', $attributes['developer_id'])->exists()){
            return back()->with('message', 'Developer already added to project');
        }

        Project::find($attributes['project_id'])->developers()->attach($attributes['developer_id']);
        $developers_id = $attributes['developer_id'];
        $message = "Developers with id: " . implode(', ', $developers_id) . " added to project";

        foreach ($attributes['developer_id'] as $developer_id) {
            $developer = User::find($developer_id)->notify(new NewProjectAssigned(Project::find($attributes['project_id'])));
        }

        return back()->with('message', $message);
    }

    public function destroy(){
        $project_id = request('project_id');
        $developer_id = request('developer_id');
        $project = Project::find($project_id);
        $project->developers()->detach($developer_id);
        $message = "developer with id: " . $developer_id . " has been removed." ;
        return back()->with('message', $message);



        //remove developer

    }
}
