<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TicketManagementController extends Controller
{
    //
    public function update(Ticket $ticket): RedirectResponse
    {
        $attributes = request()->validate([
            'name' => 'required',
            'description' => 'required',
            'status' => 'required',
            'priority' => 'required',
            'summary' => 'required'
        ]);
        $attributes['developer_id'] = auth()->id();
        $attributes['project_id'] = $ticket->project_id;

        $ticket->update($attributes);
        $route = "project/" . $ticket->project_id;
        return redirect($route)->with('message', 'Ticket with id of:  '.$ticket->id.' updated successfully');
    }
}
