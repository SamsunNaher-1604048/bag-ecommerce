<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    public function registerPage(): View
    {
        return View('auth.registration');
    }

    public function register(Request $request): RedirectResponse
    {
          $validation = Validator::make($request->all(), [
              'username' => 'required|string|max:50',
              'email' => 'required|email|max:50|unique:users',
              'password' => 'required|string|min:6|max:15',
          ]);

          if($validation->fails()){
              return redirect()->back()->withErrors($validation)->withInput();
          }

          $user = User::create([
              'username'=>$request->input('username'),
              'email'=>$request->input('email'),
              'password'=>Hash::make($request->input('password')),
              'status'=>1
          ]);

          Auth::login($user);
          $alert = ['success', 'Successfully registered'];
          return redirect()->route('user.dashboard')->withAlert($alert);
    }
}
