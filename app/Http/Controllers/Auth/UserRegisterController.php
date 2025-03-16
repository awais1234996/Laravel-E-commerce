<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\WebSiteUser;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class UserRegisterController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('user_site.signup');
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
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.WebSiteUser::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = WebSiteUser::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone'=>$request->phone,
            'country'=>$request->country,
            'state'=>$request->state,
            'city'=>$request->city,
            'postal_code'=>$request->postal_code,
            'address_1'=>$request->address_1,
            'address_2'=>$request->address_2

        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('userSite', absolute: false));
    }
}
