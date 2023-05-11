<?php

namespace App\Http\Middleware;

use App\Models\Project;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $request->user()?->load(['projects','developerProjects']),
                'team' => Project::query()->where('manager_id', optional($request->user())->id)->with('developers')->get(),
                'can' => [
                    'destroy_project' => $request->user()?->can('destroy', Project::class),
                    ]
                ],
            'unread_notifications' => $request->user()?->unreadNotifications??null,
            'flash' => [
                'message' => fn () => $request->session()->get('message')
            ],
            'managers'=> User::where('role', 'manager')->get(),
            'developers'=> User::where('role', 'developer')->get(),
            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy)->toArray(), [
                    'location' => $request->url(),
                ]);
            },
        ]);
    }
}
