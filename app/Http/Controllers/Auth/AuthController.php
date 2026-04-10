<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Role;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct(protected AuthService $authService) {}

    public function showLogin()
    {
        return Auth::check()
            ? redirect()->route('dashboard')
            : view('auth.login');
    }

    public function showRegister()
    {
        $roles = \App\Models\Role::all();
        return Auth::check()
            ? redirect()->route('dashboard')
            : view('auth.register', compact('roles'));
    }

    public function login(LoginRequest $request)
    {
        $result = $this->authService->login($request->validated());

        // Login via Laravel Session Auth
        Auth::login($result['user']);
        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }

    public function register(RegisterRequest $request)
    {
        $this->authService->register($request->validated());
        return redirect()->route('login')->with('success', 'Registrasi berhasil, silakan login.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Anda telah logout.');
    }
}
