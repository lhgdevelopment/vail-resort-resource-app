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
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail;

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
        // Validate user input
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if (Str::endsWith($request->email, ['vailresorts.com', 'marketeaminc.com'])) {
            $role_name = 'Operator';
            $role = Role::where('name', $role_name)->first();
            $is_approved = true;
            
        } else {
            $role_name = 'Supplier';
            $role = Role::where('name', $role_name)->first();
        }

        // Create the user with default approval as false and generate a verification token
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $role_name,
            'password' => Hash::make($request->password),
            'email_verification_token' => str()->random(32), // Generate random verification token
            'is_approved' => $is_approved ?? false, // Set approval as false by default
        ]);

        // Assign role based on email domain
        $user->roles()->attach($role);

        // Fire registered event (optional, if you're using it)
        event(new Registered($user));

        // Send email verification
        Mail::to($user->email)->send(new VerifyEmail($user));

        // Log in the user and redirect (you can also keep them logged out until verification)
        // Auth::login($user);

        return redirect()->route('login')->with('message', 'Registration successful! Please check your email (inbox or spam) and click the verification link to activate your account.');
    }

    public function verifyEmail($token)
    {
        $user = User::where('email_verification_token', $token)->first();

        if (!$user) {
            return redirect('/')->withErrors('Invalid or expired verification link. Please check your email or contact support if you need assistance.');
        }

        $user->email_verified_at = now();
        $user->email_verification_token = null;
        //Auto approval for specific domain
        if (Str::endsWith($user->email, ['vailresorts.com', 'marketeaminc.com'])) {
            $user->is_approved = true;
        } 

        
        $user->save();

        return redirect('/login')->with('message', 'Email verified successfully! You can now log in to your account.');
    }
}
