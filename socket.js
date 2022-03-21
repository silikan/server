var server = require('http').Server();
const cors = require('cors')

var Redis = require('ioredis');
var redis = new Redis();

// Create a new Socket.io instance
const io = require("socket.io")(server, {
	cors: {
		origin: "http://localhost:8080",
	},
});
redis.psubscribe('*');

redis.on('pmessage', function (pattern, room_id, message, from, to) {
	message = JSON.parse(message);

	// Pass data to Socket.io every time we get a new message from Redis
	// "channel + ':' + message.event" is a unique channel id to broadcast to
	//
	// message.data corresponds to the $data variable in the MessageSent event
	// in Laravel
	io.emit(channel + ':' + message, from, to);
});


io.on('connection', (socket) => {

	console.log('made socket connection', socket.id);

	// Handle chat event
	socket.on('chat', function (data) {
		console.log(data)
		io.sockets.emit('chat', data);
	});

	socket.on('typing', function (data) {
		console.log(data)
		socket.broadcast.emit('typing', data);
	});
});

server.listen(3001);

// Just to be sure it's working
console.log('Server started on 3001');
