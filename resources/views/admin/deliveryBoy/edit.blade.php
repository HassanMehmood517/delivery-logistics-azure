@extends('layouts.master')
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center title-2">Edit Delivery Boy Detail</h3>
                                </div>
                                <hr>
                                <form action="{{route('admin.delivery.boy.update',$deliveryBoy->id)}}" method="post"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="control-label mb-1">Name</label>
                                                <input class="form-control @error('name') is-invalid @enderror "
                                                       name="name" type="text" value="{{$deliveryBoy->name}}">
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="control-label mb-1">Email</label>
                                                <input class="form-control @error('email') is-invalid @enderror "
                                                       name="email" type="email" value="{{$deliveryBoy->email}}">
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Phone</label>
                                        <input class="form-control @error('phone') is-invalid @enderror "
                                               name="phone" type="tel" value="{{$deliveryBoy->phone}}">
                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Address</label>
                                        <input class="form-control @error('address') is-invalid @enderror "
                                               name="address" type="text" value="{{$deliveryBoy->address}}">
                                        @error('address')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Choose file </label>
                                        <input class="form-control" name="image" type="file">
                                        <img src="{{asset('storage/images/'.$deliveryBoy->image)}}" alt="..."
                                             class="mt-3 img-thumbnail w-25">
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-lg btn-info btn-block mt-2">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
