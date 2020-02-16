<!doctype html>
<html>

<head>
    <title>Socket.IO chat</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font: 13px Helvetica, Arial;
        }

        form {
            background: #000;
            padding: 3px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        form input {
            border: 0;
            padding: 10px;
            width: 90%;
            margin-right: .5%;
        }

        form button {
            width: 9%;
            background: rgb(130, 224, 255);
            border: none;
            padding: 10px;
        }

        #messages {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        #messages li {
            padding: 5px 10px;
        }

        #messages li:nth-child(odd) {
            background: #eee;
        }

        #messages {
            margin-bottom: 40px
        }
    </style>
</head>

<body>

    <!-- Login Form -->
    <!-- <form action="{{route('store')}}" method="post">
        @csrf
        <input type="text" id="login" name="login" placeholder="Enter Your Nickname" required>
        <button type="submit" class="btn btn-primary">Set Nickname</button>
    </form> -->
    <div class="container">
        <select class="browser-default custom-select">
            <option selected>Rafiq</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
        </select>
        <ul id="messages"></ul>
        <input id="m" name="msg" autocomplete="off" /><button onclick="sendMessage();">Send</button>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.socket.io/socket.io-1.4.5.js"></script>

    <script>
        var socket = io('http://localhost:3000');
        console.log('login page');
        socket.on('msg', function(data) {
            console.log('data---- ' + data);

            $('#messages').append($('<li>').text(data));

        });
    </script>

    <script>
        function sendMessage() {
            //alert($('#m').val());

            /* Get from elements values */
            var values = $('#m').val();

            $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                url: "{{route('store')}}",
                type: "post",
                data: {data:values},
                success: function(response) {

                    // You will get response from your PHP page (what you echo or print)

                    console.log(response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }
    </script>
</body>

</html>