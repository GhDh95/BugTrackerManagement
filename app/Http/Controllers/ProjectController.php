<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use App\Notifications\NewProjectAssigned;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ProjectController extends Controller
{
    //

    public function index(): Response
    {
        return Inertia::render('Projects', [
            'projects' => Project::query()->filter(request(['search']))->latest()->with(['manager', 'developers'])->paginate(5)->withQueryString(),

        ]);
    }

    public function store(): RedirectResponse
    {
        $attributes = request()->validate([
            'name' => 'required',
            'description' => 'required',
            'manager_id' => 'required',
        ], [
            'manager_id.required' => 'Manager is required'
        ]);

        $project = Project::create($attributes);

        User::find($attributes['manager_id'])->notify(new NewProjectAssigned($project));

        $message = "Project with id of ". $project->id . " created";

        return back()->with('message', $message);
    }



    public function show(Request $request,Project $project): Response{


        return Inertia::render('project/Show', [
            'project' => $project->load('manager','developers'),
            'tickets'=> $project->tickets()->latest()->filter(request(['search']))->with('developer')->paginate(5)->withQueryString(),
            'can_create_ticket'=> $request->user()->can('show', $project),
        ]);
    }


    public function destroy(Project $project): RedirectResponse
    {

        $message = "Project with id of ". $project->id . " deleted";

        $project->delete();

        return back()->with('message', $message);
    }
}
