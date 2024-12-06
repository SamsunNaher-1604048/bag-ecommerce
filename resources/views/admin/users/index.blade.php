@extends('admin.layouts.app')
@section('content')
    <div class="p-5">
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-9">
                <h2>{{$type}}</h2>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3">
                <input class="form-control" name="search" placeholder="search here" >
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
                    <th scope="col">Username</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Email</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td scope="col">{{$loop->iteration}}</td>
                            <td>
                                <img class='image' src="{{asset('public/assets/uploads/'.($user->image??'no image.jpg'))}}" alt="img"/>
                            </td>
                            <td>
                                {{$user->full_name}}
                            </td>
                            <td>
                                {{$user->username}}
                            </td>
                            <td>
                                {{$user->phone}}
                            </td>
                            <td>
                                {{$user->email}}
                            </td>
                            <td>
                                <a href="{{route('admin.users.edit', $user->id)}}" class="btn btn-info m-1"><i class="fa-solid fa-pen-to-square"></i></a>

                                <a class="btn btn-secondary m-1" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-bars"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                                    <div class="message-body">
                                        <a href="" class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="fa-solid fa-info"></i>
                                            <p class="mb-0 fs-3">Login Log</p>
                                        </a>
                                        <a href="" class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="fa-solid fa-info"></i>
                                            <p class="mb-0 fs-3">Email Log</p>
                                        </a>
                                        <a href="" class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="fa-solid fa-envelope"></i>
                                            <p class="mb-0 fs-3">Send Email</p>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                User list is empty
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
