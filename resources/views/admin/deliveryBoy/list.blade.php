@extends('layouts.master')
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row m-t-30">
                    <div class="col-md-12">
                        <div class="table-responsive m-b-40">
                            <table class="table table-borderless table-data3">
                                <thead>
                                <tr>
                                    <th>Profile</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>phone</th>
                                    <th>Address</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($deliveryBoys as $deliveryBoy)
                                    <tr>
                                        <td>
                                            <img class="rounded-circle"
                                                 src="{{asset('storage/images/'.$deliveryBoy->image)}}"
                                                 width="45px">
                                        </td>
                                        <td>{{$deliveryBoy->name}}</td>
                                        <td>{{$deliveryBoy->email}}</td>
                                        <td>{{$deliveryBoy->phone}}</td>
                                        <td>{{$deliveryBoy->address}}</td>
                                        <td>
                                            <a href="{{route('admin.delivery.boy.edit',$deliveryBoy->id)}}"
                                               class="btn btn-icon btn-bg-light btn-sm btn-hover-rise me-1"
                                               style="color: black;">
                                                <i class="zmdi zmdi-edit"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <form
                                                action="{{route('admin.delivery.boy.delete',$deliveryBoy->id)}}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="item"
                                                        onclick="return confirm('Are you sure you want to delete it')">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <td colspan="7" class="text-center">
                                        No Data found
                                    </td>
                                @endforelse
                                </tbody>
                            </table>
                            {{$deliveryBoys->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
