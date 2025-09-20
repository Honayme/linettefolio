/*
 * Copyright (c) 2022 Marketify
 * Author: Marketify
 * This file is made for CURRENT TEMPLATE
*/

jQuery(document).ready(function(){
	"use strict";
	// Initialize only essential functions needed for owl carousel
	tokyo_tm_owl_carousel();
});

// -----------------------------------------------------
// ---------------   FUNCTIONS    ----------------------
// -----------------------------------------------------

// -----------------------------------------------------
// ---------------------   OWL CAROUSEL    -------------
// -----------------------------------------------------

function tokyo_tm_owl_carousel(){
	"use strict";

	var owl = jQuery('.owl-carousel');
	owl.each(function(index,el){
		var config = jQuery(this).data("config");
		if(config !== undefined){
			jQuery(this).owlCarousel(config);
		}
	});
}