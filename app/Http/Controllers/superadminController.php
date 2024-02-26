<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;

class superadminController extends Controller
{
    public function index()
    {
        $allUsers = User::where('role_id', '!=', 1)->get();

        return view('superAdmin.dashboard', compact(['allUsers']));
    }

    public function allUsers(Request $request)
    {
        $role_id = $request->role_id;
        $roleName = Role::findOrFail($role_id)->role_name;
        return view('superAdmin.userManagement', compact(['role_id','roleName']));
    }

    public function addUser()
    {
        return view('dashboard.adduser');
    }

    public function editUser(Request $request)
    {
        $userId = $request->userId;
        return view('dashboard.edituser',compact(['userId']));
    }
}
