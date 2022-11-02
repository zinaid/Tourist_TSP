<!DOCTYPE html>
<html>
 <head>
	<title>TSP</title>
	<meta content="initial-scale=1.0, user-scalable=no" name="viewport">
	<meta charset="utf-8"><!-- Latest compiled and minified CSS -->
	<link href="{{ asset('css/style.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"><!-- jQuery library -->

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js">
	</script><!-- Latest compiled JavaScript -->

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">
	</script>
	<link href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" rel="stylesheet"> 
	<link href="/css/bootstrap-tour-standalone.min.css" rel="stylesheet" type="text/css">
	<script src="/js/bootstrap-tour-standalone.min.js" type="text/javascript">
	</script>
</head>
<style>
 /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */

 #map {
 	height: 100%;
 }
 /* Optional: Makes the sample page fill the window. */

 html, body {
 	height: 100%;
 	margin: 0;
 	padding: 0;
 	font-family: Slack-Larsseit!important;
 }
 .controls {
 	border: 1px solid transparent;
 	border-radius: 2px 0 0 2px;
 	box-sizing: border-box;
 	-moz-box-sizing: border-box;
 	height: 32px;
 	outline: none;
 	box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
 }
 #pac-input {
 	width: 90%;
 	text-align: center;
 	border-radius: 50px;
 	background-color: #fff;
 	font-family: Roboto;
 	font-size: 25px;
 	font-weight: 300;
 	text-overflow: ellipsis;
 	text-align: center;
 	height: 50px;
 	margin-top: 60px!important;
 	position: relative!important;
 }
 #pac-input:focus {
 	border-color: #4d90fe;
 }
 .pac-container {
 	font-family: Roboto;
 }
 #type-selector {
 	color: #fff;
 	background-color: #4d90fe;
 	padding: 5px 11px 0px 11px;
 }
 #type-selector label {
 	font-family: Roboto;
 	font-size: 13px;
 	font-weight: 300;
 }
 .opendugme {
 	font-size: 30px;
 	position: absolute;
 	color: #41295a;
 	right: 20px;
 	top: 10px;
 	background: none;
 	border: none;
 }
 .closebtn {
 	font-size: 30px;
 	position: absolute;
 	color: white;
 	right: 10px;
 	top: 10px;
 	background: none;
 	border: none;
 }
 .opendugme_list {
 	font-size: 30px;
 	position: absolute;
 	color: #595959;
 	right: 20px;
 	top: 10px;
 	background: none;
 	border: none;
 }
 .closebtn_list {
 	font-size: 30px;
 	position: absolute;
 	color: white;
 	right: 10px;
 	top: 10px;
 	background: none;
 	border: none;
 }
 .tutorial {
 	font-size: 30px;
 	position: absolute;
 	color: white;
 	left: 20px;
 	top: 10px;
 	background: none;
 	border: none;
 }
 .top_menu {
 	position: relative;
 	z-index: 3;
 	font-size: 20px;
 }
 .top_menu_left {
 	position: absolute;
 	top: 20px;
 	left: 40px;
 	font-size: 25px;
 }
 .top_menu_right {
 	position: absolute;
 	top: 20px;
 	right: 50px;
 	font-size: 25px;
 }
 .top_menu_adder {
 	position: absolute;
 	top: 70px;
 	right: 45px;
 	border: none;
 	display: none;
 }     
</style>
<script>
 $(document).ready(function() {
 	// Instance the tour
 	$(".tutorial").click(function() {
 		var tour = new Tour({
 			steps: [{
 				element: "#tutorial_1",
 				title: "MENU",
 				content: "Here you can open menu.",
 				placement: "right"
 			}, {
 				element: "#tutorial_2",
 				title: "ADD LOCATION INPUT",
 				content: "Here you can add and remove location inputs.",
 				placement: "left"
 			}, {
 				element: "#tutorial_3",
 				title: "START TUTORIAL",
 				content: "Here you can start tutorial.",
 				placement: "right"
 			}, {
 				element: "#tutorial_4",
 				title: "OPEN LIST",
 				content: "Here you can open added list of locations.",
 				placement: "left",
 			}, {
 				element: "#tutorial_5",
 				title: "SAVE LIST",
 				content: "Here you can save added list of locations and proceed to map maker interface.",
 				placement: "top",
 				onNext: function() {
 					document.location.href = 'route';
 				}
 			}, {
 				element: "#tutorial_5",
 				title: "SAVE LIST",
 				content: "Here you can save added list of locations and proceed to map maker interface.",
 				placement: "top",
 				onNext: function() {
 					document.location.href = 'route';
 				}
 			}],
 			container: "body",
 			smartPlacement: true,
 			keyboard: true,
 			storage: false,
 			debug: false,
 			backdrop: true,
 			backdropContainer: 'body',
 			backdropPadding: 0,
 			redirect: true,
 			orphan: false,
 			duration: false,
 			delay: false,
 			reflex: true,
 			basePath: "",
 		});
 		// Initialize the tour
 		tour.init();
 		tour.start();
 	})
 });
