<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Trait\ImageTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Exception;

class CategoryController extends Controller
{
    use ImageTrait;

    protected $path = 'admin/images/categories/';
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index(): View
    {
        $data['type'] = 'Categories List';
        $data['categories'] = $this->category->latest()->get();
        return view('admin.category.index', $data);
    }

    public function create(): View
    {
        $data['type'] = 'Add Category';
        return view('admin.category.create', $data);
    }

    public function store(Request $request): RedirectResponse
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|unique:categories|max:50',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $category = new Category();
        $this->saveCategoryData($category, $request);

        $alert = ['success', 'Category added successfully!'];
        return redirect()->route('admin.categories.list')->withAlert($alert);
    }

    public function edit($id): View
    {

        $data['type'] = 'Edit Category';
        $data['category'] = $this->category->findOrFail($id);

        if($data['category']){
            return view('admin.category.edit', $data);
        }
        $alert = ['danger', 'Something went wrong!'];
        return redirect()->back()->withAlert($alert);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|max:50|unique:categories,name,'.$id,
            'image' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        try{
            $category = Category::findOrFail($id);
            $previousImage = $category->image;

            $this->saveCategoryData($category, $request, $previousImage);

            $alert = ['success', 'Category updated successfully!'];
            return redirect()->route('admin.categories.list')->withAlert($alert);

        }catch ( Exception $e){
            $alert = ['danger', 'Something went wrong!'];
            return redirect()->back()->withAlert($alert);
        }
    }

    private function saveCategoryData( Category $category, Request $request, $previousImage = null ): void
    {
        $presentImage = $request->file('image');

        $category->name = $request->input('name');
        $category->status = $request->input('status')??0;
        $category->is_featured = $request->input('is_featured')??0;
        $category->is_home_page = $request->input('is_home_page')??0;
        $category->image = $this->uploadImage( $presentImage, $this->path, $previousImage);
        $category->save();
    }


}
