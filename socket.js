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
redis.on('pmessage', function (channel, message) {
	message = JSON.parse(message);
	io.sockets.in(`room-${message.room_id}`).emit('message', message);



});

io.on('connection', (socket) => {

	console.log('made socket connection', socket.id);

	socket.on('room', function (room) {
		socket.join(room);
		console.log(room)
	});







	socket.on('typing', function (data) {
		console.log(data)
		socket.broadcast.emit('typing', data);
	});
});


http.listen(3000, function () {
	console.log('Listening on Port: 3000');
});
