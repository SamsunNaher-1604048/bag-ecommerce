<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    protected $category;
    protected $product;
    protected $brand;
    protected $color;
    protected $wishlist;

    public function __construct(Category $category, Product $product, Brand $brand, Color $color, Wishlist $wishlist)
    {
        $this->category = $category->ofActive();
        $this->product = $product->ofActive();
        $this->brand = $brand->ofActive();
        $this->color = $color->ofActive();

        $session_id = session()->get('session_id');
        $this->wishlist = $wishlist->where('session_id', $session_id)->orwhere('user_id', auth()->id())->pluck('product_id')->toArray();
    }

     public function home()
     {
         $data['categories'] = $this->category->ofVisible()->inRandomOrder()->take(6)->get();
         $data['products'] = $this->product->ofVisible()->inRandomOrder()->take(12)->get();
         $data['wishlists'] = $this->wishlist;
         return view('home',$data);
     }

     public function shop(): View
     {
         $data['categories'] = $this->category->latest()->get();
         $data['colors'] = $this->color->latest()->get();
         $data['brands'] = $this->brand->latest()->get();
         $data['products'] = $this->product->latest()->get();
         $data['wishlists'] = $this->wishlist;

         return view('pages.shop',$data);
     }

     public function about(): View
     {
         return view('pages.about');
     }

     public function contact(): View
     {
         return view('pages.contact');
     }
}
