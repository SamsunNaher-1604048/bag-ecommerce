<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

class CartController extends Controller
{

    protected $cart;
    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    public function cart(): View
    {
        $session_id = session()->get('session_id');

        $carts = $this->cart->where(function($query) use ($session_id){
            $query->where('session_id', $session_id)
                ->orWhere('user_id', auth()->id());
        })->with('product')->get();

        return view('pages.cart',['carts'=>$carts]);
    }

    public function cartProductCount():JsonResponse
    {
        $session_id = session()->get('session_id');

        $product = $this->cart->where(function($query) use ($session_id) {
            $query->where('session_id', $session_id)
                ->orWhere('user_id', auth()->id());
        })->count();

        return response()->json(['count' => $product]);
    }

    public function cartAdd( Request $request ): JsonResponse
    {
         $product_id = $request->integer('product_id');
         $quantity = $request->integer('quantity');
         $session_id = session()->get('session_id');

         if($session_id == null){
            session()->put('session_id', uniqid());
            $session_id = session()->get('session_id');
         }

         $product = $this->cart->where(function($query) use ($session_id) {
             $query->where('session_id', $session_id)
                 ->orWhere('user_id', auth()->id());
         })->where('product_id', $product_id)->first();

         if($product){
             return response()->json(['status'=>'danger', 'message'=>'Product already added to cart!']);
         }

         $cart = new Cart();
         $cart->user_id = auth()->user()->id??0;
         $cart->session_id = $session_id;
         $cart->product_id = $product_id;
         $cart->quantity = $quantity;
         $cart->save();

         return response()->json(['status'=>'success','message'=>'Product added to cart']);
    }

    public function cartRemove( Request $request ): JsonResponse
    {
        $cartItem = $this->cart->find($request->id);

        if ($cartItem) {
            $cartItem->delete();
            return response()->json(['status'=>'success', 'message'=>'product removed from cart']);
        } else {
            return response()->json(['status'=>'danger', 'message'=>'Item not found in cart!']);
        }

    }

    public function cartUpdate( Request $request ): JsonResponse
    {
        $cart_id = $request->input('cart_id');
        $session_id = session()->get('session_id');
        $quantity = $request->integer('quantity');


        $cart = $this->cart->where(function($query) use ($session_id) {
            $query->where('session_id', $session_id)
                ->orWhere('user_id', auth()->id());
        })->where('id',$cart_id)->first();

        if($cart){
            $cart->quantity = $quantity;
            $cart->save();

            $totalPrice = $quantity * $cart->product->selling_price;
            return response()->json(['status'=>'success', 'message'=>'Cart updated successfully', 'totalPrice'=>$totalPrice]);
        }
        return response()->json(['status'=>'danger', 'message'=>'Item not found in cart!']);
    }

    public function cartCalculate()
    {
        $session_id = session()->get('session_id');
        $sub_total = 0;
        $tax = 0;
        $discount = 0;

        $carts = $this->cart->where(function($query) use ($session_id){
            $query->where('session_id', $session_id)->orWhere('user_id', auth()->id());
        })->with('product')->get();

        foreach($carts as $cart){
           $sub_total += $cart->product->selling_price*$cart->quantity;
           $tax += ($cart->product->selling_price*($cart->product->tax/100))*$cart->quantity;
        }

        $total = $sub_total + $tax - $discount;
        return response()->json(['sub_total'=>$sub_total,'tax'=>$tax,'discount'=>$discount,'total'=>$total]);

    }

}
