@extends('layouts.master')
@include('partials.css_for_notification_border')
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="d-flex justify-content-between">
                    <h3>Delivery Details</h3>
                    {{--Filter Status--}}
                    <div class="row form-group">
                        <div class="col col-md-12">
                            <div class="input-group-btn">
                                <div class="btn-group">
                                    <form action="{{route('store.get.delivery.request.list')}}" method="get"
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
                                    <th>Delivery Boy</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($deliveryRequests as $delivery)
                                    <tr @if(\Illuminate\Support\Facades\Session::get('delivery_request_id') == $delivery->id)
                                            class="gradient-border"
                                        @endif>
                                        <td>{{$delivery->deliveryBoy->name}}</td>
                                        <td>{{$delivery->deliveryBoy->email}}</td>
                                        <td>{{$delivery->deliveryBoy->phone}}</td>
                                        <td>
                                            <button type="button"
                                                    class="btn btn-sm btn-primary {{$delivery->status == 0 ? 'assignDeliveryBoy' : ''}}"
                                                {{$delivery->status != 0 ? 'disabled' : ''}}>
                                                {{$delivery->status == 0 ? 'Assign' : ($delivery->status == 1 ? 'Pending' : ($delivery->status == 2 ? 'On the way' : 'Delivered'))}}
                                            </button>
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
            //Filter By
            $(document).on('change', '.filterDropdown', function () {
                $('#filterStatusForm').submit();
            });
        });
    </script>
@endsection
