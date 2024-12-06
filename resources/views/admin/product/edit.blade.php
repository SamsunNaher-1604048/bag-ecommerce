@extends('admin.layouts.app')
@section('content')
    <div class="p-5">
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-8">
                <h2>{{$type}}</h2>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{route('admin.products.update',$product->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="product-section">
                    <div class="product-header">
                        <p class="title fw-bold">Product Information</p>
                        <hr>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6 mt-3">
                            <label>Product Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{$product->name}}" required/>
                            @if($errors->has('name'))
                                <small class="text-danger">{{$errors->first('name')}}</small>
                            @endif
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-6 mt-3">
                            <label>Category</label>
                            <select class="form-select" aria-label="Default select example" name="category_id" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @if($errors->has('category_id'))
                                <small class="text-danger">{{$errors->first('category_id')}}</small>
                            @endif
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-6 mt-3">
                            <label>Brand</label>
                            <select class="form-select" aria-label="Default select example" name="brand_id" required>
                                @foreach($brands as $brand)
                                    <option value="{{$brand->id}}" {{$brand->id == $product->brand_id? 'selected' : '' }}>{{$brand->name}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('brand_id'))
                                <small class="text-danger">{{$errors->first('brand_id')}}</small>
                            @endif
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-6 mt-3">
                            <div class="row">
                                <div class="col-4">
                                    <label class="mb-2">Status:</label>
                                    <div class="toggle-switch">
                                        <input type="checkbox" id="toggle" class="toggle-input" value="1" name="status" {{$product->status == 1? 'checked':''}}>
                                        <label for="toggle" class="toggle-label"></label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label class="mb-2">Show in Home Page:</label>
                                    <div class="toggle-switch">
                                        <input type="checkbox" id="toggle1" class="toggle-input" value="1" name="is_home_page" {{$product->is_home_page == 1? 'checked':''}}>
                                        <label for="toggle1" class="toggle-label"></label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label class="mb-2">New Arrival:</label>
                                    <div class="toggle-switch">
                                        <input type="checkbox" id="toggle2" class="toggle-input" value="1" name="new_arrival" {{$product->new_arrival == 1? 'checked':''}}>
                                        <label for="toggle2" class="toggle-label"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="price-section mt-5">
                    <div class="product-header">
                        <p class="title fw-bold">Price and Tax</p>
                        <hr>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6 mt-3">
                            <label>Selling Price</label>
                            <input type="number" class="form-control" id="selling_price" name="selling_price" value="{{$product->selling_price}}" required/>
                            @if($errors->has('selling_price'))
                                <small class="text-danger">{{$errors->first('selling_price')}}</small>
                            @endif
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-6 mt-3">
                            <label>Buying Price</label>
                            <input type="number" class="form-control" id="buying_price" name="buying_price" value="{{$product->buying_price}}" required/>
                            @if($errors->has('buying_price'))
                                <small class="text-danger">{{$errors->first('buying_price')}}</small>
                            @endif
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-6 mt-3">
                            <label>Tax(%)</label>
                            <input type="number" class="form-control" id="tax" name="tax" value="{{$product->tax}}" required/>
                            @if($errors->has('tax'))
                                <small class="text-danger">{{$errors->first('tax')}}</small>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="image-section mt-5">
                    <div class="image-header">
                        <p class="title fw-bold">Image and Description</p>
                        <hr>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-9 mt-3">
                            <label for="summernote">Description</label>
                            <textarea id="summernote" class="form-control" name="description">{{$product->description}}</textarea>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <div class="image-upload-wrapper">
                                <label for="imageInput">
                                    <i class="fa-solid fa-upload fa-3x"></i>
                                    <div> Click to Upload an Image</div>
                                </label>
                                <input type="file" id="imageInput" class="d-none" accept="image/*" name="image">

                                <div class="preview-container">
                                    <h5>Preview</h5>
                                    <img id="imagePreview" class="preview-image" src="{{asset('public/admin/images/products/'.$product->image)}}" alt="Image Preview">
                                </div>
                            </div>
                            @if($errors->has('image'))
                                <small class="text-danger">{{ $errors->first('image') }}</small>
                            @endif
                        </div>

                    </div>
                </div>

                <div class="d-flex justify-content-end mt-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script>
        const imageInput = document.getElementById('imageInput');
        const imagePreview = document.getElementById('imagePreview');
        const previewContainer = document.querySelector('.preview-container');

        imageInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    previewContainer.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
@endpush
