@extends('layouts.app')
@section('content')
    <div>
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{asset('public/assets/images/background.jpeg')}}" class="d-block w-100 carousel-img" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{asset('public/assets/images/background2.jpeg')}}" class="d-block w-100 carousel-img" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{asset('public/assets/images/background5.png')}}" class="d-block w-100 carousel-img" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{asset('public/assets/images/background4.png')}}" class="d-block w-100 carousel-img" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <!-- End Hero Section -->

    <!-- Start Product Section -->
    @if($products)
        <div class="product-section">
            <div class="container-fluid">
                <div class="">
                        <h2 class="mb-4 section-title d-flex justify-content-center">Crafted with excellent material.</h2>
                        <p class="mb-4 d-flex justify-content-center">Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam
                            vulputate velit imperdiet dolor tempor tristique. </p>
                </div>
                <div class="row mx-5">
                    @foreach($products as $product)
                        <div class="col-12 col-md-4 col-lg-2 mb-5 mb-md-0 mt-4">
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
								    <img src="{{asset('public/assets/images/cross.svg')}}" class="img-fluid add-product" data-product_id = '{{$product->id}}'  alt="img">
							    </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    <!-- End Product Section -->

    <!-- Start Why Choose Us Section -->
    <div class="why-choose-section">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-6">
                    <h2 class="section-title">Why Choose Us</h2>
                    <p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit
                        imperdiet dolor tempor tristique.</p>

                    <div class="row my-5">
                        <div class="col-6 col-md-6">
                            <div class="feature">
                                <div class="icon">
                                    <img src="{{asset('public/assets/images/truck.svg')}}" alt="Image" class="imf-fluid">
                                </div>
                                <h3>Fast &amp; Free Shipping</h3>
                                <p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam
                                    vulputate.</p>
                            </div>
                        </div>

                        <div class="col-6 col-md-6">
                            <div class="feature">
                                <div class="icon">
                                    <img src="{{asset('public/assets/images/bag.svg')}}" alt="Image" class="imf-fluid">
                                </div>
                                <h3>Easy to Shop</h3>
                                <p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam
                                    vulputate.</p>
                            </div>
                        </div>

                        <div class="col-6 col-md-6">
                            <div class="feature">
                                <div class="icon">
                                    <img src="{{asset('public/assets/images/support.svg')}}" alt="Image" class="imf-fluid">
                                </div>
                                <h3>24/7 Support</h3>
                                <p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam
                                    vulputate.</p>
                            </div>
                        </div>

                        <div class="col-6 col-md-6">
                            <div class="feature">
                                <div class="icon">
                                    <img src="{{asset('public/assets/images/return.svg')}}" alt="Image" class="imf-fluid">
                                </div>
                                <h3>Hassle Free Returns</h3>
                                <p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam
                                    vulputate.</p>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="img-wrap">
                        <img src="{{asset('public/assets/images/why-choose-us-img.jpg')}}" alt="Image" class="img-fluid">
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End Why Choose Us Section -->

