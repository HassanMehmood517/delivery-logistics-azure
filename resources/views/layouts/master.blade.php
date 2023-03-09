<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.css')
    @yield('css')
</head>
<body>
<div class="page-wrapper">
    @include('layouts.side-bar')
    @include('layouts.nav-bar')
    <div class="page-container">
        @yield('content')
    </div>
</div>
@include('layouts.js')
<script src="https://js.pusher.com/4.1/pusher.min.js"></script>
<script>
    let count;
    let new_count;

    var pusher = new Pusher('f798977e8faa51863ee5', {
        cluster: 'us2',
        encrypted: true
    });
    pusher.logtoconsole = true;

    var channel = pusher.subscribe('super-kiwi-logistics-channel.' + '{{auth()->user()->id}}');
    channel.bind('pusher:subscription_succeeded', function () {
        console.log('Pusher Connected');
    });
    channel.bind('pusher:subscription_error', function () {
        console.log('Pusher Not Connected');
    });

    var currentState = pusher.connection.state;

    //Admin Notification
    channel.bind('AdminNotificationOfOrderStatus', function (data) {
        console.log(data);
        let url = '{{route('admin.read.notification', 'id')}}';
        adminPusherChannel(url, data.data.request_id, data.data.message, data.data.name);
    });

    function adminPusherChannel(url, id, message, name) {
        count_badge();
        url = url.replace('id', id);
        let notificationList = '<a href="' + url + '">' +
            '<div class="notifi__item">' +
            '<div class="bg-c1 img-cir img-40">' +
            '<i class="zmdi zmdi-email-open"></i>' +
            '</div>' +
            '<div class="content">' +
            '<h6>You got a message from ' + name + '</h6>' +
            '<p>' + message + '</p>' +
            '<span class="date">{{\Carbon\Carbon::now()->diffForHumans()}}</span>' +
            '</div>' +
            '</div>' +
            '</a>';
        $('#notificationsList').prepend(notificationList);
        $('.quantity').text(new_count);
        $('.notificationMessage').hide();
    }

    function count_badge() {
        count = $('.quantity').text();
        new_count = 1;
        if (count != '') {
            new_count = parseInt(count) + 1;
        }
    }

    //DeliveryBoy Notification
    channel.bind('DeliveryBoyNotificationOfDeliveryRequest', function (data) {
        console.log(data);
        let url = '{{route('delivery.boy.read.notification','id')}}';
        pusherChannel(url, data.data.request_id, data.data.message);
    });

    //Store Notification
    channel.bind('StoreNotificationForDeliveryRequest', function (data) {
        console.log(data);
        let url = '{{route('store.read.notification','id')}}';
        pusherChannel(url, data.data.request_id, data.data.message);
    });

    function pusherChannel(url, id, message) {
        count_badge();
        url = url.replace('id', id);
        let notificationList = '<a href="' + url + '">' +
            '<div class="notifi__item">' +
            '<div class="bg-c1 img-cir img-40">' +
            '<i class="zmdi zmdi-email-open"></i>' +
            '</div>' +
            '<div class="content">' +
            '<p>' + message + '</p>' +
            '<span class="date">{{\Carbon\Carbon::now()->diffForHumans()}}</span>' +
            '</div>' +
            '</div>' +
            '</a>';
        $('#notificationsList').prepend(notificationList);
        $('.quantity').text(new_count);
        $('.notificationMessage').hide();
    }
</script>
@yield('scripts')
</body>
</html>
