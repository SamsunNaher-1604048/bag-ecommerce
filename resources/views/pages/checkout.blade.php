@extends('layouts.app')
@section('content')
    <div>
        <div class="container">
            <div class="d-flex justify-content-center mt-3">
                <div>
                    <h1>Checkout Details</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="untree_co-section mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-5 mb-md-0">
                    <h2 class="h3 mb-3 text-black">Billing Details</h2>
                    <div class="p-3 p-lg-5 border bg-white">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="name" class="text-black">Name: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="" name="name" value="{{auth()->user()->fullName??''}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="email" class="text-black">Email: <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="" name="email" value="{{auth()->user()->email??' '}}">
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="text-black">Phone: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="" name="phone" value="{{auth()->user()->phone??' '}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="code" class="text-black">Post Code: <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="" name="code" value="{{auth()->user()->zip_code??' '}}">
                            </div>
                            <div class="col-md-6">
                                <label for="city" class="text-black">City: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="" name="city" value="{{auth()->user()->city??' '}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="address" class="text-black">Address: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="" name="address" value="{{auth()->user()->address??' '}}">
                            </div>
                        </div>


                        <div class="form-group row mb-5">
                            <div class="col-md-6">
                                <label for="shipping_id" class="text-black">Shipping: <span class="text-danger">*</span></label>
                                <select  class="form-control" name="shipping_id">
                                    <option>hello</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="shipping_price" class="text-black">Shipping Price: <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="shipping_price" name="shipping_price">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="comment" class="text-black">Order Notes:</label>
                            <textarea name="comment" id="" cols="30" rows="5" class="form-control" placeholder="Write your notes here..."></textarea>
                        </div>

                    </div>
                </div>
                <div class="col-md-6">

                    <div class="row mb-5">
                        <div class="col-md-12">
                            <h2 class="h3 mb-3 text-black">Coupon Code</h2>
                            <div class="p-3 p-lg-5 border bg-white">

                                <label for="c_code" class="text-black mb-3">Enter your coupon code if you have one</label>
                                <div class="input-group w-75 couponcode-wrap">
                                    <input type="text" class="form-control me-2" id="c_code" placeholder="Coupon Code" aria-label="Coupon Code" aria-describedby="button-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-black btn-sm" type="button" id="button-addon2">Apply</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-md-12">
                            <h2 class="h3 mb-3 text-black">Your Order</h2>
                            <div class="p-3 p-lg-5 border bg-white">
                                <table class="table site-block-order-table mb-5">
                                    <thead>
                                        <th>Product</th>
                                        <th>Total</th>
                                    </thead>
                                    <tbody>
                                        @foreach($carts as $cart)
                                            <tr>
                                                <td>{{$cart->product->name}}<strong class="mx-2">x</strong>{{$cart->quantity}}</td>
                                                <td>${{$cart->product->selling_price*$cart->quantity}}</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td class="text-black font-weight-bold"><strong>Subtotal:</strong></td>
                                            <td class="text-black font-weight-bold"><strong>${{$sub_total}}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="text-black font-weight-bold"><strong>Tax:</strong></td>
                                            <td class="text-black font-weight-bold"><strong>${{$tax}}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="text-black font-weight-bold"><strong>Order Total:</strong></td>
                                            <td class="text-black font-weight-bold"><strong>${{$total}}</strong></td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="border p-3 mb-3">
                                    <h3 class="h6 mb-0"><a class="d-block" data-bs-toggle="collapse" href="#collapsebank" role="button" aria-expanded="false" aria-controls="collapsebank">Direct Bank Transfer</a></h3>

                                    <div class="collapse" id="collapsebank">
                                        <div class="py-2">
                                            <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="border p-3 mb-3">
                                    <h3 class="h6 mb-0"><a class="d-block" data-bs-toggle="collapse" href="#collapsecheque" role="button" aria-expanded="false" aria-controls="collapsecheque">Cheque Payment</a></h3>

                                    <div class="collapse" id="collapsecheque">
                                        <div class="py-2">
                                            <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="border p-3 mb-5">
                                    <h3 class="h6 mb-0"><a class="d-block" data-bs-toggle="collapse" href="#collapsepaypal" role="button" aria-expanded="false" aria-controls="collapsepaypal">Paypal</a></h3>

                                    <div class="collapse" id="collapsepaypal">
                                        <div class="py-2">
                                            <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-black btn-lg py-3 btn-block" onclick="window.location='thankyou.html'">Place Order</button>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- </form> -->
        </div>
    </div>
@endsection
