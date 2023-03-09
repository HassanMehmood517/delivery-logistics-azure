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
                                    <th>Logo</th>
                                    <th>Nane</th>
                                    <th>Email</th>
                                    <th>phone</th>
                                    <th>Address</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($stores as $store)
                                    <tr>
                                        <td>
                                            <img class="rounded-circle"
                                                 src="{{asset('storage/logo/'.$store->image)}}"
                                                 width="45px">
                                        </td>
                                        <td>{{$store->name}}</td>
                                        <td>{{$store->email}}</td>
                                        <td>{{$store->phone}}</td>
                                        <td>{{$store->address}}</td>
                                    </tr>
                                @empty
                                    <td colspan="5" class="text-center">
                                        No Data found
                                    </td>
                                @endforelse
                                </tbody>
                            </table>
                            {{$stores->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
