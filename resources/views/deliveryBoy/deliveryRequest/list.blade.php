@extends('layouts.master')
@include('partials.css_for_notification_border')
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="d-flex justify-content-between">
                    <h3>Store Detail</h3>
                    {{--Filter Status--}}
                    <div class="row form-group">
                        <div class="col col-md-12">
                            <div class="input-group-btn">
                                <div class="btn-group">
                                    <form action="{{route('delivery.boy.get.delivery.request.list')}}" method="get"
                                          id="filterStatusForm">
                                        <select class="form-control form-select-sm filterDropdown" name="filterBy">
                                            <option value="">All</option>
                                            <option
                                                value="pending" {{request()->filterBy == 'pending' ? 'selected' : '' }}>
                                                Pending
                                            </option>
                                            <option
                                                value="onTheWay" {{request()->filterBy == 'onTheWay' ? 'selected' : '' }}>
                                                On the Way
                                            </option>
                                            <option
                                                value="delivered" {{request()->filterBy == 'delivered' ? 'selected' : '' }}>
                                                Delivered
                                            </option>
                                        </select>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{--Table Content--}}
                <div class="row m-t-0">
                    <div class="col-md-12">
                        <div class="table-responsive m-b-40">
                            <table class="table table-borderless table-data3">
                                <thead>
                                <tr>
                                    <th>Store Name</th>
                                    <th>Phone</th>
                                    <th>Delivery Address</th>
                                    <th>Time</th>
{{--                                    <th>Price</th>--}}
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($deliveryRequests as $delivery)
                                    <tr @if(\Illuminate\Support\Facades\Session::get('delivery_request_id') == $delivery->id)
                                            class="gradient-border"
                                        @endif>
                                        <td>{{$delivery->store->name}}</td>
                                        <td>{{$delivery->store->phone}}</td>
                                        <td>{{$delivery->delivery_address}}</td>
                                        <td>{{ \Carbon\Carbon::parse($delivery->time)->format('d/m/Y ' . ' h:m:s') }}</td>
{{--                                        <td>{{$delivery->price}}</td>--}}
                                        <td>
                                            @if($delivery->status == 1)
                                                <form
                                                    action="{{route('delivery.request.change.status', $delivery->id)}}"
                                                    method="post" id="deliveryStatus{{$delivery->id}}">
                                                    @csrf
                                                    <select name="order_status" class="changeStatus form-control"
                                                            data-id="{{$delivery->id}}">
                                                        <option value="1" selected disabled>
                                                            Pending
                                                        </option>
                                                        <option value="2">
                                                            On the way
                                                        </option>
                                                    </select>
                                                </form>
                                            @elseif($delivery->status == 2)
                                                <form
                                                    action="{{route('delivery.request.change.status', $delivery->id)}}"
                                                    method="post" id="deliveryStatus{{$delivery->id}}">
                                                    @csrf
                                                    <select name="order_status" class="changeStatus form-control"
                                                            data-id="{{$delivery->id}}">
                                                        <option value="2" selected disabled>
                                                            On the way
                                                        </option>
                                                        <option value="3">
                                                            Delivered
                                                        </option>
                                                    </select>
                                                </form>
                                            @elseif($delivery->status == 3)
                                                <button class="btn btn-sm btn-primary" disabled>Delivered</button>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <td colspan="6" class="text-center">
                                        No Data found
                                    </td>
                                @endforelse
                                </tbody>
                            </table>
                            {{$deliveryRequests->links()}}
                        </div>
                    </div>
                </div>
                {{\Illuminate\Support\Facades\Session::forget('delivery_request_id')}}
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            //Change status
            $(document).on('change', '.changeStatus', function () {
                let id = $(this).data('id');
                $('#deliveryStatus' + id).submit();
            });

            //Filter By
            $(document).on('change', '.filterDropdown', function () {
                $('#filterStatusForm').submit();
            });
        });
    </script>
@endsection
