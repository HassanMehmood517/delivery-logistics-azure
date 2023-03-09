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
                                    <h3 class="text-center title-2">Enter Delivery Boy Detail</h3>
                                </div>
                                <hr>
                                <form action="{{route('admin.store.delivery.boy')}}" method="post"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="control-label mb-1">Name</label>
                                                <input class="form-control @error('name') is-invalid @enderror "
                                                       name="name" type="text" value="{{old('name')}}" required>
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
                                                       name="email" type="email" value="{{old('email')}}" required>
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
                                               name="phone" type="tel" value="{{old('phone')}}" required>
                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Address</label>
                                        <input class="form-control @error('address') is-invalid @enderror "
                                               name="address" type="text" value="{{old('address')}}" required>
                                        @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="control-label mb-1">Password</label>
                                                <input class="form-control @error('password') is-invalid @enderror "
                                                       name="password" type="password" required>
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label class="control-label mb-1">Confirm Password</label>
                                            <div class="input-group">
                                                <input
                                                    class="form-control @error('password_confirmation') is-invalid @enderror "
                                                    type="password" name="password_confirmation" required>
                                                @error('password_confirmation')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mb-1">Image</label>
                                        <input class="form-control @error('image') is-invalid @enderror "
                                               name="image" type="file" required>
                                        @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-lg btn-primary btn-block mt-2">Create</button>
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
