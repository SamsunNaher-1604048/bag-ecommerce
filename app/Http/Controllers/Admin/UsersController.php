<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Trait\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Exception;
use Symfony\Component\HttpFoundation\RedirectResponse;

class UsersController extends Controller
{
    use ImageTrait;
    protected $path = 'assets/uploads';
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index(): View
    {
         $data['users'] = $this->user->latest()->get();
         $data['type'] = 'All Users';

         return view('admin.users.index', $data);
    }

    public function active(): View
    {
        $data['users'] = $this->user->ofActive()->latest()->get();
        $data['type'] = 'Active Users';

        return view('admin.users.index', $data);
    }

    public function inactive(): View
    {
        $data['users'] = $this->user->ofInactive()->latest()->get();
        $data['type'] = 'Inactive Users';

        return view('admin.users.index',$data);
    }

    public function edit($id): RedirectResponse|View
    {
        $data['user'] = $this->user->findOrFail($id);
        $data['type'] = 'Edit User';

        if($data['user'])
        {
            return view('admin.users.edit', $data);
        }
        $alert = ['danger', 'User not found!'];
        return redirect()->back()->withAlert('alert', $alert);

    }

    public function update (Request $request, $id): RedirectResponse
    {

        $validation = Validator::make($request->all(), [
            'first_name'    => 'nullable|string|max:50',
            'last_name'     => 'nullable|string|max:50',
            'username'      => 'nullable|string|max:50',
            'email'         => 'email|max:50|unique:users,email,' . $id,
            'phone'         => 'nullable|string|max:50|unique:users,phone,' . $id,
            'image'         => 'nullable|image|mimes:jpeg,png,jpg',
            'city'          => 'nullable|string|max:50',
            'zip_code'      => 'nullable|number|max:20',
            'address'       => 'nullable|string|max:100',
        ]);

        if($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        try {
            $user = User::findOrFail($id);
            $alert = $this->profileUpdate( $user, $request);
            return redirect()->back()->withAlert($alert);

        } catch (Exception $e) {
            $alert = ['danger', 'something went wrong!.'];
            return redirect()->back()->withAlert($alert);
        }
    }

    public function profileUpdate($user, $request): array
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
        $user->status = $request->status??0;
        $user->email_verified = $request->email_verified??0;
        $user->image = $image;
        $user->save();

        return ['success', 'Profile updated successfully.'];
    }
}
