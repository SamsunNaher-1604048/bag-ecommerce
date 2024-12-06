<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Trait\ImageTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class BrandController extends Controller
{
    use ImageTrait;

    protected $path = 'admin/images/brands/';
    protected $brand;

    public function __construct(Brand $brand)
    {
        $this->brand = $brand;
    }

    public function index(): View
    {
        $data['type'] = 'Brand List';
        $data['brands'] = $this->brand->latest()->get();
        return view('admin.brand.index',$data);
    }

    public function create(): View
    {
        $data['type'] = 'Brand Create';
        return view('admin.brand.create',$data);
    }

    public function store(Request $request): RedirectResponse
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|unique:brands|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validation->fails()) {
            return back()->withErrors($validation)->withInput();
        }

        $brand = new Brand();
        $this->saveBrandData($brand,$request);

        $alert = ['success','Brand added successfully.'];
        return redirect()->route('admin.brands.list')->withAlert($alert);
    }

    public function edit($id): View|RedirectResponse
    {
        $data['type'] = 'Brand Edit';
        $data['brand'] = $this->brand->findOrFail($id);

        if( $data['brand'] ){
            return view('admin.brand.edit',$data);
        }

        $alert = ['error','Something went wrong.'];
        return redirect()->back()->withAlert($alert);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:brands,name,'.$id,
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        try {
            $brand = $this->brand->findOrFail($id);
            $previousImage = $brand->image;

            $this->saveBrandData($brand,$request,$previousImage);

            $alert = ['success','Brand updated successfully.'];
            return redirect()->route('admin.brands.list')->withAlert($alert);

        }catch ( \Exception $e ){
            $alert = ['error','Something went wrong.'];
            return redirect()->back()->withAlart($alert);
        }
    }

    private function saveBrandData( Brand $brand, Request $request, $previousImage = null ): void
    {
        $presentImage = $request->file('image');

        $brand->name = $request->input('name');
        $brand->status  = $request->input('status')??0;
        $brand->top_brand  = $request->input('top_brand')??0;
        $brand->image = $this->uploadImage( $presentImage, $this->path, $previousImage );
        $brand->save();
    }
}
