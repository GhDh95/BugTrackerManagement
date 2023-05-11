<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\Ticket;
use App\Models\User;

class TicketPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function create(User $user,  Project $project): bool
    {
        if($project->developers()->where('user_id', $user->id)->exists()) {
            return true;
        }
        return false;
    }
}
