Ganapatih - Realtime
====================

Untuk kebutuhan realtime data web. 

Mode 'development' : Masih menggunakan data dummy, jika service dijalankan akan menggenerate data dummy dengan interval waktu tertentu.

Mode 'production' : Menjadi server notifikasi sekaligus, gearman worker. Menerima data dari gearman client, kemudian mengirimnya ke web client. Gearman jobs : 'newMarker'

install
-------

masuk ke folder /realtime

    npm install
	
kemudian jalankan

    node index.js

sample penggunaan di web client
-------------------------------

```html
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
```
	
format data. Note : **bakal diupdate, stay tuned**
--------------------------------------------------

1. format data update marker

```json
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

1. Memastikan format data yg akan digunakan.
2. Testing keseluruhan
