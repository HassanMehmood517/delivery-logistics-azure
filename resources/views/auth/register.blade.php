@include('layouts.css')
<div class="page-wrapper">
    <div class="page-content--bge5">
        <div class="container">
            <div class="login-wrap">
                <div class="login-content">
                    <div class="login-logo">
                        <a href="#">
                            <img src="{{asset('images/icon/delivery-logistics.png')}}" alt="Delivery Logistics">
                        </a>
                    </div>
                    @if(count($errors)>0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="login-form">
                        <form action="{{route('register')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-6">
                                    <input class="au-input au-input--full" type="text" name="name"
                                           placeholder="Store Name" required>
                                </div>
                                <div class="form-group col-6">
                                    <input class="au-input au-input--full" type="email" name="email"
                                           placeholder="example@example.com" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <input class="au-input au-input--full" type="tel" name="phone"
                                           placeholder="Phone no." required>
                                </div>
                                <div class="form-group col-6">
                                    <input class="au-input au-input--full" type="text" name="address"
                                           placeholder="Address" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <input class="au-input au-input--full" type="password" name="password"
                                       placeholder="Password" required>
                            </div>
                            <div class="form-group">
                                <input class="au-input au-input--full" type="password" name="password_confirmation"
                                       placeholder="Confirm Password" required>
                            </div>
                            <div class="row form-group">
                                <div class="col-12 col-md-9">
                                    <input type="file" id="file-input" name="logo" class="form-control-file" required>
                                </div>
                            </div>
                            <button class="au-btn au-btn--block au-btn--blue m-b-20" type="submit">register</button>
                        </form>
                        <div class="register-link">
                            <p>Already have account? <a href="{{route('login.view')}}">Sign In</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
