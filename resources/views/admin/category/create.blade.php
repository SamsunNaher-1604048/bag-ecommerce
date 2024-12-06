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
            <form action="{{route('admin.categories.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-9 mt-3">
                            <div class="form-group">
                                <label class="text-black" for="name">Name:</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" required>
                                @if($errors->has('name'))
                                    <small class="text-danger">{{$errors->first('name')}}</small>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-12 mt-3">
                                    <label>Status:</label>
                                    <div class="toggle-switch">
                                        <input type="checkbox" id="toggle" class="toggle-input" value="1"  name="status">
                                        <label for="toggle" class="toggle-label" ></label>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-12 mt-3">
                                    <label>Featured:</label>
                                    <div class="toggle-switch">
                                        <input type="checkbox" id="toggle1" class="toggle-input" value="1" name="is_featured">
                                        <label for="toggle1" class="toggle-label"></label>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-12 mt-3">
                                    <label>Show in Home Page:</label>
                                    <div class="toggle-switch">
                                        <input type="checkbox" id="toggle2" class="toggle-input" value="1" name="is_home_page">
                                        <label for="toggle2" class="toggle-label"></label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <div class="image-upload-wrapper">
                                <label for="imageInput">
                                    <i class="fa-solid fa-upload fa-3x"></i>
                                    <div> Click to Upload an Image</div>
                                </label>
                                <input type="file" id="imageInput" class="d-none" accept="image/*" name="image" required>

                                <div class="preview-container">
                                    <h5>Preview</h5>
                                    <img id="imagePreview" class="preview-image" src="{{asset('public/admin/images/categories/no image.jpg')}}" alt="Image Preview">
                                </div>
                            </div>
                            @if($errors->has('image'))
                                <small class="text-danger">{{ $errors->first('image') }}</small>
                            @endif
                        </div>

                        <div class="d-flex justify-content-end mt-5 ">
                            <button type="submit" class="btn btn-primary m-1">Submit</button>
                        </div>
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
