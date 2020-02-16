var app = require("express")();
var http = require("http").Server(app);
var io = require("socket.io")(http);
var port = process.env.PORT || 3000;

//var dbConnection = require('./db_connect/db-connection');
//console.log(dbConnection);

var mysql = require("mysql");

const uuidv4 = require("uuid/v4");

const redis = require("redis");
const client = redis.createClient();

//publisher.publish('channel', "This is message");

client.on("error", function(error) {
  console.error(error);
});

client.set("key", "value", redis.print);
client.get("key", redis.print);

var onlineUsers = [];

// var con = mysql.createConnection({
//     host: "localhost",
//     user: "rafiq",
//     password: "12345678",
//     database: "dbchat2"
// });

// con.connect(function (err) {
//     if (err) throw err;
//     console.log("Database Connected!");
// });

// app.get('/chat', function (req, res) {
//     res.sendFile(__dirname + '/user.html');
// });

app.get("/", function(req, res) {
  res.sendFile(__dirname + "/index.html");
});

// io.on('connection', function (socket) {

//     socket.on('chat message', function (msg) {
//         io.emit('chat message', msg);

//         // Insert message into databases
//         // var sql = "INSERT INTO users (name, email, email_verified_at, password, remember_token) VALUES ('" + msg + "', 'Highway', null, '12345', '123')";
//         // con.query(sql, function (err, result) {
//         //     if (err) throw err;
//         //     console.log("1 record inserted");
//         // });
//     });
// });

// const createUser = ({ userName = "" } = {}) => (
//     {
//         userId: uuidv4(),
//         userName
//     }
// );

const createMessage = ({ msgBody = "" }) => ({
  msgId: uuidv4(),
  msgBody
});

io.on("connection", function(socket) {
  //console.log("Socket Id:" + socket.id);
  // console.log("io connected");

  client.on("message", function(channel, message) {
    //console.log("channel: " + channel);
    console.log("message: " + message);

    socket.emit('msg', message);
    
  });

  client.subscribe("test-channel");
  client.subscribe("channel");
  client.subscribe("my-channel");

  // TODO: Get the user list from database. And check user existance
  // var user = createUser({ userName: 'Rafiq' });
  // console.log('New User Created');

  // var userString = JSON.stringify(user);
  // var userObjectValue = JSON.parse(userString);
  // console.log(userObjectValue);

  // socket.on('user name', function (user, callback) {
  //     var temp = 0;
  //     onlineUsers.push({
  //         profileName: user.userName,
  //         profileId: socket.id,
  //         profileImage: user.imageUrl,
  //         counter: temp
  //     })

  //     // console.log(userName);
  //     console.log(onlineUsers);

  //     io.sockets.emit('connectedUsers', onlineUsers);

  // });

  // var uName = 'Ashraf';
  // var sql = 'SELECT * FROM users WHERE name = ?';

  // con.query(sql, [uName], function (err, result) {
  //     if (err) throw err;
  //     if (result == '') {
  //         console.log('user does not exists');
  //     } else {
  //         var resultString = JSON.stringify(result);
  //         var resultObjectValue = JSON.parse(resultString);
  //         // console.log(resultObjectValue);
  //     }
  // });

  // Send Message All to All
  // socket.on('chat message', function (msg) {

  //     var msgCreate = createMessage({ msgBody: msg.text });

  //     var msgString = JSON.stringify(msgCreate);
  //     var msgObjectValue = JSON.parse(msgString);
  //     console.log(msgObjectValue);

  //     // Send message to all user
  //     io.emit('chat message', chatMessageToAll(msg.text));
  // });

  // const chatMessageToAll = (text) => {
  //     return {
  //         from: uName,
  //         text,
  //         time: new Date()
  //     };
  // };
});

//io.on('connection', socket => {
//console.log('New user connected -- msg from server');
/* socket.emit does Welcome message to new chatter */
//socket.emit('newMessage', chatMessage('Chatbot', 'Welcome'));
/* socket.braodcast.emit from Admin to new user joined. */
// socket.broadcast.emit(
//     'newMessage',
//     generatedMessage('Chatbot', 'New User joined')
// );
/* socket.on listens "sendMessage" from client and io.emit sends the message out to clients */
//     socket.on('sendMessage', (message) => {
//         console.log('Send message -- server side', message);
//         io.emit('receiveMessage', chatMessage(message.from, message.text));
//     });

//     const chatMessage = (from, text) => {
//         return {
//             from,
//             text,
//             time: new Date().getTime()
//         };
//     };

// });

http.listen(port, function() {
  console.log("listening on *:" + port);
});
