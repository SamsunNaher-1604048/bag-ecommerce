<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;


class CheckoutController extends Controller
{
    protected $cart;
    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }
    public function checkoutPage()
    {
        $session_id = session()->get('session_id');

        $data['sub_total'] = 0;
        $data['tax'] = 0;
        $data['total'] = 0;

        $data['carts'] = $this->cart->where(function($query) use ($session_id) {
            $query->where('session_id', $session_id)
                ->orWhere('user_id', auth()->id());
        })->with('product')->get();

        if( count($data['carts']) == 0 ){
            $alert = ['danger', 'Your cart is empty.'];
            return redirect()->back()->withAlert($alert);
        }
        foreach($data['carts'] as $cart){
            $data['sub_total'] += $cart->product->selling_price*$cart->quantity;
            $data['tax'] += ($cart->product->selling_price*($cart->product->tax/100))*$cart->quantity;
            $data['total'] += $data['sub_total'] + $data['tax'];
        }

        return view('pages.checkout', $data);
    }




}
