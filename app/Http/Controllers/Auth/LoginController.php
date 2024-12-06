<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;


class LoginController extends Controller
{
    public function loginPage():View
    {
        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $validation = Validator::make($request->all(),[
            'email' => 'required|email|exists:users,email|max:50',
            'password' => 'required|min:6|max:50',
        ]);

        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $credential = $request->only('email','password');

        $user = User::where('email',$credential['email'])->first();
        if ($user && $user->status == '0') {
            $alert = ['danger', 'User is Inactive.'];
            return redirect()->back()->withAlert($alert);
        }

        if (Auth::attempt($credential)){
            $request->session()->regenerate();
            $alert = ['success', 'Successfully logged in'];
            return redirect()->route('user.dashboard')->withAlert($alert);
        }

        $alert = ['danger', 'Invalid email or password'];
        return redirect()->back()->withAlert($alert);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        $alert = ['success', 'Successfully logged out'];
        return redirect()->route('home')->withAlert($alert);
    }


    public function adminLoginPage(): View
    {
        return view('auth.admin-login');
    }

    public function adminLogin(Request $request): RedirectResponse
    {
        $validation = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $credential = $request->only('email','password');

        if (Auth::guard('admin')->attempt($credential)){
            $request->session()->regenerate();

            $alert = ['success', 'Successfully logged in'];
            return redirect()->route('admin.dashboard')->withAlert($alert);
        }

        $alert = ['success', 'Invalid email or password'];
        return redirect()->back()->withAlert($alert);
    }

    public function adminLogout(Request $request): RedirectResponse
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        $alert = ['success', 'Successfully logged out'];
        return redirect()->route('admin.login.page')->withAlert($alert);
    }

}
