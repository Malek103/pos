<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\User;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Rules\MatchOldPassword;

class UserProfileController extends Controller
{

    public function index()
    {

        $user = Auth::user();
        return view('user-profile', [
            'user' => $user,
        ]);
    }

    public function update(Request $request)
    {
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
    public function indexPassword()
    {
        return view('changePassword');
    }
    public function storePassword(Request $request)
    {
        $request->validate([
            'password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'password_confirmation' => ['same:new_password'],
        ]);

        User::find(Auth::id())->update(['password' => Hash::make($request->new_password)]);
        return redirect()->route('profile')->withSuccessMessage('تم تعديل كلمة السر بنجاح');
    }
}
