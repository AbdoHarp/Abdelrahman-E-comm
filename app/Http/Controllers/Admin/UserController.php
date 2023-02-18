<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // show users list
    public function index()
    {
        $users = User::paginate(10);
        return view('admin/users/index', compact('users'));
    }
    // show created users page
    public function create()
    {
        return view('admin/users/create');
    }
    // save data in database 
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'role_as' => ['required', 'integer'],
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_as' => $request->role_as
        ]);
        return redirect('/admin/users')->with('message', 'User Add Successfully');
    }
    // show edit page and data uasers
    public function edit(int $userid)
    {
        $users = User::findOrFail($userid);
        return view('admin/users/edit', compact('users'));
    }
    // updata data in database and save a new data
    public function update(Request $request, int $userid)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
            'role_as' => ['required', 'integer'],
        ]);
        User::findOrFail($userid)->update([
            'name' => $request->name,
            'password' => Hash::make($request['password']),
            'role_as' => $request->role_as
        ]);
        return redirect('/admin/users')->with('message', 'User updated Successfully');
    }
    // function use for the deleted
    public function destroy(int $userid)
    {

        $users = User::findOrFail($userid);
        $users->delete();
        return redirect('/admin/users')->with('message', 'User Deleted Successfully');
    }
}
