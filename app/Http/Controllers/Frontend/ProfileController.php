<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // show profile page
    public function index()
    {
        return view('frontend/profile/index');
    }
    // code with update and create profile
    public function updateUserDetails(Request $request)
    {

        $request->validate([
            'username' => ['required', 'string'],
            'phone' => ['required', 'digits:11'],
            'zip_code' => ['required', 'digits:5'],
            'address' => ['required', 'string', 'max:499']
        ]);


        $user = User::findOrFail(Auth::user()->id);
        $user->update([
            'name' => $request->username,
        ]);
        $user->userDetail()->updateOrCreate(
            [
                'user_id' => $user->id,
            ],
            [
                'phone' => $request->phone,
                'zip_code' => $request->zip_code,
                'address' => $request->address,
            ]
        );
        return redirect()->back()->with('message', 'User Profile Updated');
    }
    // show updatepaassword page
    public function changepassword()
    {
        return view('frontend/profile/change-password');
    }
    // code with update password
    public function updatepassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string', 'min:8'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);
        $currentPasswordStatus = Hash::check($request->current_password, auth()->user()->password);
        if ($currentPasswordStatus) {

            User::findorFail(Auth::user()->id)->update([
                'password' => Hash::make($request->password),
            ]);
            return redirect()->back()->with('message', 'Your Password Updated successfully');
        } else {
            return redirect()->back()->with('message', 'Current Password does not match with Old Password');
        }
    }
}
