<header class="header-desktop">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="header-wrap">
                <div class="form-header"></div>
                <div class="header-button">
                    <div class="noti-wrap">
                        <div class="noti__item js-item-menu">
                            <i class="zmdi zmdi-notifications"></i>
                            <span class="quantity">{{count(auth()->user()->unreadNotifications)}}</span>
                            <div class="notifi-dropdown js-dropdown" style="height: 320px; overflow: auto">
                                <p id="notificationsList">

                                </p>
                                @if(auth()->user()->isAdmin())
                                    @forelse( Auth::user()->unreadNotifications as $notification)
                                        <a href="{{route('admin.read.notification',$notification->data['request_id'])}}">
                                            <div class="notifi__item">
                                                <div class="bg-c1 img-cir img-40">
                                                    <i class="zmdi zmdi-email-open"></i>
                                                </div>
                                                <div class="content">
                                                    <h6>You got a message from {{$notification->data['name']}}</h6>
                                                    <p>{{$notification->data['message']}}</p>
                                                    <span
                                                        class="date">{{$notification->created_at->diffforHumans()}}
                                                        </span>
                                                </div>
                                            </div>
                                        </a>
                                    @empty
                                        <div class="text-center mt-5 notificationMessage">No Result found</div>
                                    @endforelse
                                @elseif(auth()->user()->isDeliveryBoy())
                                    @forelse( Auth::user()->unreadNotifications as $notification)
                                        <a href="{{route('delivery.boy.read.notification',$notification->data['request_id'])}}">
                                            <div class="notifi__item">
                                                <div class="bg-c1 img-cir img-40">
                                                    <i class="zmdi zmdi-email-open"></i>
                                                </div>
                                                <div class="content">
                                                    <p>{{$notification->data['message']}}</p>
                                                    <span
                                                        class="date">{{$notification->created_at->diffforHumans()}}
                                                        </span>
                                                </div>
                                            </div>
                                        </a>
                                    @empty
                                        <div class="text-center mt-5 notificationMessage">No Result found</div>
                                    @endforelse
                                @elseif(auth()->user()->isStore())
                                    @forelse( Auth::user()->unreadNotifications as $notification)
                                        <a href="{{route('store.read.notification',$notification->data['request_id'])}}">
                                            <div class="notifi__item">
                                                <div class="bg-c1 img-cir img-40">
                                                    <i class="zmdi zmdi-email-open"></i>
                                                </div>
                                                <div class="content">
                                                    <p>{{$notification->data['message']}}</p>
                                                    <span
                                                        class="date">{{$notification->created_at->diffforHumans()}}
                                                        </span>
                                                </div>
                                            </div>
                                        </a>
                                    @empty
                                        <div class="text-center mt-5 notificationMessage">No Result found</div>
                                    @endforelse
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="account-wrap">
                        <div class="account-item clearfix js-item-menu">
                            <div class="image">
                                <img src="{{asset('images/face (1).png')}}"/>
                            </div>
                            <div class="content">
                                <a class="js-acc-btn" href="#">{{Auth()->user()->name}}</a>
                            </div>
                            <div class="account-dropdown js-dropdown">
                                <div class="info clearfix">
                                    <div class="image">
                                        <a href="#">
                                            <img src="{{asset('images/face (1).png')}}"/>
                                        </a>
                                    </div>
                                    <div class="content">
                                        <h5 class="name">
                                            <a href="#">{{Auth()->user()->name}}</a>
                                        </h5>
                                        <span class="email">{{Auth()->user()->email}}</span>
                                    </div>
                                </div>
                                <div class="account-dropdown__body">
                                    <div class="account-dropdown__item">
                                        <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="zmdi zmdi-power"></i>Logout</a>
                                        <form id="logout-form" action="{{route('logout')}}" method="POST"
                                              style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
