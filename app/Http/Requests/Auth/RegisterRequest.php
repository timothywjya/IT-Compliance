<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['required', 'string', 'max:255'],
            'nik'        => ['required', 'string', 'size:10', 'unique:users,nik'],
            'username'   => ['required', 'string', 'max:255', 'unique:users,username'],
            'email'      => ['required', 'email', 'unique:users,email'],
            'password'   => ['required', 'string', 'min:8', 'confirmed'],
            'role_id'    => ['required', 'exists:roles,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'First name wajib diisi.',
            'last_name.required'  => 'Last name wajib diisi.',
            'nik.required'        => 'NIK wajib diisi.',
            'nik.size'            => 'NIK harus 10 karakter.',
            'nik.unique'          => 'NIK sudah terdaftar.',
            'username.required'   => 'Username wajib diisi.',
            'username.unique'     => 'Username sudah digunakan.',
            'email.required'      => 'Email wajib diisi.',
            'email.unique'        => 'Email sudah terdaftar.',
            'password.required'   => 'Password wajib diisi.',
            'password.min'        => 'Password minimal 8 karakter.',
            'password.confirmed'  => 'Konfirmasi password tidak cocok.',
            'role_id.required'    => 'Role wajib dipilih.',
            'role_id.exists'      => 'Role tidak ditemukan.',
        ];
    }
}
