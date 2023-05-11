<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    //

    public function index(): Response
    {

        //$bar_chart data
        $managers = User::where('role', 'manager')->pluck('name')->toArray();
        $bar_data = [];
        foreach ($managers as $manager){
            $bar_data[] = ['manager_name'=>$manager, 'number_of_projects'=>User::where('name',$manager)->get()->first()->projects->count()];
        }

        //donut_chart data
        $high_priority_tickets = Ticket::where('priority', 'high')->get()->count();
        $medium_priority_tickets = Ticket::where('priority', 'medium')->get()->count();
        $low_priority_tickets = Ticket::where('priority', 'low')->get()->count();
        $donut_data = ['high' => $high_priority_tickets, 'medium' => $medium_priority_tickets, 'low' => $low_priority_tickets];


        return Inertia::render('Dashboard',[
            'bar_chart' => $bar_data,
            'donut_data' => $donut_data,
            'general_metrics' =>[
                'number_of_projects' => Project::all()->count(),
                'number_of_tickets' => Ticket::all()->count(),
                'number_of_admins' => User::where('role', 'admin')->get()->count(),
                'number_of_managers' => User::where('role', 'manager')->get()->count(),
                'number_of_developers' => User::where('role', 'developer')->get()->count(),
            ],
        ]);
    }
}
