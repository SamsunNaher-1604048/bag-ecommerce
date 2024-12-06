@extends('layouts.app')
@section('content')

    <!-- Start Hero Section -->
{{--    <div class="hero">--}}
{{--        <div class="container">--}}
{{--            <div class="row justify-content-between">--}}
{{--                <div class="col-lg-5">--}}
{{--                    <div class="intro-excerpt">--}}
{{--                        <h1>Shop</h1>--}}
{{--                        <p>Explore Our sophisticated collection, and chose your desire one</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-7">--}}
{{--                    <div class="hero-img-wrap">--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

        <div>
            <div class="banner-image-container">
                <img src="{{asset('public/assets/images/banner.jpg')}}" alt="Image">
                <div class="row">
                    <div class="banner-text">
                        <h1>Shop</h1>
                        <p class="text-center">Explore Our sophisticated collection, and chose your desire one</p>
                    </div>
                </div>
            </div>
        </div>



    <button id="toggleSidebarBtn" class="toggle-btn">☰ Menu</button>
    <!-- End Hero Section -->

    <div class="mt-3 mr-3 d-flex justify-content-end">
        <input class="form-control product-search" placeholder="Search Here">
    </div>

    <div class="untree_co-section product-section before-footer-section">
        <div class="container-fluid">
            <div class="d-flex mx-5">
                <div class="col-12 col-md-4 col-lg-3">
                    <div id="sidebar" class="accordion">
                        <div class="accordion-item">
                            <label for="accordion1" class="accordion-label">Category</label>
                            <div class="accordion-content">
                               @forelse($categories as $category)
                                    <div class="d-flex gap-4 py-2">
                                        <img class="image" src="{{asset('public/admin/images/categories/'.$category->image)}}" alt="img" >
                                        <p>{{$category->name}}</p>
                                    </div>
                                @empty
                                   <p>Category is empty</p>
                               @endforelse
                            </div>
                        </div>
                        <div class="accordion-item">
                            <label for="accordion2" class="accordion-label">Brand</label>
                            <div class="accordion-content">
                                @forelse($brands as $brand)
                                    <div class="d-flex gap-4 py-2">
                                        <img class="image" src="{{asset('public/admin/images/brands/'.$brand->image)}}" alt="img" >
                                        <p>{{$brand->name}}</p>
                                    </div>
                                @empty
                                    <p>Brand is empty</p>
                                @endforelse
                            </div>
                        </div>
                        <div class="accordion-item">
                            <label for="accordion3" class="accordion-label">Color</label>
                            <div class="accordion-content">
                                @forelse($colors as $color)
                                    <label class="color-swatch" style="background-color: {{$color->code}};">
                                        <input type="checkbox" name="color[]" value="{{$color->code}}">
                                    </label>
                                @empty
                                    <p>Brand is empty</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    @forelse($products as $product)
                        <div class="col-12 col-md-4 col-lg-3 mb-4">
                            <div class="product-item">
                                <a href="{{route('product.details',$product->id)}}">
                                    <img src="{{asset('public/admin/images/products/'.$product->image)}}" class="img-fluid product-thumbnail" alt="img"/>
                                </a>

                                <span class="wishlist-icon  {{ in_array($product->id, $wishlists) ? 'wishlist-active' : '' }}" data-product_id="{{$product->id}}">
                                      <a class="wishlist">
                                          <i class="fa-regular fa-heart  wishlist-heart-icon  {{ in_array($product->id, $wishlists) ? 'wishlist-heart-icon-active' : '' }}"></i>
                                      </a>
                                </span>

                                <h3 class="product-title">{{$product->name}}</h3>
                                <strong class="product-price">{{$product->selling_price}}</strong>
                                <span class="icon-cross">
								    <img src="{{asset('public/assets/images/cross.svg')}}" class="img-fluid add-product" data-product_id ='{{$product->id}}' alt="img">
							    </span>
                            </div>
                        </div>
                    @empty
                        <p>No product</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

@endsection