{{--    start category section--}}
    @if($categories)
        <div class="category-section">
            <div>
                <h2 class="mb-4 section-title d-flex justify-content-center">Explore Our Top Categories</h2>
                <p class="mb-4 d-flex justify-content-center">Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam
                    vulputate velit imperdiet dolor tempor tristique. </p>
            </div>

            <div class="container-fluid mx-5">
                <div class="row">
                   @foreach($categories as $category)
                        <div class="col-12 col-md-4 col-lg-2 mb-5 mb-md-0">
                            <a class="category-item" href="">
                                <img src="{{asset('public/admin/images/categories/'.$category->image)}}" class="img-fluid category-thumbnail" alt="image">
                                <h3 class="category-title">{{$category->name}}</h3>
                            </a>
                        </div>
                   @endforeach
                </div>
            </div>
        </div>
    @endif
{{--    end category section--}}

    <!-- Start We Help Section -->
    <div class="we-help-section">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-7 mb-5 mb-lg-0">
                    <div class="imgs-grid">
                        <div class="grid grid-1"><img src="{{asset('public/assets/images/img-grid-1.jpg')}}" alt="Untree.co"></div>
                        <div class="grid grid-2"><img src="{{asset('public/assets/images/img-grid-2.jpg')}}" alt="Untree.co"></div>
                        <div class="grid grid-3"><img src="{{asset('public/assets/images/img-grid-3.jpg')}}" alt="Untree.co"></div>
                    </div>
                </div>
                <div class="col-lg-5 ps-lg-5">
                    <h2 class="section-title mb-4">We Help You Make Modern Interior Design</h2>
                    <p>Donec facilisis quam ut purus rutrum lobortis. Donec vitae odio quis nisl dapibus malesuada.
                        Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique. Pellentesque
                        habitant morbi tristique senectus et netus et malesuada</p>

                    <ul class="list-unstyled custom-list my-4">
                        <li>Donec vitae odio quis nisl dapibus malesuada</li>
                        <li>Donec vitae odio quis nisl dapibus malesuada</li>
                        <li>Donec vitae odio quis nisl dapibus malesuada</li>
                        <li>Donec vitae odio quis nisl dapibus malesuada</li>
                    </ul>
                    <p><a herf="#" class="btn">Explore</a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- End We Help Section -->

    <!-- Start Popular Product -->
    <div class="popular-product">
        <div class="container">
            <div class="row">

                <div class="col-12 col-md-6 col-lg-4 mb-4 mb-lg-0">
                    <div class="product-item-sm d-flex">
                        <div class="thumbnail">
                            <img src="{{asset('public/assets/images/product-1.png')}}" alt="Image" class="img-fluid">
                        </div>
                        <div class="pt-3">
                            <h3>Nordic Chair</h3>
                            <p>Donec facilisis quam ut purus rutrum lobortis. Donec vitae odio </p>
                            <p><a href="#">Read More</a></p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4 mb-4 mb-lg-0">
                    <div class="product-item-sm d-flex">
                        <div class="thumbnail">
                            <img src="{{asset('public/assets/images/product-2.png')}}" alt="Image" class="img-fluid">
                        </div>
                        <div class="pt-3">
                            <h3>Kruzo Aero Chair</h3>
                            <p>Donec facilisis quam ut purus rutrum lobortis. Donec vitae odio </p>
                            <p><a href="#">Read More</a></p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4 mb-4 mb-lg-0">
                    <div class="product-item-sm d-flex">
                        <div class="thumbnail">
                            <img src="{{asset('public/assets/images/product-3.png')}}" alt="Image" class="img-fluid">
                        </div>
                        <div class="pt-3">
                            <h3>Ergonomic Chair</h3>
                            <p>Donec facilisis quam ut purus rutrum lobortis. Donec vitae odio </p>
                            <p><a href="#">Read More</a></p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End Popular Product -->

    <!-- Start Testimonial Slider -->
    <div class="testimonial-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 mx-auto text-center">
                    <h2 class="section-title">Testimonials</h2>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="testimonial-slider-wrap text-center">

                        <div id="testimonial-nav">
                            <span class="prev" data-controls="prev"><span class="fa fa-chevron-left"></span></span>
                            <span class="next" data-controls="next"><span class="fa fa-chevron-right"></span></span>
                        </div>

                        <div class="testimonial-slider">

                            <div class="item">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8 mx-auto">

                                        <div class="testimonial-block text-center">
                                            <blockquote class="mb-5">
                                                <p>&ldquo;Donec facilisis quam ut purus rutrum lobortis. Donec vitae
                                                    odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam
                                                    vulputate velit imperdiet dolor tempor tristique. Pellentesque
                                                    habitant morbi tristique senectus et netus et malesuada fames ac
                                                    turpis egestas. Integer convallis volutpat dui quis scelerisque.&rdquo;</p>
                                            </blockquote>

                                            <div class="author-info">
                                                <div class="author-pic">
                                                    <img src="{{asset('public/assets/images/person-1.png')}}" alt="Maria Jones" class="img-fluid">
                                                </div>
                                                <h3 class="font-weight-bold">Maria Jones</h3>
                                                <span class="position d-block mb-3">CEO, Co-Founder, XYZ Inc.</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- END item -->

                            <div class="item">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8 mx-auto">

                                        <div class="testimonial-block text-center">
                                            <blockquote class="mb-5">
                                                <p>&ldquo;Donec facilisis quam ut purus rutrum lobortis. Donec vitae
                                                    odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam
                                                    vulputate velit imperdiet dolor tempor tristique. Pellentesque
                                                    habitant morbi tristique senectus et netus et malesuada fames ac
                                                    turpis egestas. Integer convallis volutpat dui quis scelerisque.&rdquo;</p>
                                            </blockquote>

                                            <div class="author-info">
                                                <div class="author-pic">
                                                    <img src="{{asset('public/assets/images/person-1.png')}}" alt="Maria Jones" class="img-fluid">
                                                </div>
                                                <h3 class="font-weight-bold">Maria Jones</h3>
                                                <span class="position d-block mb-3">CEO, Co-Founder, XYZ Inc.</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- END item -->

                            <div class="item">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8 mx-auto">

                                        <div class="testimonial-block text-center">
                                            <blockquote class="mb-5">
                                                <p>&ldquo;Donec facilisis quam ut purus rutrum lobortis. Donec vitae
                                                    odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam
                                                    vulputate velit imperdiet dolor tempor tristique. Pellentesque
                                                    habitant morbi tristique senectus et netus et malesuada fames ac
                                                    turpis egestas. Integer convallis volutpat dui quis scelerisque.&rdquo;</p>
                                            </blockquote>

                                            <div class="author-info">
                                                <div class="author-pic">
                                                    <img src="{{asset('public/assets/images/person-1.png')}}" alt="Maria Jones" class="img-fluid">
                                                </div>
                                                <h3 class="font-weight-bold">Maria Jones</h3>
                                                <span class="position d-block mb-3">CEO, Co-Founder, XYZ Inc.</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- END item -->

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Testimonial Slider -->

@endsection

