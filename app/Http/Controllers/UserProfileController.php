<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('auth.user-profile', [
            'user' => $user,
        ]);
    }

    public function update(Request $request)
    {
        // dd($request->name);

        // dd($request->password);
        $user = $request->user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id)

            ],
            'password_confirmation' => ['same:password']

        ]);
        $user->update(['name' => $request->name, 'email' => $request->email]);
        if (!empty($request->password)) {
            $user->update(['password' => Hash::make($request->password)]);
        }
        return redirect()->back()->withSuccessMessage('تم تعديل الاعدادات بنجاح');
    }
}
