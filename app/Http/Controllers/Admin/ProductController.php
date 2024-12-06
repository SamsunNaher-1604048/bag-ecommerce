<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Trait\ImageTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class ProductController extends Controller
{

    use ImageTrait;
    protected $product;
    protected $brands;
    protected $categories;
    protected $path = 'admin/images/products/';

    public function __construct(Product $product, Brand $brands, Category $categories){
        $this->product = $product;
        $this->brands = $brands;
        $this->categories = $categories;
    }

    public function index(): View
    {
        $data['type'] = 'Product List';
        $data['products'] = $this->product->latest()->get();
        return view('admin.product.index', $data);
    }

    public function active(): View
    {
        $data['type'] = 'Active Product List';
        $data['products'] = $this->product->ofActive()->latest()->get();
        return view('admin.product.index',$data);
    }

    public function inActive(): View
    {
        $data['type'] = 'InActive Product List';
        $data['products'] = $this->product->ofInactive()->latest()->get();
        return view('admin.product.index', $data);
    }

    public function create(): View
    {
        $data['type'] = 'Add Product';
        $data['brands'] = $this->brands->ofActive()->latest()->get();
        $data['categories'] = $this->categories->ofActive()->latest()->get();
        return view('admin.product.create', $data);
    }

    public function store(Request $request):RedirectResponse
    {

        $validation  = Validator::make($request->all(),[
            'name' => 'required|unique:products|max:100',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'selling_price' => 'required|numeric|max:1000',
            'buying_price'=>'required|numeric|max:1000',
            'tax'=>'required|numeric|max:1000',
            'image' => 'required|mimes:jpg,jpeg,png',
        ]);

        if($validation->fails()){
            return redirect()->back()->withInput()->withErrors($validation);
        }

        $product = new Product();
        $this->saveProductData($product, $request);

        $alert = ['success', 'Product added successfully.'];
        return redirect()->route('admin.products.list')->withAlert($alert);
    }

    public function edit($id)
    {
        $data['product'] = $this->product->findOrFail($id);
        if($data['product']){
            $data['type'] = 'Update Product';
            $data['brands'] = $this->brands->ofActive()->latest()->get();
            $data['categories'] = $this->categories->ofActive()->latest()->get();
            return view('admin.product.edit',$data);
        }
        $alert = ['error', 'Product not found.'];
        return redirect()->back()->withAlert($alert);
    }

    public function update(Request $request, $id)
    {
        $validation  = Validator::make($request->all(),[
            'name' => 'required|max:100|unique:products,name,'.$id,
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'selling_price' => 'required|numeric|max:1000',
            'buying_price'=>'required|numeric|max:1000',
            'tax'=>'required|numeric|max:1000',
            'image' => 'mimes:jpg,jpeg,png',
        ]);

        if($validation->fails()){
            return redirect()->back()->withInput()->withErrors($validation);
        }

        try{
            $product =  $this->product->findOrFail($id);
            $previousImage = $product->image;
            $this->saveProductData( $product, $request, $previousImage );
            $alert = ['success', 'Product added successfully.'];
            return redirect()->route('admin.products.list')->withAlert($alert);

        }catch (\Exception $e){
            $alert = ['danger', 'something went wrong.'];
            return redirect()->back()->withAlert($alert);
        }
    }

    private function saveProductData( Product $product, Request $request, $previousImage = null ): void
    {
        $presentImage = $request->file('image');

        $product->name = $request->input('name');
        $product->category_id = $request->input('category_id');
        $product->brand_id = $request->input('brand_id');
        $product->status = $request->input('status')??0;
        $product->is_home_page = $request->input('is_home_page')??0;
        $product->new_arrival = $request->input('new_arrival')??0;
        $product->selling_price = $request->input('selling_price');
        $product->buying_price = $request->input('buying_price');
        $product->quantity = 0;
        $product->tax = $request->input('tax');
        $product->description = $request->input('description');
        $product->image = $this->uploadImage( $presentImage, $this->path, $previousImage );
        $product->save();
    }


}
