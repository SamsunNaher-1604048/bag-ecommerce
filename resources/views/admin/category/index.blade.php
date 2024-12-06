@extends('admin.layouts.app')
@section('content')
    <div class="p-5">
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-8">
                <h2>{{$type}}</h2>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="d-flex gap-4">
                    <input class="form-control" placeholder="search here">
                    <a href="{{route('admin.categories.create')}}" class="btn btn-primary">Add Category</a>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">

            <table class="table">
                <thead class="table-primary">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($categories as $category )
                    <tr>
                        <td>{{$loop->iteration}}</td>

                        <td>
                            <img class='image' src="{{asset('public/admin/images/categories/'.$category->image)}}" alt="img"/>
                        </td>

                        <td>{{$category->name}}</td>

                        <td>
                            @if($category->status == 1)
                                <span class="badge bg-success rounded-3 fw-semibold">Active</span>
                            @else
                                <span class="badge bg-danger rounded-3 fw-semibold">Inactive</span>
                            @endif
                        </td>

                        <td>
                            <a href="{{route('admin.categories.edit',$category->id)}}" class="btn btn-info m-1"><i class="fa-solid fa-pen-to-square"></i></a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            Category list is empty
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
