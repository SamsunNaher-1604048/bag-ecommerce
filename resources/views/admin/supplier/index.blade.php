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
                    <a href="{{route('admin.suppliers.create')}}" class="btn btn-primary">Add Supplier</a>
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
                    <th scope="col">Name</th>
                    <th scope="col">phone</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($suppliers as $supplier )
                    <tr>
                        <td>{{$loop->iteration}}</td>

                        <td>{{$supplier->name}}</td>
                        <td>
                            {{$supplier->phone}}
                        </td>
                        <td>
                            <a href="{{route('admin.suppliers.edit',$supplier->id)}}" class="btn btn-info m-1"><i class="fa-solid fa-pen-to-square"></i></a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            Suppliers list is empty
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
