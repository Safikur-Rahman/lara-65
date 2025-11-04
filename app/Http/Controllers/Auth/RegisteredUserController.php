<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\RegisterConfirmationMail;
use App\Models\User;
use App\Models\Role;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $roles = Role::all();
        return view('auth.register' , compact('roles'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // $request->validate([
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        //     'password' => ['required', 'confirmed', Rules\Password::defaults()],
        // ]);

        // $user = User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        // ]);

        $request->validate([
            'first_name' => 'required|min:2|max:20',
            'last_name' => ['required', 'min:2', 'max:20'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:6', 'confirmed'],
        ],
        );
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => $request->password,
            'role_id' => $request->role_id
        ]);

        event(new Registered($user));
        $u = User::select('u.first_name','u.last_name','u.email','r.name as role')
                    ->from('users as u')
                    ->join('roles as r', 'u.role_id','=','r.id')
                    ->where('u.id',$user->id)
                    ->first(); 
        // dd($u);
        Mail::to($user->email)->send(new RegisterConfirmationMail($u));
        // dd('Mail Sent');
        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
