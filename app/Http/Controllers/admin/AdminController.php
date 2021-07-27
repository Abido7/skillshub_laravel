<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class AdminController extends Controller
{
    public function admins()
    {
        $admin_role = Role::where('name', "admin")->first();
        $superAdmin_role = Role::where('name', "superadmin")->first();
        $data['admins'] = User::whereIn('role_id', [$admin_role->id, $superAdmin_role->id])->orderBy('id', 'DESC')->paginate(10);
        return view('admin.admins.admins')->with($data);
    }
    public function create()
    {
        $data['roles'] = Role::select('id', 'name')->whereIn('name', ['admin', 'superadmin'])->get();
        return view('admin.admins.create-admin')->with($data);
    }
    public function store(Request $request)
    {
        $newAdminData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|string|confirmed|min:8|max:25',
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id
        ]);
        event(new Registered($user));
        return redirect(url("/dashboard/admins"));
    }

    public function promoteToggle(User $user)
    {
        $superAdmin = Role::where('name', 'superadmin')->first();
        $admin = Role::where('name', 'admin')->first();
        $user->update([
            'role_id' => $user->role->name == 'admin' ? $superAdmin->id : $admin->id
        ]);
        return back();
    }

    public function delete(User $user)
    {
        $user->delete();
        return back();
    }
}