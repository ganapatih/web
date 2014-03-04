var RegionalList = {
	indonesia  : [0,116.015625],
	jogja : [-7.804228,110.40453]
}


var MyMap={

	_map : false,
	 initialize :  function () {
        //inisiasi peta indonesia, dengan zoom level 4
		var pos = RegionalList.jogja;
        var _center  = new google.maps.LatLng(pos[0],pos[1]);
		
        var myIndonesia = {
            zoom: 12,           
            center: _center,
            panControl: false,
			zoomControl: false,
		    mapTypeControl: true,
			  
        };

		
        this._map = new google.maps.Map(document.getElementById("the-Map"), myIndonesia);
		 
    }, 
	
	 
    
  
	loadMarker : function(){
		var that  = this;
		$.each(POI, function(i, obj){
			var marker = new google.maps.Marker({
				  position: new google.maps.LatLng(obj.location[0],obj.location[1]),
				  map: that._map,
				  title: obj.name
			  });

			var infowindow = that.renderInfo(obj);
			google.maps.event.addListener(marker, 'click', function() {
				infowindow.open( that._map,marker);
			  }); 
		});
	  },
  
	putMarker : function( Object ){
		
		var that  = this;
		//console.log(that._map);
		//console.log(typeof(  POI[Object["phone"]]));
		
		if(that._map && typeof(  POI[Object["phone"]]) =='undefined')
		{
			POI[Object["phone"]] = Object;		
			
			var marker = new google.maps.Marker({
				  position: new google.maps.LatLng(Object.location[0],Object.location[1]),
				  map: that._map,
				  title: Object.name
			  });
			  			  
			  //console.log("put", Object.phone );
			  //console.log('location', Object.location);
			  
			 var infowindow = that.renderInfo(Object);
			 google.maps.event.addListener(marker, 'click', function() {
				infowindow.open( that._map,marker);
			  });  
		  }
	},
	
	
	renderInfo : function( Obj ){
	
		var InfoString1 =  	'<div class="info-window"> '+
							'<div class="info-header">  '+
							'	<h3> '+ Obj.name+' </h3> '+
							'	<h4> Contact : '+ Obj.phone+' </h4> '+
							'	<h4> Location : latitude '+ Obj.location[0] +', longitude '+ Obj.location[1]  +' </h4> '+
							'</div> '+
							
							'<div class="info-body">   '+ 
							'<p class="description">	'+ Obj.desc+' </p> '+
							'<ul class="detail"> '+
							'	<li>  Time :  '+ Obj.datetime+' </li> '+
							'	<li>  location :  latitude '+ Obj.location[0] +', longitude '+ Obj.location[1]  +'  </li> '+
							'	<li>  phone : '+ Obj.phone+'  </li> '+
							'	<li>  status : '+ Obj.status +'  </li> '+
							'	<li>  Type : '+  Obj.type_victim +'  </li>  '+
							'</ul>	 '+
							'</div> '+
							'</div> ';
	
	 var infowindow = new google.maps.InfoWindow({
		  content: InfoString1
	  });
	
		return infowindow;
	}
	
}