</script>	
  <body>
	<div class="container">
		<div class="row">
			<div class="top_menu" >
				<div class="top_menu_left" id="top_menu_left" onclick="openNav()">
					<i class="fas fa-bars" id="tutorial_1" aria-hidden="true" style="color: #595959 ; "></i>
				</div>
				<div class="top_menu_adder">
					<i class="fas fa-plus adder"  id="saver" style="font-size:30px;color: #595959 ; "></i>
				</div>
				<div id = "top_menu_right" class="top_menu_right">
					<i class="fas fa-search-plus pac_input_shower" id="tutorial_2" aria-hidden="true" style="color: #595959 ; "></i>
					<i class="fas fa-search-minus pac_input_hider" style="display:none; color: #595959 ; " aria-hidden="true"></i>
				</div>
			</div>
			<div class="col-12 text-center" style="padding:0px;">
				<input style="display:none;" id="pac-input" class="controls" type="text" placeholder=" Enter a location">
				</input>	
			<div>
			<div id="map" style="height: 800px;width: 100%"></div>
		<br>
		</div>
		</div>
	</div><!--End of row-->
	</div><!--End of conatiner-->

    <script>
      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
	 
	
      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {
            lat: -33.8688, lng: 151.2195},
			zoom: 13,
			mapTypeControl: false,
			streetViewControl: false,
			fullscreenControl: false,
			 zoomControl: false,
		gestureHandling: "greedy",
			 disableDefaultUI: true,
        });
        var input = /** @type {!HTMLInputElement} */(
            document.getElementById('pac-input'));
		
        var types = document.getElementById('type-selector');
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);

        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);
		
        var infowindow = new google.maps.InfoWindow();
        var marker = new google.maps.Marker({
          map: map,
          anchorPoint: new google.maps.Point(0, -29)
        });

        autocomplete.addListener('place_changed', function() {
          infowindow.close();
          marker.setVisible(false);
          var place = autocomplete.getPlace();

          if (!place.geometry) {
            // User entered the name of a Place that was not suggested and
            // pressed the Enter key, or the Place Details request failed.
            window.alert("No details available for input: '" + place.name + "'");
            return;
          }

          // If the place has a geometry, then present it on a map.
          if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
          } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);  // Why 17? Because it looks good.
          }
          marker.setIcon(/** @type {google.maps.Icon} */({
            url: place.icon,
            size: new google.maps.Size(71, 71),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(17, 34),
            scaledSize: new google.maps.Size(35, 35)
          }));
          marker.setPosition(place.geometry.location);
          marker.setVisible(true);
		  var item_Lat =place.geometry.location.lat()
		  var item_Lng= place.geometry.location.lng()
		  var item_Location = place.formatted_address;

		  // $("#lat").val(item_Lat);
		  // $("#lng").val(item_Lng);
		  // $("#location").val(item_Location);
			
			$("ul").empty();
		    $("#saver").click(function(){
				
				$("ul").append('<li class="odabrana_lista" data-location="'+ item_Location +'" data-lat ="'+ item_Lat +'" data-lng ="'+ item_Lng +'">'+ item_Location.substring(0,19) +' ... </li>');
				$("#pac-input").val("");
			 });	
			
		  
		  
          var address = '';
          if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
          }

          infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
          infowindow.open(map, marker);
        });

        // Sets a listener on a radio button to change the filter type on Places
        // Autocomplete.
        function setupClickListener(id, types) {
          var radioButton = document.getElementById(id);
          radioButton.addEventListener('click', function() {
            autocomplete.setTypes(types);
          });
        }

        setupClickListener('changetype-all', []);
        setupClickListener('changetype-address', ['address']);
        setupClickListener('changetype-establishment', ['establishment']);
        setupClickListener('changetype-geocode', ['geocode']);
      }
	   
    </script>
	<script>
	
	  $( document ).ready(function() {
		 
		  $("#confirmer").click(function(){ 
		 
			 var i = 0;
				$.ajax({
					url: '/empty_map',
					type: 'POST',
					data: {"_token": "{{ csrf_token() }}"},
					dataType: 'json',
					success: function(data) {
						// alert(data);
					},
					error: function (request, status, error) {
						alert(status);
						alert(xhr.responseText);
					}
				});
				$( "#mySidebar_list ul .odabrana_lista" ).each(function() {
					var duzina = $(this).attr("data-lat");
					var sirina = $(this).attr("data-lng");
					var lokacija = $(this).attr("data-location");
					console.log(i++);
					console.log(" ");
					console.log(duzina);
					console.log(" ");
					console.log(sirina);
					console.log(" ");
					console.log(lokacija);
					console.log(" // ");
				
					$.ajax({
						url: '/add_location',
						type: 'POST',
						data: {"_token": "{{ csrf_token() }}",'lat':duzina, 'lng': sirina, 'item_location': lokacija},
						dataType: 'json',
						success: function(data) {
							// alert(data);
						},
						error: function (request, status, error) {
							alert(status);
							alert(xhr.responseText);
						}
					});
				 
				});
			}); 
		}); 
	</script>
     <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyARDX6U-QGrtp9nfV0BAdbt6bgcDJZ_0zc&libraries=places&callback=initMap"
        async defer>
	</script>
	<div class="app-bar-bottom" style="z-index:3;">
		<!-- LISTA -->
		<div class="left_footer">
			<button style="display:none;" class="navbar-toggler closebtn_list" onclick="closeList()" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
				<i class="fa fa-times"  aria-hidden="true" style="color:#595959;font-size:30px;"></i>	
			</button>
			<button class="navbar-toggler opendugme_list" onclick="openList()" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
				<i class="fa fa-list" id="tutorial_4" aria-hidden="true"></i>
			</button>
		</div>
		<!-- TUTORIAL -->
		<div class="right_footer">
			<button class="navbar-toggler tutorial" onclick="tutorial()" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
				<i class="fa fa-info" id="tutorial_3" aria-hidden="true" style="color:#595959;font-size:30px;"></i>
			</button>
		</div>
		
		<!-- DUGME ZA SPREMANJE LISTE -->
		 <div class="dugme">
			<div class="btn__content" id="confirmer">
			  <a id="tutorial_5" href="/route"><i class="far fa-play-circle" style="color:#595959;font-size:50px;font-weight:bold;"></i></a>
			</div>  
		</div>
	</div>
	<style>
	html {
	overflow: hidden!important;
	}
	.navbar-toggler:focus {
		outline: none;
	}
	.navbar-toggler:hover {
		background: none;
	}
	/* The sidebar menu */

	.sidebar_list {
		height: 100%;
		/* 100% Full-height */
		width: 0;
		/* 0 width - change this with JavaScript */
		position: fixed;
		/* Stay in place */
		z-index: 5;
		/* Stay on top */
		bottom: 0px;
		top: 95px;
		/*right: 0;*/
		background-size: cover;
		background-color: rgba(255, 255, 255, 0.6);
		background-blend-mode: lighten;
		/*opacity: 0.9;*/
		/* background-color: white;*/
		/* Black*/
		background-color: transparent;
		/* Black*/
		overflow-x: hidden;
		/* Disable horizontal scroll */
		padding-top: 10px;
		/* Place content 60px from the top */
		transition: 0.5s;
		/* 0.5 second transition effect to slide in the sidebar */
		text-align: center;
	}
	/* The sidebar links */

	.sidebar_list a {
		padding: 8px 8px 8px 32px;
		font-size: 75px;
		color: #41295a;
		display: block;
		transition: 0.3s;
		;
		text-align: center;
	}
	.sidebar_list p {
		padding: 8px 8px 8px 32px;
		text-decoration: none;
		font-size: 30px;
		color: white;
		border-bottom: 1px solid #41295a;
		display: block;
		transition: 0.3s;
		;
		text-align: center;
	}
	.sidebar_list li {
		font-size: 18px;
		font-weight: bold;
		transition: 0.3s;
		list-style-type: decimal;
		text-align: left;
		margin: 10px;
		padding: 10px;
		background: #595959;
		color: white;
		border-radius: 10px;
		opacity: 0.9;
		list-style-type: none;
	}
	.sidebar_list ul {
		padding-left: 0px!important;
	}
	/* When you mouse over the navigation links, change their color */

	.sidebar_list a:hover {
		color: #f1f1f1;
	}
	/* Position and style the close button (top right corner) */

	.sidebar_list .closebtn {
		position: absolute;
		top: 0;
		right: 25px;
		font-size: 36px;
		margin-left: 50px;
	}
	/* The button used to open the sidebar */

	.openbtn {
		font-size: 20px;
		cursor: pointer;
		background-color: #111;
		color: white;
		padding: 10px 15px;
		border: none;
	}
	/* Style page content - use this if you want to push the page content to the right when you open the side navigation */

	#main {
		transition: margin-left .5s;
		/* If you want a transition effect */
	}
	/* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */

	@media screen and (max-height: 450px) {
		.sidebar {
			padding-top: 15px;
		}
		.sidebar a {
			font-size: 18px;
		}
	}
	h4 {
		color: #41295a;
		font-size: 15px;
		display: block;
		transition: 0.3s;
		;
		border-bottom: 1px solid #41295a;
	}
	.fa-trash {
		color: #41295a;
		font-size: 22px;
		float: right;
		margin-right: 20px;
	}
	.confirmer {
		bottom: 20px;
		font-size: 40px;
		text-align: center;
		margin-top: 30px;
		background: #41295a;
		border: none;
		color: white;
		border-radius: 60px;
		width: 63px;
		width: 210px;
		height: 62px;
		box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3)
	}
	.confirmer:focus {
		outline: none;
	}
	.confirmer:active {
		outline: none;
	}
	.half-circle {
		width: 40px;
		height: 80px;
		background-color: #41295a;
		border-bottom-right-radius: 100px;
		border-top-right-radius: 100px;
		position: absolute;
		top: 50%;
		left: 0px;
		border-left: 0;
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		box-sizing: border-box;
	}
	</style>
	<div class="half-circle" onclick="openNav()"style="display:none;"><i class="fa fa-chevron-left" style="color:white;position:absolute;top:30px;left:10px;"aria-hidden="true"></i></div>
	<style>
	html{
		overflow:hidden!important;
	}
	.navbar-toggler:focus {
		outline: none;
	}
	.navbar-toggler:hover {
		background: none;
	}
	/* The sidebar menu */
	.sidebar {
		height: 100%; /* 100% Full-height */
		width: 0; /* 0 width - change this with JavaScript */
		position: fixed; /* Stay in place */
		z-index: 5; /* Stay on top */
		top: 0px;
		left: 0;
		background-size: cover; 
		background-color: rgba(89  ,89  ,89 ,0.9);
		/* background-blend-mode: lighten;*/
		/* opacity: 0.9;*/
		/* background-color: #BDD684; Black*/
		overflow-x: hidden; /* Disable horizontal scroll */
		padding-top: 10px; /* Place content 60px from the top */
		transition: 0.5s; /* 0.5 second transition effect to slide in the sidebar */
    }

	/* The sidebar links */
	.sidebar a {
		padding: 8px 8px 8px 8px;
		text-decoration: none;
		font-size: 75px;
		color: white;
		display: block;
		transition: 0.3s;;
		text-align:center;
	}

	/* When you mouse over the navigation links, change their color */
	.sidebar a:hover {
		color: #f1f1f1;
	}

	/* Position and style the close button (top right corner) */
	.sidebar .closebtn {
		position: absolute;
		top: 0;
		right: 25px;
		font-size: 36px;
		margin-left: 50px;
	}

	/* The button used to open the sidebar */
	.openbtn {
		font-size: 20px;
		cursor: pointer;
		background-color: #111;
		color: white;
		padding: 10px 15px;
		border: none;
	}
	
	.sidebar p{
		margin: 0 0 10px;
	}

	/* Style page content - use this if you want to push the page content to the right when you open the side navigation */
	#main {
		transition: margin-left .5s; /* If you want a transition effect */
	 
	}

	/* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
	@media screen and (max-height: 450px) {
		.sidebar {padding-top: 15px;}
		.sidebar a {font-size: 18px;}
	}
	</style>
	<div id="mySidebar" class="sidebar" >
		<i class="fa fa-times" onclick="closeNav()"  aria-hidden="true" style="position:absolute;top:10px;right:10px;color:white;font-size:30px;"></i>
		<a href="/back"><i class="fa fa-home" aria-hidden="true"></i><p style="font-size:20px;">Home</p> </a>
		<a href="/settings"><i class="fa fa-cog" aria-hidden="true"></i> <p style="font-size:20px;">Settings</p> </a>
		<a  data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-language" aria-hidden="true"></i><p style="font-size:20px;">Languages</p> </a>
		<div class="collapse" id="collapseExample">
			<ul style=" all: unset;">
				<li class="language_list"><a style="padding:0px;margin:5px;font-size:20px;" href="{{ url('locale/bs') }}" ><img src="{{asset('images/ba.png')}}" height="24" width="24"></a></li>
				<li class="language_list"><a style="padding:0px;margin:5px;font-size:20px;" href="{{ url('locale/en') }}" ><img src="{{asset('images/en.png')}}" height="24" width="24"></a></li>
				<li class="language_list"><a style="padding:0px;margin:5px;font-size:20px;" href="{{ url('locale/de') }}" ><img src="{{asset('images/de.png')}}" height="24" width="24"></a></li>
			</ul>
		</div>
		<a href="#"><i class="fa fa-info-circle" aria-hidden="true"></i><p style="font-size:20px;">Tutorial</p> </a>
	</div>
	
	<div id="mySidebar_list" class="sidebar_list">
		<ul>
		</ul>
		<div class="dugme" id="saver">
		</div>
		<!--<button class="confirmer"><i class="fa fa-check" aria-hidden="true"></i></button>-->
       <script src="js/scripts.js"></script>
	</div>
  </body>
</html>

