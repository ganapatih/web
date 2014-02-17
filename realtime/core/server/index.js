function setup(app, config) {
	var io = require('socket.io').listen(app);
	app.listen(config.port);
	
	if (process.env.NODE_ENV === 'production') {

		console.log('jugijagijugijagijug~');

		process.on('SIGINT', function () {
			console.log('realtime server is down, nuoooooooooo...');
			process.exit(0);
		});

	} else if (process.env.NODE_ENV === 'development') {
		console.log('jugijagijugijagijug~');

		process.on('SIGINT', function () {
			console.log('realtime server is down, nuoooooooooo...');
			process.exit(0);
		});

		var dummy = require('../data/blackbox');

		app.on('request', function(req, res) {
			res.writeHead(200);
			res.end();
		});

		var intvList = [2000, 4000, 6000, 10000, 12000, 20000, 23000, 25000, 30000];

		function sendMapData() {
			mapUpdate.emit('newMarker', dummy.getRandomData('alertmap'));
			setTimeout(sendMapData, intvList[Math.round(Math.random() * (intvList.length - 1))]);
		}

		var mapUpdate = io
			.of('/mapUpdate')
			.on('connection', function (socket) {

				sendMapData();

			});
		
	}
}

function init(app, config) {
	if (!app) {
		var app = require('http').createServer();
	}

	setup(app, config);
}

module.exports = init;