@extends('layouts.app')
@section('content')
    <div>
        <div class="container">
            <div class="d-flex justify-content-center mt-3">
                <div class="intro-excerpt">
                    <h1>Shopping Cart</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <div class="untree_co-section before-footer-section">
        <div class="container">
            <div class="row mb-5">
                <form class="col-md-12" method="post">
                    <div class="site-blocks-table">
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="product-thumbnail">Image</th>
                                <th class="product-name">Product</th>
                                <th class="product-price">Price</th>
                                <th class="product-quantity">Quantity</th>
                                <th class="product-total">Total</th>
                                <th class="product-remove">Remove</th>
                            </tr>
                            </thead>
                            <tbody id="cart">
                            @foreach($carts as  $cart)
                                <tr id="{{$cart->id}}">
                                    <td class="product-thumbnail">
                                        <img src="{{asset('public/admin/images/products/'.$cart->product->image)}}" alt="Image" class="img-fluid">
                                    </td>
                                    <td class="product-name">
                                        <h2 class="h5 text-black">{{$cart->product->name}}</h2>
                                    </td>
                                    <td>{{$cart->product->selling_price}}</td>
                                    <td>
                                        <div class="input-group mb-3 d-flex align-items-center quantity-container" style="max-width: 120px;">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-outline-black decrease cart-update" data-cart_id="{{$cart->id}}" type="button">&minus;</button>
                                            </div>
                                            <input type="text" class="form-control text-center quantity-amount quantity-input_{{$cart->id}}" value="{{$cart->quantity}}" placeholder=""
                                                   aria-label="Example text with button addon" aria-describedby="button-addon1">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-black increase cart-update" data-cart_id='{{$cart->id}}' type="button">+</button>
                                            </div>
                                        </div>

                                    </td>
                                    <td class="total-price{{$cart->id}}">{{$cart->product->selling_price*$cart->quantity}}</td>
                                    <td><a class="btn btn-black btn-sm cart-remove"  data-id = {{$cart->id}}>X</a></td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </form>
            </div>

            <div class="row">

                <div class="col-md-6">
                    <div class="row mb-5">
                        <div class="col-md-6">
                            <a href="{{route('shop')}}" class="btn btn-primary btn-sm btn-block">Continue Shopping</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 pl-5">
                    <div class="row justify-content-end">
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-12 text-right border-bottom mb-5">
                                    <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <span class="text-black">Subtotal</span>
                                </div>
                                <div class="col-md-6 text-right">
                                    <strong class="text-black" id="sub-total"></strong><strong>$</strong>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <span class="text-black">Tax</span>
                                </div>
                                <div class="col-md-6 text-right">
                                    <strong class="text-black" id="tax"></strong><strong>$</strong>
                                </div>
                                <hr/>
                            </div>

                            <div class="row mb-5">
                                <div class="col-md-6">
                                    <span class="text-black">Total</span>
                                </div>
                                <div class="col-md-6 text-right">
                                    <strong class="text-black" id="total"></strong><strong>$</strong>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <a class="btn btn-primary btn-lg py-3 btn-block" href="{{route('checkout')}}">Proceed To Checkout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
