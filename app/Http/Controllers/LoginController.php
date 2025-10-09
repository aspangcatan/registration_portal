<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\AuthService;

class LoginController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    // Show login page
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Process login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        if ($this->authService->attemptLogin($request->only('username', 'password'))) {
            $user = Auth::user(); // get the logged-in user

            if ($user->division == 2 && in_array($user->section, [21, 15])) {
                return redirect()->route('admin.pending-users.index')
                    ->with('success', 'Welcome back!');
            } else {
                return redirect()->route('login.form')
                    ->withErrors(['login' => 'You do not have permission to access this page.'])
                    ->withInput($request->only('username'));
            }
        }

        return back()
            ->withErrors(['login' => 'Invalid username or password.'])
            ->withInput();
    }

    // Logout user
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.form')
            ->with('success', 'You have been logged out.');
    }
}
