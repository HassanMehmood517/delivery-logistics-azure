@extends('layouts.master')
@section('css')
    <link href="{{asset('css/mdtimepicker.css')}}" rel="stylesheet">
@endsection
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6 col-lg-3">
                        <a data-toggle="modal" data-target="#requestModal">
                            <div class="overview-item overview-item--c1 p-4 mb-0">
                                <div class="overview__inner">
                                    <div class="overview-box clearfix">
                                        <div class="icon">
                                            <i class="zmdi zmdi-arrow-out"></i>
                                        </div>
                                        <div class="text mt-3">
                                            <span>Send Request</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        {{--Modal--}}
        <div class="modal fade" id="requestModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('send.request.notification')}}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Store Detail</h3>
                            </div>
                            <div class="form-group">
                                <label class="control-label mb-1">Name</label>
                                <input class="form-control" name="name" type="text" value="{{$store->name}}"
                                       readonly="readonly">
                            </div>
                            <div class="form-group">
                                <label class="control-label mb-1">Email</label>
                                <input class="form-control" name="email" type="email" value="{{$store->email}}"
                                       readonly="readonly">
                            </div>
                            <div class="form-group">
                                <label class="control-label mb-1">Phone number</label>
                                <input class="form-control" name="phone" type="tel" value="{{$store->phone}}"
                                       readonly="readonly">
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="control-label mb-1">Address</label>
                                        <input class="form-control @error('delivery_address') is-invalid @enderror "
                                               type="text" name="delivery_address" required>
                                        @error('delivery_address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
{{--                                <div class="col-6">--}}
{{--                                    <label class="control-label mb-1">Price</label>--}}
{{--                                    <div class="input-group">--}}
{{--                                        <input class="form-control @error('price') is-invalid @enderror " type="number"--}}
{{--                                               min="1" max="100000" step="any"--}}
{{--                                               name="price" required>--}}
{{--                                        @error('price')--}}
{{--                                        <span class="invalid-feedback" role="alert">--}}
{{--                                            <strong>{{ $message }}</strong></span>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>
                            <div class="form-group">
                                <label class="control-label mb-1">Select Time</label>
                                <input class="form-control" type="text" name="time" id="timepicker">
                            </div>
                            <div>
                                <button type="submit" class="btn btn-lg btn-info btn-block">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/mdtimepicker.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#timepicker').mdtimepicker();
        });

        $('#timepicker').mdtimepicker({

            // format of the time value (data-time attribute)
            timeFormat: 'hh:mm:ss.000',

            // format of the input value
            format: 'h:mm tt',

            // theme of the timepicker
            // 'red', 'purple', 'indigo', 'teal', 'green', 'dark'
            theme: 'blue',

            // determines if input is readonly
            readOnly: false,

            // determines if display value has zero padding for hour value less than 10 (i.e. 05:30 PM); 24-hour format has padding by default
            hourPadding: false,

            // determines if clear button is visible
            clearBtn: false

        });

        // setting the value
        $('#timepicker').mdtimepicker('setValue', '12:00 PM');

        // calling the `show` and `hide` functions
        $('#timepicker').mdtimepicker('show');
        $('#timepicker').mdtimepicker('hide');

        // destroying the timepicker
        $('#timepicker').mdtimepicker('destroy');
    </script>
@endsection
