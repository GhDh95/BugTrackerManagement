<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TicketController extends Controller
{
    //

    public function destroy(Request $request, Ticket $ticket): RedirectResponse
    {
        if($request->user()->role === 'admin' || $ticket->project->manager_id === $request->user()->id){
            $ticket->delete();
            $message = "Ticket with id: " . $ticket->id . " deleted";
        }else{
            $message = "You are not authorized to delete this ticket: " . $ticket->id;
        }

        return redirect()->back()->with('message', $message);
    }

    public function create(): Response
    {
        $project_id = request()->input('project_id');

        return Inertia::render('ticket/Create', [
            'project_id' => $project_id,
            ]);







    }

    public function store(Request $request): RedirectResponse
    {
        $developer_id = $request->user()->id;

        $attributes = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'summary' => 'required',
            'project_id' => 'required',
            'priority' => 'required',
            'status' => 'required',
        ]);


        $message = "";
        $developers = Project::find($attributes['project_id'])->developers ?? null;

        if($developers && $developers->contains($developer_id)){
            $attributes['developer_id'] = $developer_id;
            $ticket = Ticket::create(
                $attributes);

            $message = "Ticket with id: " . $ticket->id . " created";
        }else{
            $message = "You are not authorized to create a ticket for this project";
        }


        $route = "/project/" . $attributes['project_id'];

        return redirect($route)->with('message', $message);

    }


    public function update(Request $request, Ticket $ticket): Response|RedirectResponse
    {
        $project = $ticket->project;
        if($request->user()->can('show', $project)){
            return Inertia::render('ticket/Create', [
                'ticket' => $ticket
                ]);
        }
        return redirect()->back()->with('message', 'You are not authorized to update this ticket:  ' . $ticket->id);

    }

}
