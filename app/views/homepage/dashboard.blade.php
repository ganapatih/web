@extends('layouts/master')
@section('header')
	@parent
	<!--- ini tidak di load oom kenapa yah , saya pindah lagi di master -->
	<link rel="stylesheet" href="{{ asset('css/map.css') }}">
@stop

@section('content')
	<div class="row">
		<div class="small-12 medium-4 columns">
			<div class="widget">
				<h2>Latest SMS</h2>
				<ul>
					<li>
						<strong>081278594977</strong>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis, in!</p>
					</li>
					<li>
						<strong>081278594977</strong>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia, recusandae!</p>
					</li>
					<li>
						<strong>081278594977</strong>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, magnam.</p>
					</li>
				</ul>
			</div>
			<div class="widget">
				<h2>Daerah Bencana</h2>
				<ul>
					<li>
						<strong>Castle Frankenstain</strong>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis, in!</p>
					</li>
					<li>
						<strong>Lordaeron</strong>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia, recusandae!</p>
					</li>
					<li>
						<strong>Atlantis</strong>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, magnam.</p>
					</li>
				</ul>
			</div>
		</div>
		<div class="small-12 medium-8 columns">
			<form>
			  <div class="row">
			    <div class="small-12">
			      <div class="row">
			        <div class="small-3 columns">
			          <label for="right-label" class="right inline">Search By:</label>
			        </div>
			        <div class="small-7 columns">
			          <select name="location" id="right-label">
			          	<option value="location">Location</option>
			          </select>
			        </div>
		            <div class="small-2 columns"><button type="submit" class="tiny radius button"><i class="fa fa-search"></i>  Cari</div>
			      </div>
			    </div>
			  </div>
			</form>
			<div id="the-Map"></div>
			<!-- <iframe width="100%" height="700" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Yogyakarta,+Special+District+of+Yogyakarta,+Indonesia&amp;aq=0&amp;oq=yogyakarta&amp;sll=37.0625,-95.677068&amp;sspn=49.490703,107.138672&amp;ie=UTF8&amp;hq=&amp;hnear=Yogyakarta,+Indonesia&amp;t=m&amp;ll=-7.797228,110.368824&amp;spn=0.119052,0.016994&amp;z=13&amp;iwloc=A&amp;output=embed"></iframe><br /><small><a href="https://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=Yogyakarta,+Special+District+of+Yogyakarta,+Indonesia&amp;aq=0&amp;oq=yogyakarta&amp;sll=37.0625,-95.677068&amp;sspn=49.490703,107.138672&amp;ie=UTF8&amp;hq=&amp;hnear=Yogyakarta,+Indonesia&amp;t=m&amp;ll=-7.797228,110.368824&amp;spn=0.119052,0.016994&amp;z=13&amp;iwloc=A" style="color:#0000FF;text-align:left">View Larger Map</a></small> -->
		</div>
	</div>
	
@stop
@section('footer')
	<script>
		//load from DB perseintent
		// var POI = <?php echo isset($data)?json_encode($data):"{}"; ?>
		
		/*om POI ini cuma sample kedepan tidak akan seperti ini, jadi JS jangan ditulis disini biar lepas saja
		bisa jadi akan bangat js file diluar nanti untuk memudahkan managemen file nya,
		saya balikin lagi ya
		*/
		var POI = {
			 
		 812373 :  {
						"datetime"    : "2014-02-19 15:40:14",
						"desc"        : "testing",
						"location"    : [-7.795384,110.348654],
						"name"        : "hiraq C",
						"phone"       : "812373",
						"status"      : null,
						"type_victim" : 1 
					} 

		};

		</script>

	<script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
	<script src="{{ asset('js/map/map.js') }}"></script>
	<script src="{{ asset('js/map/map-binding.js') }}"></script>	 
	
	 <script src="http://localhost:8080/socket.io/socket.io.js"></script> 
       
@stop