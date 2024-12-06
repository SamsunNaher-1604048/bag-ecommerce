@extends('layouts.app')
@section('content')
    <div class="container">
        @include('users.includes.header')

        <div>
            @include('users.includes.nav')
                <div class=" m-5">
                    <div class="profile_details">
                        <div class="profile_details_content">
                            <div class="page-title fs-1 my-5">Profile Setting</div>

                            <div class="profile_adress">
                                <div class="profile_adress_wrapper">
                                    <div class="address_item mt-3">
                                        <form action="{{route('user.profile.update',Auth::user()->id)}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-sm-12 col-md-9">
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label class="text-black" for="first_name">First Name:</label>
                                                                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ Auth::user()->first_name??'' }}">
                                                                @if($errors->has('first_name'))
                                                                    <small class="text-danger">{{ $errors->first('first_name') }}</small>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label class="text-black" for="last_name">Last Name:</label>
                                                                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ Auth::user()->last_name??'' }}">
                                                                @if($errors->has('last_name'))
                                                                    <small class="text-danger">{{ $errors->first('last_name') }}</small>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label class="text-black" for="username">Username:</label>
                                                                <input type="text" class="form-control" id="username" name="username" value="{{ Auth::user()->username??'' }}">
                                                                @if($errors->has('username'))
                                                                    <small class="text-danger">{{ $errors->first('username') }}</small>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label class="text-black" for="email">Email:</label>
                                                                <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email??'' }}">
                                                                @if($errors->has('email'))
                                                                    <small class="text-danger">{{ $errors->first('email') }}</small>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label class="text-black" for="phone">Phone:</label>
                                                                <input type="text" class="form-control" id="phone" name="phone" value="{{ Auth::user()->phone??'' }}">
                                                                @if($errors->has('phone'))
                                                                    <small class="text-danger">{{ $errors->first('phone') }}</small>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label class="text-black" for="city">City:</label>
                                                                <input type="text" class="form-control" id="city" name="city" value="{{ Auth::user()->city??'' }}">
                                                                @if($errors->has('city'))
                                                                    <small class="text-danger">{{ $errors->first('city') }}</small>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label class="text-black" for="zip_code">Zip Code:</label>
                                                                <input type="number" class="form-control" id="zip_code" name="zip_code" value="{{ Auth::user()->zip_code??'' }}">
                                                                @if($errors->has('zip_code'))
                                                                    <small class="text-danger">{{ $errors->first('zip_code') }}</small>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label class="text-black" for="address">Address:</label>
                                                                <input type="text" class="form-control" id="address" name="address" value="{{ Auth::user()->address??'' }}">
                                                                @if($errors->has('address'))
                                                                    <small class="text-danger">{{ $errors->first('address') }}</small>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 col-md-3">
                                                    <div class="image-upload-wrapper">
                                                        <label for="imageInput">
                                                            <i class="fa-solid fa-upload fa-3x"></i>
                                                            <div> Click to Upload an Image</div>
                                                        </label>
                                                        <input type="file" id="imageInput" class="d-none" accept="image/*" name="image">

                                                        <div class="preview-container">
                                                            <h5>Preview</h5>
                                                            <img id="imagePreview" class="preview-image" src="{{asset('public/assets/uploads/'.(Auth::user()->image??'no image.jpg'))}}" alt="Image Preview">
                                                        </div>
                                                    </div>
                                                    @if($errors->has('image'))
                                                        <small class="text-danger">{{ $errors->first('image') }}</small>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="mt-5 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary-hover-outline">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
