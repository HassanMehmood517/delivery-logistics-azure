@extends('layouts.master')
@include('partials.css_for_notification_border')
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="d-flex justify-content-between">
                    <h3>Delivery Requests</h3>
                    {{--Filter Status--}}
                    <div class="row form-group">
                        <div class="col col-md-12">
                            <div class="input-group-btn">
                                <div class="btn-group">
                                    <form action="{{route('admin.get.delivery.request.list')}}" method="get"
                                          id="filterStatusForm">
                                        <select class="form-control form-select-sm filterDropdown" name="filterBy">
                                            <option value="">All</option>
                                            <option
                                                value="notAssigned" {{request()->filterBy == 'notAssigned' ? 'selected' : '' }}>
                                                Not Assigned
                                            </option>
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
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Assigned Boy</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($deliveryRequests as $delivery)
                                    <tr @if(\Illuminate\Support\Facades\Session::get('delivery_request_id') == $delivery->id)
                                            class="gradient-border"
                                        @endif>
                                        <td>{{$delivery->store->name}}</td>
                                        <td>{{$delivery->store->email}}</td>
                                        <td>{{$delivery->store->phone}}</td>
                                        <td>{{$delivery->store->address}}</td>
                                        @if($delivery->delivery_boy_id != null)
                                            <td>{{$delivery->deliveryBoy->name}}</td>
                                        @else
                                            <td class="text-danger">Not Assigned Yet</td>
                                        @endif
                                        <td>
                                            <button type="button"
                                                    class="btn btn-sm btn-primary {{$delivery->status == 0 ? 'assignDeliveryBoy' : ''}}"
                                                    data-id="{{$delivery->status == 0 ? $delivery->id : ''}}"
                                                    data-toggle="{{$delivery->status == 0 ? 'modal' : ''}}"
                                                    data-target="{{$delivery->status == 0 ? '#exampleModal' : ''}}"
                                                {{$delivery->status != 0 ? 'disabled' : ''}}>
                                                {{$delivery->status == 0 ? 'Assign' : ($delivery->status == 1 ? 'Pending' : ($delivery->status == 2 ? 'On the way' : 'Delivered'))}}
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <td colspan="7" class="text-center">
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
        {{--Modal--}}
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delivery Boy List</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('admin.assign.delivery.boy')}}" method="post">
                        @csrf
                        <input type="hidden" name="deliveryRequestId" value="">
                        <div class="modal-body">
                            <div class="row form-group">
                                <div class="col-12 col-md-9">
                                    <select name="deliveryBoyId" class="form-control" required>
                                        <option value="">Please Select Delivery Boy</option>
                                        @foreach($deliveryBoys as $deliveryBoy)
                                            <option value="{{$deliveryBoy->id}}">{{$deliveryBoy->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Assign</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            //assign DeliveryBoy
            $(document).on('click', '.assignDeliveryBoy', function () {
                let deliveryRequestId = $(this).data('id');
                $('input[name="deliveryRequestId"]').val(deliveryRequestId);
            });

            //Filter By
            $(document).on('change', '.filterDropdown', function () {
                $('#filterStatusForm').submit();
            });
        });
    </script>
@endsection
