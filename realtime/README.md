Ganapatih - Realtime
====================

Untuk kebutuhan realtime data web. Masih menggunakan data dummy, jika service dijalankan akan menggenerate data dummy dengan interval waktu tertentu.

install
-------

masuk ke folder /realtime

    npm install
	
kemudian jalankan

    node index.js

sample penggunaan di web client
-------------------------------

    <!DOCTYPE HTML>
    <html>
	    <head>
		    <title>Demo</title>
	    </head>
	    <body>
	
		    <script src="http://localhost:8080/socket.io/socket.io.js"></script>
		    <script>
		      var mapUpdate = io.connect('http://localhost:8080/mapUpdate');
		  
		      mapUpdate.on('connect', function () {
			    mapUpdate.on('newMarker', function(data) {
			
				    // data untuk marker baru di map ada disini
				    console.log(data);
			    });
		      });
		  
		    </script>
	    </body>
    </html>
	
format data
-----------

1. format data update marker

```
{
    "lat"            : "-7.8015544026482",
    "lng"            : "110.36512255669",
    "title"          : "Korban di Yogyakarta",
    "description"    : "Kota Yogya",
    "status_darurat" : "merah",
    "image"          : ""
}
```

todos
-----

1. Integrasi dengan web client
2. Integrasi menggunakan data dari API
