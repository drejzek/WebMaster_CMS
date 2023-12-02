/* const block = document.querySelector("header");

const link_script = document.createElement("src");  
link_script.src = 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js';  

const link_styles = document.createElement("link");  
link_script.href = 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css';  
link_script.rel = 'stylesheet';  

block.appendChild(link_script);
block.appendChild(link_styles);

const body = document.querySelector("body");

const mapa = document.createElement("div");  
mapa.id = 'map';
mapa.style.display = 'none';
mapa.style.height = '100px';

body.appendChild(mapa);

const map = L.map('map').fitWorld();

	const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
		maxZoom: 19,
		attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
	}).addTo(map);

	function onLocationFound(e) {
		const radius = e.accuracy / 2;

		const locationMarker = L.marker(e.latlng).addTo(map)
			.bindPopup(`You are within ${radius} meters from this point`).openPopup();

		const locationCircle = L.circle(e.latlng, radius).addTo(map);

        window.alert('Souřadnice: ' + e.latlng.toString().replace('LatLng(', '').replace(')', ''));
	}

	function onLocationError(e) {
		alert(e.message);
	}

	map.on('locationfound', onLocationFound);
	map.on('locationerror', onLocationError);

	map.locate({setView: true, maxZoom: 16});  */