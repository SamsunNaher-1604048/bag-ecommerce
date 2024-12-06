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
            <form action="{{route('admin.suppliers.store')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-sm-12 col-lg-6 col-md-6 mt-3">
                        <div class="form-group">
                            <label class="text-black" for="name">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" required>
                            @if($errors->has('name'))
                                <small class="text-danger">{{$errors->first('name')}}</small>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12 col-lg-6 col-md-6 mt-3">
                        <div class="form-group">
                            <label class="text-black" for="phone">Phone:</label>
                            <input type="text" class="form-control" name="phone" value="{{old('phone')}}" required>
                            @if($errors->has('phone'))
                                <small class="text-danger">{{$errors->first('phone')}}</small>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12 col-lg-6 col-md-6 mt-3">
                        <div class="form-group">
                            <label class="text-black" for="email">Email:</label>
                            <input type="email" class="form-control" name="email" value="{{old('email')}}" required>
                            @if($errors->has('email'))
                                <small class="text-danger">{{$errors->first('email')}}</small>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12 col-lg-6 col-md-6 mt-3">
                        <div class="form-group">
                            <label for="address">Address:</label><br>
                            <textarea id="comments" class="form-control" name="address" rows="4" cols="50" placeholder="Enter your address here..." required>{{ old('address') }}</textarea>
                            @if($errors->has('address'))
                                <small class="text-danger">{{$errors->first('address')}}</small>
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
