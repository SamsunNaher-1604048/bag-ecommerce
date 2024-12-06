@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="mt-5">
                <h1 class="text-center">Sign Up</h1>
            </div>
        </div>
    </div>

    <div class= "container my-5">
        <div class="box py-4">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <form method="post" action="{{route('register')}}">
                        @csrf
                        <div class="mb-3">
                            <label class="text-black" for="username">Username:</label>
                            <input type="text" class="form-control" id="username" name="username" value="{{old('username')}}" required>
                            @error('username')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="text-black" for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}" required>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="text-black" for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mt-4 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">Sign Up</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
