<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Trait\ImageTrait;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class UserController extends Controller
{
    use ImageTrait;
    protected $path = 'assets/uploads';

    public function dashboard(): View
    {
        return view('users.dashboard');
    }

    public function profileEdit (): View
    {
        return view('users.profileEdit');
    }

    public function orders (): View
    {
        return view('users.orders');
    }

    public function profileUpdate(Request $request, $id): RedirectResponse
    {

        $validation = Validator::make($request->all(), [
            'first_name'    => 'nullable|string|max:50',
            'last_name'     => 'nullable|string|max:50',
            'username'      => 'nullable|string|max:50',
            'email'         => 'email|max:50|unique:users,email,' . $id,
            'phone'         => 'nullable|string|max:50|unique:users,phone,' . $id,
            'image'         => 'nullable|image|mimes:jpeg,png,jpg',
            'city'          => 'nullable|string|max:50',
            'zip_code'   => 'nullable|number|max:20',
            'address'    => 'nullable|string|max:100',
        ]);

        if($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        try {
            $user = User::findOrFail($id);
            $alert = $this->update( $user, $request);
            return redirect()->back()->withAlert($alert);

        } catch (Exception $e) {
            $alert = ['danger', 'User not found.'];
            return redirect()->back()->withAlert($alert);
        }
    }

    protected function update( $user, $request ): array
    {
        $presentImage = $request->file('image');
        $previousImage = $user->image;

        $image = $this->uploadImage( $presentImage, $this->path, $previousImage );

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->city = $request->city;
        $user->zip_code = $request->zip_code;
        $user->address = $request->address;
        $user->image = $image;
        $user->save();

        return ['success', 'Profile updated successfully.'];
    }



}
