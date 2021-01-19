

$(document).ready(function() {
      $(".SubNavigation").hide(); // Hide All Submenus
});



	$(".Navigation a").hover(function(){
		 $(".SubNavigation").hide();	
		//$('div:not(#myDiv)')
		ShowSubNavigation(this.id);			
	    },function(){ // Hover Out Code Below
	 }); // End of the Hover Effect
 
  $("#PageBodyWraper").mouseenter(function() {
      $(".SubNavigation").hide(); // Hide All Submenus
});
//========================================
//   Function to Handel the Show Div Menu
//========================================
function ShowSubNavigation($vTagID){
    //alert($vTagID+"SubNav");
	//$(".SubNavigation:not(#" + $vTagID+"SubNav").hide(); // Hide All Submenus but not the crrently opened one)
	var position = $("#" +$vTagID).offset();  // Get the Left and Top Postion to the Object Variable
	var width = $("#" +$vTagID).width();  // get the Width of the Tag.
 
	var NewLeft=(position.left + width); 
	var NewTop=position.top+40;
	

 
   $("#" +$vTagID+"SubNav").css( { "left": NewLeft + "px", "top":NewTop + "px" } ); // Apply the New Left andTop to the Tag
 	//$("#" +$vTagID+"SubNav").fadeOut(100); // Show Menu with Affects
	//$("#" +$vTagID+"SubNav").fadeIn(500); 
	//$("#" +$vTagID+"SubNav").slideDown();
	$("#" +$vTagID+"SubNav").animate();
 

 
}

