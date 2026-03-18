<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;

class UserController extends Controller
{
    public function create()
    {
        return view('account.CreateAccount');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => 'user',
        ]);

        return redirect()->route('home')->with('success', 'Votre compte a été créé avec succès !');


    }

    public function log()
    {
        return view('account.login');
    }



    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate(); // anti session fixation
            return redirect()->intended('/')->with('success', 'Vous êtes maintenant connecté !');  // ou dashboard
        }

        return redirect('/login')->with('error', 'Identifiants invalides');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function ViewForgotPassword()
    {
        return view('account.forgotPassword');
    }

    public function forgotPassword(Request $request)
    {

        ResetPassword::createUrlUsing(function ($user, string $token) {
            return url("/reset-password?token={$token}&email={$user->email}");
        });
        $request->validate(['email' => 'required|email']);
        $status = Password::sendResetLink(
            $request->only('email')
        );
        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function ViewResetPassword(Request $request)
    {
        $request->validate(['token' => 'required', 'email' => 'required|email']);

        return view('account.ViewResetPassword', ['token' => $request->token, 'email' => $request->email]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->save();

                $user->setRememberToken(Str::random(60));

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

}