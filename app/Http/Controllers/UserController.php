<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function dataTable()
    {
        $users = User::with('role')->get()->map(fn($u) => [
            'id'         => $u->id,
            'name'       => $u->first_name . ' ' . $u->last_name,
            'nik'        => $u->nik,
            'username'   => $u->username,
            'email'      => $u->email,
            'role'       => $u->role->role_name ?? '-',
            'deleted_at' => $u->deleted_at,
        ]);
        return response()->json(['data' => $users]);
    }

    public function create()
    {
        $roles = Role::all();
        return view('users.form', ['user' => null, 'roles' => $roles]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'nik'        => 'required|string|size:10|unique:users,nik',
            'username'   => 'required|string|max:255|unique:users,username',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|string|min:8|confirmed',
            'role_id'    => 'required|exists:roles,id',
        ]);

        User::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'nik'        => $request->nik,
            'username'   => $request->username,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'role_id'    => $request->role_id,
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.form', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'nik'        => 'required|string|size:10|unique:users,nik,' . $user->id,
            'username'   => 'required|string|max:255|unique:users,username,' . $user->id,
            'email'      => 'required|email|unique:users,email,' . $user->id,
            'role_id'    => 'required|exists:roles,id',
            'password'   => 'nullable|string|min:8|confirmed',
        ]);

        $data = [
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'nik'        => $request->nik,
            'username'   => $request->username,
            'email'      => $request->email,
            'role_id'    => $request->role_id,
            'updated_by' => auth()->id(),
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        return redirect()->route('users.index')->with('success', 'User berhasil diupdate.');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Tidak bisa menghapus akun sendiri.');
        }
        $user->delete(); // Soft delete
        return back()->with('success', 'User berhasil dinonaktifkan.');
    }
}
