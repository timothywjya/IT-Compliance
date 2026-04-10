<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        return view('roles.index');
    }

    public function dataTable()
    {
        $roles = Role::with('users')->get()->map(fn($r) => [
            'id'        => $r->id,
            'role_name' => $r->role_name,
            'total'     => $r->users->count(),
            'created'   => $r->created_at?->format('d M Y'),
        ]);
        return response()->json(['data' => $roles]);
    }

    public function create()
    {
        return view('roles.form', ['role' => null]);
    }

    public function store(Request $request)
    {
        $request->validate(['role_name' => 'required|string|max:255|unique:roles,role_name']);
        Role::create(['role_name' => $request->role_name, 'created_by' => auth()->id()]);
        return redirect()->route('roles.index')->with('success', 'Role berhasil ditambahkan.');
    }

    public function edit(Role $role)
    {
        return view('roles.form', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate(['role_name' => 'required|string|max:255|unique:roles,role_name,' . $role->id]);
        $role->update(['role_name' => $request->role_name, 'updated_by' => auth()->id()]);
        return redirect()->route('roles.index')->with('success', 'Role berhasil diupdate.');
    }

    public function destroy(Role $role)
    {
        if ($role->users()->count() > 0) {
            return back()->with('error', 'Role tidak bisa dihapus karena masih digunakan.');
        }
        $role->delete();
        return back()->with('success', 'Role berhasil dihapus.');
    }
}
