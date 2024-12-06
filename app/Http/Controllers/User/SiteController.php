<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;

class SiteController extends Controller
{
    protected $product;
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function productDetails($id)
    {
        $productDetails = $this->product->OfActive()->find($id);
        return view('pages.productDetails', compact('productDetails'));
    }

}
