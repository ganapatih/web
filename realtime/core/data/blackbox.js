var fs = require('fs');
var dummyDataAlertMap, dummyLength;

fs.readFile(__dirname + '/dummyAlertMap.json', function (err, data) {
	if (!err) {
		dummyDataAlertMap = JSON.parse(data);
		dummyLength = dummyDataAlertMap.data.length - 1;
	}
});

var getRandomData = function (dataType) {
	
	if(dataType == 'alertmap') {
		return dummyDataAlertMap.data[Math.round(Math.random() * dummyLength)];
	} else if(dataType == 'alertnonmap') {
	
	} else if(dataType == 'sms') {
	
	} else if(dataType == 'info') {
	
	}
}

module.exports.getRandomData = getRandomData;
