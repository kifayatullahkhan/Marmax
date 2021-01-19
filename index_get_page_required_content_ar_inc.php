      <?php
	  if(isset($_GET['page_name'])){
		  	switch($_GET['page_name']){
				case "company_profile":
					require_once("static_pages_content/company_profile_ar.php");
					break;
				case "about_us":
					require_once("static_pages_content/about_us_ar.php");
					break;
				case "contact_us":
					require_once("static_pages_content/contact_us_ar.php");
					break;
				case "careers_ar":
					require_once("static_pages_content/careers_ar.php");
					break;	
				case "user_profile":
					require_once("user_cpanel/user_profile_ar.php");
					break;
				case "user_change_password":
					require_once("user_cpanel/change_password_ar.php");
					break;		
				case "show_my_orders":
					require_once("user_cpanel/show_my_orders_ar.php");
					break;									
				case "view_shopping_cart_details":
					require_once("php_code_files/shopping_cart/view_cart_details_ar.php");	
					break;			 													
				default:
					require_once("php_code_files/virtual_stores/show_category_items_ar.php");  
			}// End of Switch
		  
	  }else {
		  if(isset($_GET['CONTENT_TYPE']) && $_GET['CONTENT_TYPE']=="DEALS"){
				require_once("php_code_files/deals/show_category_items_ar.php"); 
		  }else if(isset($_GET['CONTENT_TYPE']) && $_GET['CONTENT_TYPE']=="VS"){
				require_once("php_code_files/virtual_stores/show_category_items_ar.php");
		  }else{
				require_once("php_code_files/virtual_stores/show_category_items_ar.php");  
		  }
	  }// End of Page Name else
	  ?>