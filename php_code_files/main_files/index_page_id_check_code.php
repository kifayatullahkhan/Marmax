<?php
					    
						
						$PageID="";
						if (isset($_GET['ID']))	$PageID=$_GET['ID'];
						
					
						switch ($PageID){
						case "sendmepassword":	
								require "user_password_recovery_via_email.php";
								break; 								
						case "registeruser":	
								require "user_accounts_registration.php";
								break; 
						case "publicsharedfiles":	
								require "file_sharing_view_public_shared_files.php";
								break; 
						case "feedback":	
								require "feed_back_form.php";
								break; 																							
						default:
								require_once("index_main_page_content.php");
						}
					   
?>