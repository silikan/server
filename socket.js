var app = require('express')();
var http = require('http').Server(app);
const cors = require('cors')

const io = require("socket.io")(http, {
	cors: {
		origin: "http://localhost:8000",
	},
}); var Redis = require('ioredis');
var redis = new Redis();
redis.subscribe('test-channel', function (err, count) {
});
redis.on('message', function (channel, message) {
	console.log('Message Emitted: ' + message.event);

	console.log('Message Recieved: ' + message);
	message = JSON.parse(message);
	io.emit(channel + ':' + message.event, message.data);
	console.log('Message Emitted: ' + message.event);
});
http.listen(3000, function () {
	console.log('Listening on Port 3000');
});


