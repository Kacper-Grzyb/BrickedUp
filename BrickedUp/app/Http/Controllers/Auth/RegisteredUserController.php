<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use DB;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $themeMarketshare = DB::table('dashboard_elements')->where('name', '=', 'theme-marketshare')->first();
        $setPriceTable = DB::table('dashboard_elements')->where('name', '=', 'set-price-table')->first();
        $setPrices = DB::table('dashboard_elements')->where('name', '=', 'set-prices')->first();
        $themePrices = DB::table('dashboard_elements')->where('name', '=', 'theme-prices')->first();
        $subthemePrices = DB::table('dashboard_elements')->where('name', '=', 'subtheme-prices')->first();
        // Insert a base layout
        DB::table('user_dashboard_layouts')->insert(
            [
                'user_id' => $user->id,
                'element_id' => $themeMarketshare->id,
                'style' => 'grid-row: 1 / 6; grid-column: 1 / 5'
            ]
        );

        DB::table('user_dashboard_layouts')->insert(
            [
                'user_id' => $user->id,
                'element_id' => $setPriceTable->id,
                'style' => 'grid-row: 1 / 6; grid-column: 5 / 11'
            ]
        );

        DB::table('user_dashboard_layouts')->insert(
            [
                'user_id' => $user->id,
                'element_id' => $setPrices->id,
                'style' => 'display: none'
            ]
        );

        DB::table('user_dashboard_layouts')->insert(
            [
                'user_id' => $user->id,
                'element_id' => $themePrices->id,
                'style' => 'display: none'
            ]
        );

        DB::table('user_dashboard_layouts')->insert(
            [
                'user_id' => $user->id,
                'element_id' => $subthemePrices->id,
                'style' => 'display: none'
            ]
        );

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('home', absolute: false));
    }
}
