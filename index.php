<?php 
if(file_exists('Connections/Conn.php')){ require_once('Connections/Conn.php'); }else
if(file_exists('../Connections/Conn.php')){ require_once('../Connections/Conn.php'); }else
if(file_exists('../../Connections/Conn.php')){ require_once('../../Connections/Conn.php'); } 
if (!isset($_SESSION)) {
	session_start();	
}
$_SESSION['ln']="ar";
?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sooqna | سوقنا</title>
   <?php require_once("php_code_files/cms_web_page_read_sections/page_head_section_libraries_inc_ar.php"); ?>
<!--[if gte IE 9]>
  <style type="text/css">
    .gradient {
       filter: none;
    }
    .griadent_saima {
       filter: none;
    }
    .griadent_misbah {
       filter: none;
    }
  </style>
<![endif]-->
</head>

<body>
<div id="error">
Error Occured.
</div>
<div id="warning">
Warning!. Make sure you perform the correct action.
</div>
<div id="notification">
The Action has been completed Successfully.
</div>

<!-- Start of the header -->
 <?php require_once("front_end_include_files/header_inc_ar.php"); ?>
<!-- End of the header -->

<!-- Start of Page Body "page_default_center_width" -->
<div id="page_default_center_width">
	<div class="clear_all"></div>
	<!-- Start of SearchMenuBar -->
     <?php require_once('php_code_files/cms_web_page_read_sections/search_and_menu_bar_inc_ar.php'); ?>
   	<!-- End of SearchMenuBar -->
	
    <!-- Start of DropDownMenu -->
    <div id="DropDownMenu">
     <?php 
			 if(isset($_GET['CONTENT_TYPE']) && $_GET['CONTENT_TYPE']=="DEALS"){
				// Do nothing
			  }else if(isset($_GET['CONTENT_TYPE']) && $_GET['CONTENT_TYPE']=="VS"){
					require_once('php_code_files/virtual_stores/show_categories_and_its_sub_categories_ar.php');
			  }else{
					require_once('php_code_files/virtual_stores/show_categories_and_its_sub_categories_ar.php');
			  }
		  
	 ?>
    </div>
    <div class="clear_all"></div>    
   	<!-- End of DropDownMenu -->
    
	<!-- Start of sign_in_form -->
	<?php require_once("front_end_include_files/sign_in_form_inc_ar.php"); ?>
    <!-- End of sign_in_form-->

	<!-- Start of sign_up_form -->
    <?php require_once("front_end_include_files/sign_up_form_inc_ar.php"); ?>
    <!-- End of sign_up_form-->


    <!-- Start of page_contents -->
    <div id="page_contents" class="gradient  round_borders">
		<?php require_once("index_get_page_required_content_ar_inc.php"); ?>
    </div>
  <!-- End of page_contents-->
     

</div>
 
<!-- End of Page Body "page_default_center_width" -->

<!-- Start of Footer Include -->
 	<?php require_once("php_code_files/cms_web_page_read_sections/page_footer_inc_ar.php"); ?>
<!-- End of Footer Include -->


<div id="footer_cart_wrapper">
<?php require_once("front_end_include_files/show_shopping_cart_details_in_fotter_ar.php"); ?>
</div>


<!-- Start of jQuery Script Inc --> 
   		<?php require_once("front_end_include_files/footer_jquery_scripts_inc.php"); ?>
<!-- End of jQuery Script Inc -->

<?php 
require_once("front_end_include_files/status_messages.php");
?>

</body>
</html>
<!-- 
 Programmer: Kifayat Ullah
 Company Name: Zorkif Technonogy Center
 Email: kifayat@zorkif.com
 Phone: +966 545 88 3076 (Saudi Arabia)
 SMS: +92 333 9403830  (Pakistan)
 Web Site: http://www.zorkif.com
 Date: 16/6/2012
 Client Name: CityNet Riyadh Saudi Arabia (Joint Venture Project Between CityNet & Zorkif Technology Center)
 Project Name: Sooqna.com
 Project Description: Online E-Commerce Store.
 -->