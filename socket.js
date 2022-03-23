var http = require('http').Server();
const cors = require('cors')
var io = require('socket.io')(http, {
	cors: {
		origin: "http://localhost:8080",
	},
});
var Redis = require('ioredis');

var redis = new Redis();
redis.psubscribe('*', function (err, count) { });


io.on('connection', (socket) => {

	console.log('made socket connection', socket.id);

	socket.on('room', function (room) {
		socket.join(room);
		console.log(room)
	});


	redis.on('pmessage', function (channel, message) {
		message = JSON.parse(message);
		io.sockets.in(`room-${message.room_id}`).emit("message" + ':' + message);


		console.log(`room-${message.room_id}`)

	});

	socket.on('message', function (data) {
		console.log(data)

	});


	socket.on('typing', function (data) {
		console.log(data)
		socket.broadcast.emit('typing', data);
	});
});


http.listen(3000, function () {
	console.log('Listening on Port: 3000');
});
