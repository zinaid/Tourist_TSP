<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- CSRF Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<title>{{ 'TSP' }}</title>

		<!-- Scripts -->
		<script src="{{ asset('js/app.js') }}" defer></script>

		<!-- Fonts -->
		<link rel="dns-prefetch" href="//fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">


		<!-- Styles -->
		<link href="{{ asset('css/app.css') }}" rel="stylesheet">
		<link href="{{ asset('css/style.css') }}" rel="stylesheet">
		<script src="{{ asset('js/scripts.js') }}"></script>
		 <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet">
		<script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
		<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyARDX6U-QGrtp9nfV0BAdbt6bgcDJZ_0zc"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" type="text/javascript"></script>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
		<link rel="stylesheet" href="/css/bootstrap-tour-standalone.min.css" type="text/css" />
		<script type="text/javascript" src="/js/bootstrap-tour-standalone.min.js"></script>
	</head>
<body>
<script>
$(document).ready(function() {
	// Instance the tour
	$(".tutorial").click(function() {
		var tour = new Tour({
			steps: [{
				element: "#find-route", 
				title: "FIND ROUTE",
				content: "Start the routing process here.",
				placement: "top"
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
})
</script>
<script type="text/javascript">
var map;
var directionsDisplay = null;
var directionsService;
var polylinePath;
var nodes = [];
var prevNodes = [];
var markers = [];
var durations = [];
// Initialize google maps
function initializeMap() {
	// Map options
	var opts = {
		center: new google.maps.LatLng(43.91, 17.67),
		zoom: 6,
		streetViewControl: false,
		mapTypeControl: false,
		gestureHandling: "greedy",
		disableDefaultUI: true,
	};
	map = new google.maps.Map(document.getElementById('map-canvas'), opts);
	// Create map click event
	// google.maps.event.addListener(map, 'click', function(event) {
	// console.log(map);
	// console.log(event.latLng);
	// // Add destination (max 9)
	// if (nodes.length >= 15) {
	// alert('Max destinations added');
	// return;
	// }
	// // If there are directions being shown, clear them
	// clearDirections();
	// // Add a node to map
	// marker = new google.maps.Marker({position: event.latLng, map: map});
	// markers.push(marker);
	// // Store node's lat and lng
	// nodes.push(event.latLng);
	// console.log(markers);
	// console.log(nodes);       
	// // Update destination count
	// $('#destinations-count').html(nodes.length);
	// });
	// Change this depending on the name of your PHP or XML file
	$.ajax({
		url: "/returnplace.php",
		type: 'GET',
		dataType: "xml",
		data: {
			"_token": "{{ csrf_token() }}"
		},
		success: function(data) {
			// console.log(data);
			var xml = data.responseXML;
			var markers = data.documentElement.getElementsByTagName('marker');
			console.log(markers);
			Array.prototype.forEach.call(markers, function(markerElem) {
				var id = markerElem.getAttribute('id');
				var name = markerElem.getAttribute('name');
				var address = markerElem.getAttribute('address');
				var type = markerElem.getAttribute('type');
				var point = new google.maps.LatLng(parseFloat(markerElem.getAttribute('lat')), parseFloat(markerElem.getAttribute('lng')));
				nodes.push(point);
				// console.log(nodes);
				$('#destinations-count').html(nodes.length);
				var infowincontent = document.createElement('div');
				var strong = document.createElement('strong');
				strong.textContent = name
				infowincontent.appendChild(strong);
				infowincontent.appendChild(document.createElement('br'));
				var text = document.createElement('text');
				text.textContent = address
				infowincontent.appendChild(text);
				// var icon = customLabel[type] || {};
				var marker = new google.maps.Marker({
					map: map,
					position: point,
					// label: icon.label
				});
				marker.addListener('click', function() {
					map.setContent(infowincontent);
					map.open(map, marker);
				});
			});
		},
		error: function(request, status, error) {
			console.log(status);
			alert(xhr.responseText);
		}
	});
	// Add "my location" button
	var myLocationDiv = document.createElement('div');
	new getMyLocation(myLocationDiv, map);
	map.controls[google.maps.ControlPosition.TOP_RIGHT].push(myLocationDiv);

	function getMyLocation(myLocationDiv, map) {
		var myLocationBtn = document.createElement('button');
		myLocationBtn.innerHTML = 'My Location';
		myLocationBtn.className = 'large-btn';
		myLocationBtn.style.margin = '5px';
		myLocationBtn.style.background = '#41295a';
		myLocationBtn.style.color = 'white';
		myLocationBtn.style.height = '30px';
		myLocationBtn.style.border = 'none';
		myLocationBtn.style.opacity = '0.95';
		myLocationBtn.style.borderRadius = '5px';
		myLocationBtn.style.display = 'none';
		myLocationDiv.appendChild(myLocationBtn);
		google.maps.event.addDomListener(myLocationBtn, 'click', function() {
			navigator.geolocation.getCurrentPosition(function(success) {
				map.setCenter(new google.maps.LatLng(success.coords.latitude, success.coords.longitude));
				map.setZoom(12);
			});
		});
	}
}
// Get all durations depending on travel type
function getDurations(callback) {
	var service = new google.maps.DistanceMatrixService();
	service.getDistanceMatrix({
		origins: nodes,
		destinations: nodes,
		travelMode: google.maps.TravelMode[$('#travel-type').val()],
		avoidHighways: parseInt($('#avoid-highways').val()) > 0 ? true : false,
		avoidTolls: false,
	}, function(distanceData) {
		// Create duration data array
		var nodeDistanceData;
		for (originNodeIndex in distanceData.rows) {
			nodeDistanceData = distanceData.rows[originNodeIndex].elements;
			durations[originNodeIndex] = [];
			for (destinationNodeIndex in nodeDistanceData) {
				if (durations[originNodeIndex][destinationNodeIndex] = nodeDistanceData[destinationNodeIndex].duration == undefined) {
					alert('Error: couldn\'t get a trip duration from API');
					return;
				}
				durations[originNodeIndex][destinationNodeIndex] = nodeDistanceData[destinationNodeIndex].duration.value;
			}
		}
		if (callback != undefined) {
			callback();
		}
	});
}
// Removes markers and temporary paths
function clearMapMarkers() {
	for (index in markers) {
		markers[index].setMap(null);
	}
	prevNodes = nodes;
	nodes = [];
	if (polylinePath != undefined) {
		polylinePath.setMap(null);
	}
	markers = [];
	$('#ga-buttons').show();
}
// Removes map directions
function clearDirections() {
	// If there are directions being shown, clear them
	if (directionsDisplay != null) {
		directionsDisplay.setMap(null);
		directionsDisplay = null;
	}
}
// Completely clears map
function clearMap() {
	clearMapMarkers();
	clearDirections();
	$('#destinations-count').html('0');
}
// Initial Google Maps
google.maps.event.addDomListener(window, 'load', initializeMap);
// Create listeners
$(document).ready(function() {
	$('#clear-map').click(clearMap);
	// Start GA
	$('#find-route').click(function() {
		$(".genetic_infos").css("display", "block");
		if (nodes.length < 2) {
			if (prevNodes.length >= 2) {
				nodes = prevNodes;
			} else {
				alert('Click on the map to select destination points');
				return;
			}
		}
		if (directionsDisplay != null) {
			directionsDisplay.setMap(null);
			directionsDisplay = null;
		}
		$('#ga-buttons').hide();
		// Get route durations
		getDurations(function() {
			$('.ga-info').show();
			// Get config and create initial GA population
			ga.getConfig();
			var pop = new ga.population();
			pop.initialize(nodes.length);
			var route = pop.getFittest().chromosome;
			ga.evolvePopulation(pop, function(update) {
				$('#generations-passed').html(update.generation);
				$('#best-time').html((update.population.getFittest().getDistance() / 3600).toFixed(2) + ' h');
				// Get route coordinates
				var route = update.population.getFittest().chromosome;
				var routeCoordinates = [];
				for (index in route) {
					routeCoordinates[index] = nodes[route[index]];
				}
				routeCoordinates[route.length] = nodes[route[0]];
				// Display temp. route
				if (polylinePath != undefined) {
					polylinePath.setMap(null);
				}
				polylinePath = new google.maps.Polyline({
					path: routeCoordinates,
					strokeColor: "#0066ff",
					strokeOpacity: 0.75,
					strokeWeight: 2,
				});
				polylinePath.setMap(map);
			}, function(result) {
				// Get route
				route = result.population.getFittest().chromosome;
				// Add route to map
				directionsService = new google.maps.DirectionsService();
				directionsDisplay = new google.maps.DirectionsRenderer();
				directionsDisplay.setMap(map);
				var waypts = [];
				for (var i = 1; i < route.length; i++) {
					waypts.push({
						location: nodes[route[i]],
						stopover: true
					});
				}
				// Add final route to map
				var request = {
					origin: nodes[route[0]],
					destination: nodes[route[0]],
					waypoints: waypts,
					travelMode: google.maps.TravelMode[$('#travel-type').val()],
					avoidHighways: parseInt($('#avoid-highways').val()) > 0 ? true : false,
					avoidTolls: false
				};
				directionsService.route(request, function(response, status) {
					if (status == google.maps.DirectionsStatus.OK) {
						directionsDisplay.setDirections(response);
						console.log(response);
					}
					clearMapMarkers();
				});
			});
		});
	});
});
// GA code
var ga = {
	// Default config
	"crossoverRate": 0.5,
	"mutationRate": 0.1,
	"populationSize": 50,
	"tournamentSize": 5,
	"elitism": true,
	"maxGenerations": 50,
	"tickerSpeed": 60,
	// Loads config from HTML inputs
	"getConfig": function() {
		ga.crossoverRate = parseFloat($('#crossover-rate').val());
		ga.mutationRate = parseFloat($('#mutation-rate').val());
		ga.populationSize = parseInt($('#population-size').val()) || 50;
		ga.elitism = parseInt($('#elitism').val()) || false;
		ga.maxGenerations = parseInt($('#generations').val()) || 50;
	},
	// Evolves given population
	"evolvePopulation": function(population, generationCallBack, completeCallBack) {
		// Start evolution
		var generation = 1;
		var evolveInterval = setInterval(function() {
			if (generationCallBack != undefined) {
				generationCallBack({
					population: population,
					generation: generation,
				});
			}
			// Evolve population
			population = population.crossover();
			population.mutate();
			generation++;
			// If max generations passed
			if (generation > ga.maxGenerations) {
				// Stop looping
				clearInterval(evolveInterval);
				if (completeCallBack != undefined) {
					completeCallBack({
						population: population,
						generation: generation,
					});
				}
			}
		}, ga.tickerSpeed);
	},
	// Population class
	"population": function() {
		// Holds individuals of population
		this.individuals = [];
		// Initial population of random individuals with given chromosome length
		this.initialize = function(chromosomeLength) {
			this.individuals = [];
			for (var i = 0; i < ga.populationSize; i++) {
				var newIndividual = new ga.individual(chromosomeLength);
				newIndividual.initialize();
				this.individuals.push(newIndividual);
			}
		};
		// Mutates current population
		this.mutate = function() {
			var fittestIndex = this.getFittestIndex();
			for (index in this.individuals) {
				// Don't mutate if this is the elite individual and elitism is enabled 
				if (ga.elitism != true || index != fittestIndex) {
					this.individuals[index].mutate();
				}
			}
		};
		// Applies crossover to current population and returns population of offspring
		this.crossover = function() {
			// Create offspring population
			var newPopulation = new ga.population();
			// Find fittest individual
			var fittestIndex = this.getFittestIndex();
			for (index in this.individuals) {
				// Add unchanged into next generation if this is the elite individual and elitism is enabled
				if (ga.elitism == true && index == fittestIndex) {
					// Replicate individual
					var eliteIndividual = new ga.individual(this.individuals[index].chromosomeLength);
					eliteIndividual.setChromosome(this.individuals[index].chromosome.slice());
					newPopulation.addIndividual(eliteIndividual);
				} else {
					// Select mate
					var parent = this.tournamentSelection();
					// Apply crossover
					this.individuals[index].crossover(parent, newPopulation);
				}
			}
			return newPopulation;
		};
		// Adds an individual to current population
		this.addIndividual = function(individual) {
			this.individuals.push(individual);
		};
		// Selects an individual with tournament selection
		this.tournamentSelection = function() {
			// Randomly order population
			for (var i = 0; i < this.individuals.length; i++) {
				var randomIndex = Math.floor(Math.random() * this.individuals.length);
				var tempIndividual = this.individuals[randomIndex];
				this.individuals[randomIndex] = this.individuals[i];
				this.individuals[i] = tempIndividual;
			}
			// Create tournament population and add individuals
			var tournamentPopulation = new ga.population();
			for (var i = 0; i < ga.tournamentSize; i++) {
				tournamentPopulation.addIndividual(this.individuals[i]);
			}
			return tournamentPopulation.getFittest();
		};
		// Return the fittest individual's population index
		this.getFittestIndex = function() {
			var fittestIndex = 0;
			// Loop over population looking for fittest
			for (var i = 1; i < this.individuals.length; i++) {
				if (this.individuals[i].calcFitness() > this.individuals[fittestIndex].calcFitness()) {
					fittestIndex = i;
				}
			}
			return fittestIndex;
		};
		// Return fittest individual
		this.getFittest = function() {
			return this.individuals[this.getFittestIndex()];
		};
	},
	// Individual class
	"individual": function(chromosomeLength) {
		this.chromosomeLength = chromosomeLength;
		this.fitness = null;
		this.chromosome = [];
		// Initialize random individual
		this.initialize = function() {
			this.chromosome = [];
			// Generate random chromosome
			for (var i = 0; i < this.chromosomeLength; i++) {
				this.chromosome.push(i);
			}
			for (var i = 0; i < this.chromosomeLength; i++) {
				var randomIndex = Math.floor(Math.random() * this.chromosomeLength);
				var tempNode = this.chromosome[randomIndex];
				this.chromosome[randomIndex] = this.chromosome[i];
				this.chromosome[i] = tempNode;
			}
		};
		// Set individual's chromosome
		this.setChromosome = function(chromosome) {
			this.chromosome = chromosome;
		};
		// Mutate individual
		this.mutate = function() {
			this.fitness = null;
			// Loop over chromosome making random changes
			for (index in this.chromosome) {
				if (ga.mutationRate > Math.random()) {
					var randomIndex = Math.floor(Math.random() * this.chromosomeLength);
					var tempNode = this.chromosome[randomIndex];
					this.chromosome[randomIndex] = this.chromosome[index];
					this.chromosome[index] = tempNode;
				}
			}
		};
		// Returns individuals route distance
		this.getDistance = function() {
			var totalDistance = 0;
			for (index in this.chromosome) {
				var startNode = this.chromosome[index];
				var endNode = this.chromosome[0];
				if ((parseInt(index) + 1) < this.chromosome.length) {
					endNode = this.chromosome[(parseInt(index) + 1)];
				}
				totalDistance += durations[startNode][endNode];
			}
			totalDistance += durations[startNode][endNode];
			return totalDistance;
		};
		// Calculates individuals fitness value
		this.calcFitness = function() {
			if (this.fitness != null) {
				return this.fitness;
			}
			var totalDistance = this.getDistance();
			this.fitness = 1 / totalDistance;
			return this.fitness;
		};
		// Applies crossover to current individual and mate, then adds it's offspring to given population
		this.crossover = function(individual, offspringPopulation) {
			var offspringChromosome = [];
			// Add a random amount of this individual's genetic information to offspring
			var startPos = Math.floor(this.chromosome.length * Math.random());
			var endPos = Math.floor(this.chromosome.length * Math.random());
			var i = startPos;
			while (i != endPos) {
				offspringChromosome[i] = individual.chromosome[i];
				i++
				if (i >= this.chromosome.length) {
					i = 0;
				}
			}
			// Add any remaining genetic information from individual's mate
			for (parentIndex in individual.chromosome) {
				var node = individual.chromosome[parentIndex];
				var nodeFound = false;
				for (offspringIndex in offspringChromosome) {
					if (offspringChromosome[offspringIndex] == node) {
						nodeFound = true;
						break;
					}
				}
				if (nodeFound == false) {
					for (var offspringIndex = 0; offspringIndex < individual.chromosome.length; offspringIndex++) {
						if (offspringChromosome[offspringIndex] == undefined) {
							offspringChromosome[offspringIndex] = node;
							break;
						}
					}
				}
			}
			// Add chromosome to offspring and add offspring to population
			var offspring = new ga.individual(this.chromosomeLength);
			offspring.setChromosome(offspringChromosome);
			offspringPopulation.addIndividual(offspring);
		};
	},
};
</script>
<style>
.top_menu {
	position: relative;
	z-index: 3;
	font-size: 20px;
	height: 0px;
}
.top_menu_left {
	position: absolute;
	top: 20px;
	left: 40px;
	font-size: 25px;
}
.top_menu_adder {
	position: absolute;
	top: 70px;
	right: 45px;
	border: none;
	display: none;
}
.genetic_infos {
	background: white;
	width: 120px;
	height: 130px;
	position: absolute;
	right: 10px;
	bottom: 80px;
	z-index: 6;
	border-radius: 20px;
	padding: 20px;
}
</style>
	<div id="app">
		<div class="top_menu">
			<div class="top_menu_left" onclick="openNav()">
				<i aria-hidden="true" class="fas fa-bars"></i>
			</div>
		</div>
		<main class="py-4" style="padding:0px!important;">
			@yield('content')
		</main><?php 
		            use App\Settings;
		            $settings = new Settings();
		            $settings = settings::all();
		        foreach($settings as $settings){
		        ?>
		<table style="display:none;">
			<tr>
				<td colspan="2"><b>Configuration</b></td>
			</tr>
			<tr>
				<td>Travel Mode:</td>
				<td><select id="travel-type">
					<option value="DRIVING">
						Car
					</option>
					<option value="BICYCLING">
						Bicycle
					</option>
					<option value="WALKING">
						Walking
					</option>
				</select></td>
			</tr>
			<tr>
				<td>Avoid Highways:</td>
				<td><select id="avoid-highways">
					<option value="1">
						Enabled
					</option>
					<option value="0">
						Disabled
					</option>
				</select></td>
			</tr>
			<tr>
				<td>Population Size:</td>
				<td><select id="population-size">
					<option value="5">
						5
					</option>
					<option value="10">
						10
					</option>
					<option value="20">
						20
					</option>
					<option value="50">
						50
					</option>
					<option value="100">
						100
					</option>
					<option value="200">
						200
					</option>
				</select></td>
			</tr>
			<tr>
				<td>Mutation Rate:</td>
				<td><select id="mutation-rate">
					<option value="0.00">
						0.00
					</option>
					<option value="0.01">
						0.01
					</option>
					<option value="0.05">
						0.05
					</option>
					<option value="0.1">
						0.1
					</option>
					<option value="0.2">
						0.2
					</option>
					<option value="0.4">
						0.4
					</option>
					<option value="0.7">
						0.7
					</option>
					<option value="1">
						1.0
					</option>
				</select></td>
			</tr>
			<tr>
				<td>Crossover Rate:</td>
				<td><select id="crossover-rate">
					<option value="0.0">
						0.0
					</option>
					<option value="0.1">
						0.1
					</option>
					<option value="0.2">
						0.2
					</option>
					<option value="0.3">
						0.3
					</option>
					<option value="0.4">
						0.4
					</option>
					<option value="0.5">
						0.5
					</option>
					<option value="0.6">
						0.6
					</option>
					<option value="0.7">
						0.7
					</option>
					<option value="0.8">
						0.8
					</option>
					<option value="0.9">
						0.9
					</option>
					<option value="1">
						1.0
					</option>
				</select></td>
			</tr>
			<tr>
				<td>Elitism:</td>
				<td><select id="elitism">
					<option value="1">
						Enabled
					</option>
					<option value="0">
						Disabled
					</option>
				</select></td>
			</tr>
			<tr>
				<td>Max Generations:</td>
				<td><select id="generations">
					<option value="20">
						20
					</option>
					<option value="50">
						50
					</option>
					<option value="100">
						100
					</option>
				</select></td>
			</tr>
			<tr>
				<td colspan="2"><b>Debug Info</b></td>
			</tr>
			<tr>
				<td>Destinations Count:</td>
				<td id="destinations-count">0</td>
			</tr>
			<tr class="ga-info" style="display:none;">
				<td></td>
			</tr>
			<tr class="ga-info" style="display:none;">
				<td></td>
			</tr>
			<tr id="ga-buttons">
				<td colspan="2"><button id="find-route">Start</button> <button id="clear-map">Clear</button></td>
			</tr>
		</table><?php } ?>
		<div class="genetic_infos" style="display:none;">
			<div class="col-xs-12">
				<div>
					Generations:
				</div>
				<div id="generations-passed">
					0
				</div>
				<div>
					Best Time:
				</div>
				<div id="best-time">
					?
				</div>
				<table></table>
			</div>
		</div>
	</div>
	
	<style>
	html {
		overflow: hidden!important;
		font-family: Slack-Larsseit !important;
	}
	.navbar-toggler:focus {
		outline: none;
	}
	.navbar-toggler:hover {
		background: none;
	}
	/* The sidebar menu */

	.sidebar {
		font-family: Slack-Larsseit!important;
		height: 100%;
		/* 100% Full-height */
		width: 0;
		/* 0 width - change this with JavaScript */
		position: fixed;
		/* Stay in place */
		z-index: 5;
		/* Stay on top */
		top: 0px;
		left: 0;
		background-size: cover;
		background-color: rgba(89, 89, 89, 0.9);
		background-blend-mode: lighten;
		/*opacity: 0.9;*/
		/*background-color: #41295a;  Black*/
		overflow-x: hidden;
		/* Disable horizontal scroll */
		padding-top: 10px;
		/* Place content 60px from the top */
		transition: 0.5s;
		/* 0.5 second transition effect to slide in the sidebar */
	}
	/* The sidebar links */

	.sidebar a {
		padding: 8px 8px 8px 8px;
		text-decoration: none;
		font-size: 75px;
		color: white;
		display: block;
		transition: 0.3s;
		;
		text-align: center;
		margin-top: 20px;
		font-family: Slack-Larsseit!important;
	}
	/* When you mouse over the navigation links, change their color */

	.sidebar a:hover {
		color: #f1f1f1;
		font-family: Slack-Larsseit !important;
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
	p {
		font-family: Slack-Larsseit !important;
		margin-top: 10px;
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
</body>
</html>
