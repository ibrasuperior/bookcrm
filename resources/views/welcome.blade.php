<!DOCTYPE html>

<head>
    <title>Pusher Test</title>
    <script src="https://js.pusher.com/6.0/pusher.min.js"></script>

</head>

<body>
    <h1>Pusher Test</h1>
    <p>
        Try publishing an event to channel <code>my-channel</code>
        with event name <code>my-event</code>.
    </p>


    <script>
    var user = "<?php echo $user; ?>"

    console.log(user)

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('f79d2982653448dfc962', {
        cluster: 'us2'
    });

    var channel = pusher.subscribe('lead-push');
    channel.bind('lead-push', function(data) {
        if (data.user == user) {
            new Notification('Book CRM', {
                body: 'Olá'
            });
        }

    });
    </script>
</body>