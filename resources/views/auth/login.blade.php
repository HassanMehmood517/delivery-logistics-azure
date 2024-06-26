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
                    <div class="login-form">
                        <form action="{{route('login')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Email Address</label>
                                <input class="au-input au-input--full" type="email" name="email" placeholder="Email"
                                       required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input class="au-input au-input--full" type="password" name="password"
                                       placeholder="Password" required>
                            </div>
                            <button class="au-btn au-btn--block au-btn--blue m-b-20" type="submit">sign in</button>
                        </form>
                        <div class="register-link">
                            <p>Don't you have account? <a href="{{route('register.view')}}">Sign Up Here</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.js')
