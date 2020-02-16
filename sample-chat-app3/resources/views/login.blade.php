<!DOCTYPE html>
<html>

<head>
    <title>My First HTML</title>
    <meta charset="UTF-8">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

</head>

<body>

    <!-- Login Form -->
    <form action="{{route('store')}}" method="post">
        @csrf
        <input type="text" id="login" name="login" placeholder="Enter Your Nickname" required>
        <button type="submit" class="btn btn-primary">Set Nickname</button>
    </form>

    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.socket.io/socket.io-1.4.5.js"></script>

    <script>
        var socket = io('http://localhost:3000');
        console.log('login page');
        socket.on('channel', function(data) {
            console.log('data---- ' + data);
        });
    </script>

</body>

</html>