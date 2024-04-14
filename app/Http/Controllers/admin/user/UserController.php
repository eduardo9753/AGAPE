<?php

namespace App\Http\Controllers\admin\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:Leer usuarios')->only('index');
        $this->middleware('can:Editar usuarios')->only('create', 'edit', 'update');
    }

    public function index()
    {
        $users = User::all();
        return view('admin.user.index', [
            'users' => $users
        ]);
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.user.edit', [
            'user' => $user,
            'roles' => $roles
        ]);
    }

    public function update(User $user, Request $request)
    {
        $user->roles()->sync($request->roles);
        return redirect()->route('admin.users.edit', $user)->with('exito', 'rol asignado correctamente al usuario');
    }
}
