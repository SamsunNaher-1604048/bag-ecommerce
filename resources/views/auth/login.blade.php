@extends('layouts.app')
@section('content')
    <!-- Start Contact Form -->
    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="mt-5">
                <h1 class="text-center">Good to see you again</h1>
            </div>
        </div>
    </div>

    <div class= "container my-5">
        <div class="box py-4">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <form action="{{route('login')}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label class="text-black" for="us">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="text-black" for="">Password:</label>
                            <input type="password" class="form-control" id="password" name="password">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <a href="">Forget Password</a>
                        </div>

                        <div class="mt-4 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">Sign In</button>
                        </div>
                    </form>

                    <div>
                        <p>Not Sign Up? <a href="{{route('register.page')}}">Sign Up</a></p>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
