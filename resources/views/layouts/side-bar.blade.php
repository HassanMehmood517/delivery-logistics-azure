@if(auth()->user()->isAdmin())
    <aside class="menu-sidebar d-none d-lg-block">
        <div class="logo">
            <a href="{{route('admin.dashboard')}}">
                <img src="{{asset('images/icon/delivery-logistics.png')}}" alt="Super Kiwi"/>
            </a>
        </div>
        <div class="menu-sidebar__content js-scrollbar1">
            <nav class="navbar-sidebar">
                <ul class="list-unstyled navbar__list">
                    <li class="{{request()->routeIs('admin.dashboard') ? 'active' : ''}} has-sub">
                        <a href="{{route('admin.dashboard')}}"><i class="fas fa-home"></i>Dashboard</a>
                    </li>
                    <li class="{{request()->routeIs('admin.create.delivery.boy') || request()->routeIs('admin.delivery.boy.list')  ? 'active' : ''}} has-sub">
                        <a class="js-arrow" href="#"><i class="fas fa-user"></i>Delivery Boy</a>
                        <ul class="list-unstyled navbar__sub-list js-sub-list"
                            style="display: {{request()->routeIs('admin.create.delivery.boy') || request()->routeIs('admin.delivery.boy.list')  ? 'block' : 'none'}}">
                            <li class="{{request()->routeIs('admin.create.delivery.boy') ? 'active' : ''}}">
                                <a href="{{route('admin.create.delivery.boy')}}">Create</a>
                            </li>
                            <li class="{{request()->routeIs('admin.delivery.boy.list')  ? 'active' : ''}}">
                                <a href="{{route('admin.delivery.boy.list')}}">View</a>
                            </li>
                        </ul>
                    </li>
                    <li class="{{request()->routeIs('admin.store.list')  ? 'active' : ''}} has-sub">
                        <a class="js-arrow" href="#"><i class="fas fa-shopping-cart"></i>Store</a>
                        <ul class="list-unstyled navbar__sub-list js-sub-list"
                            style="display: {{request()->routeIs('admin.store.list')  ? 'block' : 'none'}}">
                            <li class="{{request()->routeIs('admin.store.list') ? 'active' : ''}}">
                                <a href="{{route('admin.store.list')}}">View</a>
                            </li>
                        </ul>
                    </li>
                    <li class="{{request()->routeIs('admin.get.delivery.request.list')  ? 'active' : ''}} has-sub">
                        <a class="js-arrow" href="#">
                            <i class="fas fa-arrow-alt-circle-right"></i>Delivery Requests</a>
                        <ul class="list-unstyled navbar__sub-list js-sub-list"
                            style="display: {{request()->routeIs('admin.get.delivery.request.list')  ? 'block' : 'none'}}">
                            <li class="{{request()->routeIs('admin.get.delivery.request.list') ? 'active' : ''}}">
                                <a href="{{route('admin.get.delivery.request.list')}}">View</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>
@endif

@if(auth()->user()->isStore())
    <aside class="menu-sidebar d-none d-lg-block">
        <div class="logo">
            <a href="{{route('store.dashboard')}}">
                <img src="{{asset('images/icon/delivery-logistics.png')}}" alt="Super Kiwi"/>
            </a>
        </div>
        <div class="menu-sidebar__content js-scrollbar1">
            <nav class="navbar-sidebar">
                <ul class="list-unstyled navbar__list">
                    <li class="{{request()->routeIs('store.dashboard') ? 'active' : ''}} has-sub">
                        <a href="{{route('store.dashboard')}}"><i class="fas fa-home"></i>Dashboard</a>
                    </li>
                    <li class="{{request()->routeIs('store.get.delivery.request.list')  ? 'active' : ''}} has-sub">
                        <a class="js-arrow" href="#">
                            <i class="fas fa-arrow-alt-circle-right"></i>Delivery Requests</a>
                        <ul class="list-unstyled navbar__sub-list js-sub-list"
                            style="display: {{request()->routeIs('store.get.delivery.request.list')  ? 'block' : 'none'}}">
                            <li class="{{request()->routeIs('store.get.delivery.request.list') ? 'active' : ''}}">
                                <a href="{{route('store.get.delivery.request.list')}}">View</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>
@endif

@if(auth()->user()->isDeliveryBoy())
    <aside class="menu-sidebar d-none d-lg-block">
        <div class="logo">
            <a href="{{route('deliveryBoy.dashboard')}}">
                <img src="{{asset('images/icon/delivery-logistics.png')}}" alt="Super Kiwi"/>
            </a>
        </div>
        <div class="menu-sidebar__content js-scrollbar1">
            <nav class="navbar-sidebar">
                <ul class="list-unstyled navbar__list">
                    <li class="{{request()->routeIs('deliveryBoy.dashboard') ? 'active' : ''}} has-sub">
                        <a href="{{route('deliveryBoy.dashboard')}}"><i class="fas fa-home"></i>Dashboard</a>
                    </li>
                    <li class="{{request()->routeIs('delivery.boy.get.delivery.request.list')  ? 'active' : ''}} has-sub">
                        <a class="js-arrow" href="#">
                            <i class="fas fa-arrow-alt-circle-right"></i>Delivery Requests</a>
                        <ul class="list-unstyled navbar__sub-list js-sub-list"
                            style="display: {{request()->routeIs('delivery.boy.get.delivery.request.list')  ? 'block' : 'none'}}">
                            <li class="{{request()->routeIs('delivery.boy.get.delivery.request.list') ? 'active' : ''}}">
                                <a href="{{route('delivery.boy.get.delivery.request.list')}}">View</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>
@endif
