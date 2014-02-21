 $(document).ready(function(){
	 	 
	MyMap.initialize();
	
	MyMap.loadMarker();
	
	//var mapUpdate = io.connect('http://localhost:8080/mapUpdate');
	
	var mapUpdate = io.connect('http://ganapatih.tulisanhiraq.net:8080/mapUpdate');

	mapUpdate.on('connect', function () {
	 
		mapUpdate.on('newMarker', function(data) {

			// data untuk marker baru di map ada disini
			MyMap.putMarker(data);
		});
		
	});
	  
 
	/*=====================*/
	/*   DOM Binding below */
	/*=====================*/
	
	/* $("#right-label").change(function(){}); */
	
	
 });
	

	 
 