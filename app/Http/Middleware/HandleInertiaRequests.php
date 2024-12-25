<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Tighten\Ziggy\Ziggy;

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
    public function version(Request $request): ?string
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
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
            ],
            'ziggy' => fn () => [
                ...(new Ziggy)->toArray(),
                'location' => $request->url(),
            ],

            'alert' => [
                'icon' => $request->session()->get('icon'),
                'text' => $request->session()->get('text'),
                'timer' => $request->session()->get('timer'),
                'title' => $request->session()->get('title'),
                'footer' => $request->session()->get('footer'),
                'confirmButtonText' => $request->session()->get('confirmButtonText'),
            ],
        ];
    }
}
