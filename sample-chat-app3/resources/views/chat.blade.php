<!doctype html>
<html>

<head>
    <title>Socket.IO chat</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <div class="container">
        <select id="mySelect" class="browser-default custom-select">
            <option selected>Select User</option>
        </select>
        <ul id="messages"></ul>
        <input id="m" name="msg" autocomplete="off" /><button onclick="sendMessage();">Send</button>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.socket.io/socket.io-1.4.5.js"></script>

    <script>
        var socket = io('http://localhost:3000');

        socket.on('msg', function(data) {
            console.log('data---- ' + data);
            $('#messages').append($('<li>').text(data));
        });

        socket.on('onlineUsers', function(data) {
            console.log(data);

            $('#mySelect').children().remove().end().append($('<option>',{
                value: 'Selected',
                text: 'Select User'
            }));

            for (var i = 0; i < data.length; i++) {
                $('#mySelect').append($('<option>', {
                    value: data[i].socketId,
                    text: data[i].userName
                }));
            }
        });

    </script>

    <script>
        function sendMessage() {
            //alert($('#m').val());
            /* Get from elements values */
            var values = $('#m').val();
            $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                url: "{{route('save')}}",
                type: "post",
                data: {data:values, socketId: $('#mySelect').val()},
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