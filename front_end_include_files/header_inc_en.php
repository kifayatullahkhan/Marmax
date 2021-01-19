<div id="header">
	<div id="set_width_height">
<div id="logo">
           
           </div>
           <!-- End of Logo  -->
           <div id="tabs">
             <ul>
               <li><a href="index_en.php?CONTENT_TYPE=DEALS"  class="deals" id="BtnDeals"><div id="lblDeals">Deals &amp; Copouns</div></a></li>
               <li><a href="index_en.php?CONTENT_TYPE=VS" class="virtual_stores" id="BtnVirtualStores"><div id="lblVirtualStores">Virtual Stores</div></a></li>
             </ul>
           </div>
           <!-- End of Tabs -->
           <!-- Start of the sign_in_sign_up -->
             <div id="language_button">
             <ul>
               <li class="english_button"><a href="<?php
			  
			   $CurrentPageURL="../";
               if(strpos(basename($_SERVER['PHP_SELF']),'_en.php')===false){
				  $CurrentPageURL= basename($_SERVER['PHP_SELF'],'.php')."_en.php";
			   }else{
				  $CurrentPageURL= basename($_SERVER['PHP_SELF']);
				   
			   }
  				if(isset($_SERVER["QUERY_STRING"])) {
					echo  $CurrentPageURL."?".$_SERVER["QUERY_STRING"];
				}else{
					echo  $CurrentPageURL;	
				}
			   
			   ?>"  class="englih"></a></li>
               <li class="arabic_button"><a href="<?php
			   $CurrentPageURL="../";
               if(strpos(basename($_SERVER['PHP_SELF']),'_en.php')===false){
				 $CurrentPageURL= basename($_SERVER['PHP_SELF']);
			   }else{
				 $CurrentPageURL= basename($_SERVER['PHP_SELF'],'_en.php').".php";			   
			   }
 
			   if(isset($_SERVER["QUERY_STRING"])) {
					echo  $CurrentPageURL."?".$_SERVER["QUERY_STRING"];
				}else{
					echo  $CurrentPageURL;	
				}
			   ?>"  class="arabic"></a></li>
             </ul>
           </div>
           <!-- End of the sign_in_sign_up -->           
           
           <!-- Start of the sign_in_sign_up -->
         <!-- Start of the sign_in_sign_up -->
           <?php if(isset($_SESSION) && isset($_SESSION['MM_Username'])) {  
           		   if(isset($_SESSION['MM_UserGroup']) && $_SESSION['MM_UserGroup']==1){
				   		//Load Administrator's Sesson Menu
						if(file_exists("admin_zpanel/admin_session_menu_en.php")) 
						require_once("admin_zpanel/admin_session_menu_en.php"); 
						else
						if(file_exists("../admin_zpanel/admin_session_menu_en.php")) 
						require_once("../admin_zpanel/admin_session_menu_en.php"); 
				   }
					else{
						// Load User Panel Session Menu
						
						if(file_exists("user_cpanel/user_session_menu_en.php")) 
						require_once("user_cpanel/user_session_menu_en.php");
						else  
						if(file_exists("../user_cpanel/user_session_menu_en.php")) 
						require_once("../user_cpanel/user_session_menu_en.php"); 	
					}
					
              } else { ?>
             
              <div id="sign_in_sign_up">
                 <ul>
                   <li><a href="#" class="sign_up" id="LinkSignUp">&nbsp;</a></li>
                   <li><a href="#" class="sign_in"  id="LinkSignIn">&nbsp;</a></li>               
                 </ul>
              </div>
             
             <?php } // End of Session Sign In Test ?>
           <!-- End of the sign_in_sign_up -->
  </div>
</div>
<?php require_once("header_inc_jquery_script.php"); ?>