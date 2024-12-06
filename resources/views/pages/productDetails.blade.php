@extends('layouts.app')
@section('content')

    <div class="container product-page">
        <div class="row">
            <!-- Product Image Section -->
            <div class="col-md-6">
                <img src="{{asset('public/admin/images/products/'.$productDetails->image)}}" alt="Product Image" class="product-image img-fluid">
            </div>

            <!-- Product Details Section -->
            <div class="col-md-6">
                <h1 class="product-title">{{$productDetails->name}}</h1>
                <p class="price">{{$productDetails->selling_price}}</p>
                <p class="product-description">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ac vehicula mi. Proin mollis accumsan sem, ac laoreet mi posuere eu.
                </p>

                <!-- Color Selection -->
                <div class="mb-3">
                    <label for="colorSelect" class="form-label">Color</label>
                    <select class="form-select" id="colorSelect">
                        <option value="1">Red</option>
                        <option value="2">Blue</option>
                        <option value="3">Green</option>
                    </select>
                </div>

                <!-- Size Selection -->
                <div class="mb-3">
                    <label for="sizeSelect" class="form-label">Size</label>
                    <select class="form-select" id="sizeSelect">
                        <option value="S">Small</option>
                        <option value="M">Medium</option>
                        <option value="L">Large</option>
                    </select>
                </div>

                <!-- Quantity Selector -->
                <div class="mb-3 d-flex align-items-center">
                    <label for="quantity" class="form-label me-3">Quantity</label>
                    <input type="number" id="quantity" name="quantity" value="1" min="1" class="form-control quantity-input">
                </div>

                    <!-- Add to Cart Button -->
                <button type="button" class="btn add-to-cart-btn" data-product_id="{{$productDetails->id}}">Add to Cart</button>
            </div>
        </div>
    </div>
@endsection
