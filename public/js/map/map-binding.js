 $(document).ready(function(){
	 	 
	MyMap.initialize();
	
	MyMap.loadMarker();
	
	//var mapUpdate = io.connect('http://localhost:8080/mapUpdate');
    var ioUrl = socketUrl + 'mapUpdate';
    
	var mapUpdate = io.connect(ioUrl);
   
	mapUpdate.on('connect', function () {
	 
		mapUpdate.on('newMarkerMap', function(data) {
            
			// data untuk marker baru di map ada disini
            
            /*
             * fix bug double data
             */
            if (data.location.length == 2) {               
               MyMap.putMarker(data);
            }
			
		});
		
	});
	  
 
	/*=====================*/
	/*   DOM Binding below */
	/*=====================*/
	
	/* $("#right-label").change(function(){}); */
	
	
 });
	

	 
 