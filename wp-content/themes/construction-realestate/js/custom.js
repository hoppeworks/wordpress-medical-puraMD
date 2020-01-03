jQuery(function($){
 "use strict";
   jQuery('.main-menu-navigation > ul').superfish({
     delay:       500,                            
     animation:   {opacity:'show',height:'show'},  
     speed:       'fast'                        
   });

});

function resMenu_open() {
	document.getElementById("navbar-header").style.width = "250px";
}
function resMenu_close() {
  document.getElementById("navbar-header").style.width = "0";
}