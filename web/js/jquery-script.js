/*jshint jquery:true */
/*global $:true */

var $ = jQuery.noConflict();

$(document).ready(function($) {
	"use strict";

	/* ---------------------------------------------------------------------- */
	/*	Contact Map 2
	/* ---------------------------------------------------------------------- */
	var contact = {"lat":"5.387489", "lon":"-4.000118"}; //Change a map coordinate here!

	try {
		var mapContainer = $('#map2');
		mapContainer.gmap3({
			action: 'addMarker',
			marker:{
				options:{
					icon : new google.maps.MarkerImage('images/marker.png')
				}
			},
			latLng: [contact.lat, contact.lon],
			map:{
				center: [contact.lat, contact.lon],
				zoom: 16
				},
			},
			{action: 'setOptions', args:[{scrollwheel:false}]}
		);
	} catch(err) {

	}

});