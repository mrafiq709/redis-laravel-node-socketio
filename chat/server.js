var app = require("express")();
var http = require("http").Server(app);
var io = require("socket.io")(http);
var port = process.env.PORT || 3000;

const redis = require("redis");
const client = redis.createClient();

client.on("error", function (error) {
    console.error(error);
});

client.set("key", "value", redis.print);
client.get("key", redis.print);

var onlineUsers = [];

io.on("connection", function (socket) {
    console.log("Socket Id:" + socket.id);
    console.log("io connected");

    let randomName = Math.random().toString(36).substring(7);
    //console.log("randomName: ", randomName);

    onlineUsers.push({
        socketId: socket.id,
        userName: randomName
    });

    console.log(onlineUsers);

    io.emit('onlineUsers', onlineUsers);

    client.on("message", function (channel, message) {
        //console.log("channel: " + channel);
        console.log("message: " + message);

        socket.emit('msg', message);

    });

    client.subscribe("test-channel");

    socket.on('disconnect', function () {
        console.log("disconnect")
        for (var i = 0; i < onlineUsers.length; i++) {
            if (onlineUsers[i].socketId === socket.id) {
                console.log(onlineUsers[i].userName + " just disconnected");
                onlineUsers.splice(i, 1);
            }
        }
        io.emit('onlineUsers', onlineUsers);
    });

});

http.listen(port, function () {
    console.log("listening on *:" + port);
});