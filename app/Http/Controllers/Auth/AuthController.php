<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\LoginRequest;

class AuthController extends Controller
{

    /**
     * Display the login page
     */
    public function create()
    {
        $event = Event::where('event_status', 'active')->first();
        return view('auth.login', [
            'event' => $event,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $user = User::where('email', $request->email)->first();
        if($user && Hash::check($request->password, $user->password)) {
            $request->authenticate();
    
            $request->session()->regenerate();
    
            return redirect()->intended(route('dashboard', absolute: false));
        } else {
            return back()->with([
                'error' => 'Email or Password is incorrect'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
