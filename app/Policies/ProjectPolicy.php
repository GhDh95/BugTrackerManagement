<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;

class ProjectPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function destroy(User $user): bool
    {
        return $user->role == 'admin';
    }

    public function show(User $user, Project $project): bool
    {
        $developers = $project->developers->toArray();
        $can_create = false;

        foreach($developers as $developer){
            if($developer['id'] == $user->id){
                $can_create = true;
                break;
            }

        }

        return $can_create;
    }


}
