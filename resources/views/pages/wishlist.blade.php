@extends('layouts.app')
@section('content')
    <div>
        <div class="banner-image-container">
            <img src="{{asset('public/assets/images/banner.jpg')}}" alt="Image">
            <div class="row">
                <div class="banner-text">
                    <h1>Wishlist</h1>
                    <p class="text-center">Explore Our sophisticated collection, and chose your desire one</p>
                </div>
            </div>
        </div>
    </div>

    <div class="untree_co-section product-section before-footer-section">
        <div class="container-fluid">
            <div class="m-5">
                <div class="row">
                    @forelse($wishlists as $wishlist)
                        <div class="col-12 col-md-4 col-lg-2 mb-4">
                            <div class="product-item wishlist{{$wishlist->id}}">
                                <a href="{{route('product.details',$wishlist->id)}}">
                                    <img src="{{asset('public/admin/images/products/'.$wishlist->product->image)}}" class="img-fluid product-thumbnail" alt="img"/>
                                </a>
                                <span class="wishlist-remove">
                                      <a class="wishlist-cross-icon" data-wishlist_id="{{$wishlist->id}}">
                                          <i class="fa-solid fa-square-xmark wishlist-heart-icon"></i>
                                      </a>
                                </span>
                                <h3 class="product-title">{{$wishlist->product->name}}</h3>
                                <strong class="product-price">{{$wishlist->product->selling_price}}</strong>
                                <span class="icon-cross">
								    <img src="{{asset('public/assets/images/cross.svg')}}" class="img-fluid add-product" data-product_id ='{{$wishlist->id}}' alt="img">
							    </span>
                            </div>
                        </div>
                    @empty
                        <p>Wishlist is Empty</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

@endsection
