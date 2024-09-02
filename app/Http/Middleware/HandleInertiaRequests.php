<?php

namespace App\Http\Middleware;

use App\Facades\Cart;
use App\Models\Currency;
use Illuminate\Http\Request;
use Inertia\Middleware;

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
        $currencies = Currency::all();
        $activeCurrency = $currencies->firstWhere('is_active', 1);

        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
            ],
            'flash' => [
                'message' => fn() => $request->session()->get('message')
            ],
            'cart' => Cart::shared(),
            'currencies' => $currencies,
            'activeCurrency' => $activeCurrency,
        ];
    }
}
