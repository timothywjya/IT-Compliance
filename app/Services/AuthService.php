<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService
{
    public function register(array $data): User
    {
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name'  => $data['last_name'],
            'nik'        => $data['nik'],
            'username'   => $data['username'],
            'email'      => $data['email'],
            'password'   => Hash::make($data['password']),
            'role_id'    => $data['role_id'],
            'created_by' => auth()->id() ?? null,
        ]);

        return $user->load('role');
    }

    public function login(array $data): array
    {
        $user = User::with('role')
            ->where('username', $data['username'])
            ->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'username' => ['Username tidak ditemukan.'],
            ]);
        }

        if ($user->trashed()) {
            throw ValidationException::withMessages([
                'username' => ['Akun Anda telah dinonaktifkan.'],
            ]);
        }

        if (!Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'password' => ['Password salah.'],
            ]);
        }

        return ['user' => $user];
    }
}
