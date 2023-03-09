<!-- Jquery JS-->
<script src="{{asset('vendor/jquery-3.2.1.min.js')}}"></script>
<!-- Bootstrap JS-->
<script src="{{asset('vendor/bootstrap-4.1/popper.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap-4.1/bootstrap.min.js')}}"></script>
<script src="{{asset('vendor/animsition/animsition.min.js')}}"></script>

<!-- Main JS-->
<script src="{{asset('js/main.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    @if(\Illuminate\Support\Facades\Session::has('success'))
    toastr.success("{{\Illuminate\Support\Facades\Session::get('success')}}", 'Success', {timeOut: 3000});
    @endif

    @if(\Illuminate\Support\Facades\Session::has('error'))
    toastr.error('{{\Illuminate\Support\Facades\Session::get('error')}}', 'Error', {timeOut: 3000});
    @endif
</script>

