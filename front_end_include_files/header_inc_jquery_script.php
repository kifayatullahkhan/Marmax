<script type="text/javascript">
var SelectedPageSectionDealsOrVirtualStores="VirtualStores";  // Deals (Coupons) or Virtual Stores
$("#UserDetailsMenu").click(function() {
   $("#UserDetailsMenuList").fadeToggle("slow", "linear");

});
$("#UserDetailsMenuList a").click(function() {
    $("#UserDetailsMenuList").fadeToggle("fast", "linear");

});



$("#BtnVirtualStores_REMOVED").click(function(event) {
	 
	  event.preventDefault();
	     SelectedPageSectionDealsOrVirtualStores="VirtualStores";
		 $("html").removeClass("deal_selected");
		 $("html").addClass("vs_selected");
		 
	  	 $('#show_categories').fadeOut("slow"); // Used in the Admin Panel Only
		 $('#show_sub_categories').hide();// Used in the Admin Panel Only
		 $("#page_contents").hide();

 		 $.get("php_code_files/virtual_stores/show_category_items_<?php echo $_SESSION['ln']; ?>.php",function(data){
			    $('#page_contents').html(data);		 
		   });
		 $('#show_categories').fadeIn("slow"); // Used in the Admin Panel Only
		 $('#show_sub_categories').show(); // Used in the Admin Panel Only
		 $("#page_contents").show();
		 
		 $.get("php_code_files/virtual_stores/show_categories_and_its_sub_categories_<?php echo $_SESSION['ln']; ?>.php", function(data){
			    $('#DropDownMenu').html(data);		 
		  	 });		  
			 	 
		 
});
$('#BtnDeals_REMOVED').click(function(event) {
  	       event.preventDefault();	
		   SelectedPageSectionDealsOrVirtualStores="Deals";
		   $("html").removeClass("vs_selected"); // Used in the Admin Panel Only
		   $("html").addClass("deal_selected"); // Used in the Admin Panel Only
		   //$("#show_categories").html("");
		   //$('#show_sub_categories').html("");
		   $('#show_categories').fadeOut("slow"); // Used in the Admin Panel Only
		   $('#show_sub_categories').hide(); // Used in the Admin Panel Only
		   $("#page_contents").hide();	   	   	   
		   $.get("php_code_files/deals/show_category_items_<?php echo $_SESSION['ln']; ?>.php", function(data){
			    $('#page_contents').html(data);		 
		   });
		   //$('#show_categories').fadeIn("slow");
		   //$('#page_contents').fadeIn("slow");
		   $('#page_contents').show();	   
		   // Load Category Listings for Deals
		  $.get("php_code_files/deals/show_categories_<?php echo $_SESSION['ln']; ?>.php", function(data){
			    $('#DropDownMenu').html(data); 
		  	 });
		 
	    
});

// FRom Footer

$ToggleStatus_ShowSignInFormWithEffects=false;
function ShowSignInFormWithEffects() {	
	        // get effect type from 
			var selectedEffect = "blind";
						

			// most effect types need no options passed by default
			var options = {};
			// some effects have required parameters
			if ( selectedEffect === "scale" ) {
				options = { percent: 100 };
			} else if ( selectedEffect === "size" ) {
				options = { to: { width: 280, height: 185 } };
			}

			
			if ($ToggleStatus_ShowSignInFormWithEffects==true) {
				$ToggleStatus_ShowSignInFormWithEffects=false;
				$( "#sign_in_form" ).hide(100);
			}else{
			// run the effect
			$( "#sign_in_form" ).show( selectedEffect, options, 200);
			$ToggleStatus_ShowSignInFormWithEffects=true;
			}
		}; // End of ShowSignInFormWithEffects
		
/* Sign Up Form Function for Effects */
$ToggleStatus_ShowSignUpFormWithEffects=false;
function ShowSignUpFormWithEffects() {	
	        // get effect type from 
			var selectedEffect = "blind";
						

			// most effect types need no options passed by default
			var options = {};
			// some effects have required parameters
			if ( selectedEffect === "scale" ) {
				options = { percent: 100 };
			} else if ( selectedEffect === "size" ) {
				options = { to: { width: 280, height: 185 } };
			}

			
			if ($ToggleStatus_ShowSignUpFormWithEffects==true) {
				$ToggleStatus_ShowSignUpFormWithEffects=false;
				$( "#sign_up_form" ).hide(100);
			}else{
			// run the effect
			$( "#sign_up_form" ).show( selectedEffect, options, 200);
			$ToggleStatus_ShowSignUpFormWithEffects=true;
			}
		}; // End of ShowSignInFormWithEffects		

$("#LinkSignIn").click(function() {
				$("#DropDownMenu").fadeOut("slow", "linear"); 
      			$( "#sign_up_form" ).fadeOut("slow", "linear"); 
				ShowSignInFormWithEffects(); 
});

$("#LinkSignUp").click(function() {
       			$("#DropDownMenu").fadeOut("slow", "linear");
				$( "#sign_in_form" ).fadeOut("slow", "linear"); 
				ShowSignUpFormWithEffects(); 
});
</script>