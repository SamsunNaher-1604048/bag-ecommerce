@extends('admin.layouts.app')
@section('content')
    <div class="p-5">
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-9">
                <h2>{{$type}}</h2>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="post" action="{{route('admin.users.update',$user->id)}}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm-12 col-md-9">
                        <div class="row">

                            <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                                <div class="form-group">
                                    <label class="text-black" for="first_name">First Name:</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $user->first_name??'' }}">
                                    @if($errors->has('first_name'))
                                        <small class="text-danger">{{ $errors->first('first_name') }}</small>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                                <div class="form-group">
                                    <label class="text-black" for="last_name">Last Name:</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $user->last_name??'' }}">
                                    @if($errors->has('last_name'))
                                        <small class="text-danger">{{ $errors->first('last_name') }}</small>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                                <div class="form-group">
                                    <label class="text-black" for="username">Username:</label>
                                    <input type="text" class="form-control" id="username" name="username" value="{{ $user->username??'' }}">
                                    @if($errors->has('username'))
                                        <small class="text-danger">{{ $errors->first('username') }}</small>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                                <div class="form-group">
                                    <label class="text-black" for="email">Email:</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email??'' }}">
                                    @if($errors->has('email'))
                                        <small class="text-danger">{{ $errors->first('email') }}</small>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                                <div class="form-group">
                                    <label class="text-black" for="phone">Phone:</label>
                                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone??'' }}">
                                    @if($errors->has('phone'))
                                        <small class="text-danger">{{ $errors->first('phone') }}</small>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                                <div class="form-group">
                                    <label class="text-black" for="city">City:</label>
                                    <input type="text" class="form-control" id="city" name="city" value="{{ $user->city??'' }}">
                                    @if($errors->has('city'))
                                        <small class="text-danger">{{ $errors->first('city') }}</small>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                                <div class="form-group">
                                    <label class="text-black" for="zip_code">Zip Code:</label>
                                    <input type="number" class="form-control" id="zip_code" name="zip_code" value="{{ $user->zip_code??'' }}">
                                    @if($errors->has('zip_code'))
                                        <small class="text-danger">{{ $errors->first('zip_code') }}</small>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                                <div class="form-group">
                                    <label class="text-black" for="address">Address:</label>
                                    <input type="text" class="form-control" id="address" name="address" value="{{ $user->address??'' }}">
                                    @if($errors->has('address'))
                                        <small class="text-danger">{{ $errors->first('address') }}</small>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-12 mt-3">
                                        <label>Status:</label>
                                        <div class="toggle-switch">
                                            <input type="checkbox" id="toggle" class="toggle-input" value="1"  name="status" {{$user->status == 1?'checked':" "}}>
                                            <label for="toggle" class="toggle-label" ></label>
                                        </div>
                                    </div>

                                    <div class="col-lg-8 col-md-8 col-sm-12 mt-3">
                                        <label>Email Verification:</label>
                                        <div class="toggle-switch">
                                            <input type="checkbox" id="toggle1" class="toggle-input" value="1" name="email_verified" {{$user->email_verified == 1?'checked':" "}}>
                                            <label for="toggle1" class="toggle-label"></label>
                                        </div>
                                    </div>
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
                                <img id="imagePreview" class="preview-image" src="{{asset('public/assets/uploads/'.($user->image??'no image.jpg'))}}" alt="Image Preview">
                            </div>
                        </div>
                        @if($errors->has('image'))
                            <small class="text-danger">{{ $errors->first('image') }}</small>
                        @endif
                    </div>
                </div>

                <div class="mt-5 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary m-1">Update</button>
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
