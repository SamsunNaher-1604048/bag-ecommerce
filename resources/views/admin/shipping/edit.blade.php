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
            <form action="{{route('admin.shipping.update',$shipping->id)}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-sm-12 col-lg-6 col-md-6 mt-3">
                        <div class="form-group">
                            <label class="text-black" for="name">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{$shipping->name}}" required>
                            @if($errors->has('name'))
                                <small class="text-danger">{{$errors->first('name')}}</small>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12 col-lg-6 col-md-6 mt-3">
                        <div class="form-group">
                            <label class="text-black" for="phone">Price:</label>
                            <input type="text" class="form-control" name="price" value="{{$shipping->price}}" required>
                            @if($errors->has('price'))
                                <small class="text-danger">{{$errors->first('price')}}</small>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12 col-lg-6 col-md-6 mt-3">
                        <label>Status:</label>
                        <div class="toggle-switch">
                            <input type="checkbox" id="toggle" class="toggle-input" value="1"  name="status"  {{$shipping->status == 1?'checked':''}}>
                            <label for="toggle" class="toggle-label" ></label>
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