<?php 
if(isset($_GET['InvItemID']) && strlen(isset($_GET['InvItemID']))>0){
require_once("php_code_files/shopping_cart/add_item_to_cart.php");

}
if (file_exists("../../Connections/Conn.php")) {
    require_once("../../Connections/Conn.php");
}else if (file_exists("Connections/Conn.php")) {
    require_once("Connections/Conn.php");
}
 
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$colname_Rs_GetItemDetails = "-1";
if (isset($_GET['InvItemID'])) {
  $colname_Rs_GetItemDetails = $_GET['InvItemID'];
}
mysql_select_db($database_Conn, $Conn);
$query_Rs_GetItemDetails = sprintf("SELECT * FROM vs_users_virtual_stores_inventory WHERE VSInvItemCode = %s", GetSQLValueString($colname_Rs_GetItemDetails, "text"));
$Rs_GetItemDetails = mysql_query($query_Rs_GetItemDetails, $Conn) or die(mysql_error());
$row_Rs_GetItemDetails = mysql_fetch_assoc($Rs_GetItemDetails);
$totalRows_Rs_GetItemDetails = mysql_num_rows($Rs_GetItemDetails);

// Prepare Until Expiry Date
	//$UntilDate=date("Y,n,j",strtotime(date("Y-m-d", strtotime($row_Rs_GetItemDetails['PostDateTime'])) . " +".$row_Rs_GetItemDetails['ActiveDays']." days")); 

$PostDate=$row_Rs_GetItemDetails['PostDateTime'];
//$ActiveNumberOfDays=$row_Rs_GetItemDetails['ActiveDays'];
//$NewDate = strtotime ( '+'.$ActiveNumberOfDays.' days' , strtotime ( $PostDate ) ) ;
$NewDate = strtotime ( $PostDate )  ;
$UntilDate = date ("Y,n,j" , $NewDate );


?>


 
<div class="vertical_column" >
 
<div class="deals_buy_section">
	<div class="deals_buy_button">
		<div class="deals_buy_price">
          SAR <?php echo $row_Rs_GetItemDetails['VSInvItemSalesPrice']; ?>
        </div>
        <div class="other_deals_prices">
                <div class="detail">
                <h2>Value</h2>
                <h1>SR<?php echo $row_Rs_GetItemDetails['ActualPrice']; ?></h1>
                </div>
                
            <div class="detail">
              <h2>Discount</h2>
              <h1><?php echo $row_Rs_GetItemDetails['DescountPercentage']; ?>%
              </h1>
          </div>
      </div> <!-- End of other_deals_prices -->
          <div class="other_detail_section">
          	<div class="icon_wrapper">
            <img src="images/hourglass.gif" />
            </div>
            
            <div class="wrapper">
           	  <h2>Since</h2>
             <div id="DealsCountDownTimer"></div>
            </div>
          </div>
          <div class="other_detail_section_tall">
            <div class="wrapper">
            <h2>Over 10 bought</h2>
            <h4>Limited quantity available</h4>
            <div class="deal_is_on">The deal is on<img src="images/checkmark.png" width="48" height="48" /></div>
            </div>
          </div>
          <!-- Store Logo -->
          <div class="store_logo_section_tall">
          <img src="user_uploads/files/deals_virtual_store_images/store_logos/none.jpg" width="226" height="120" /></div>
          <!-- End of Store Logo -->
    </div><!-- End of deals_buy_button -->
</div>


  <div class="golden_ad">
   <img src="user_uploads/files/ads_images/sooqna_ad1.jpg" width="250" height="270" />
   </div>
   
     <div class="golden_ad">
   <img src="user_uploads/files/ads_images/sooqna_ad3.jpg" width="250" height="270" />
   </div>
   
     <div class="golden_ad">
   <img src="user_uploads/files/ads_images/sooqna_ad2.jpg" width="250" height="270" />
   </div>
</div>

	<div class="vs_item">
    		<div class="vs_item_title">
			<?php echo $row_Rs_GetItemDetails['VSInvItemName']; ?>
            </div> <!-- End of vs_item_title -->
            
            <div class="vs_item_short_description">
             <?php echo $row_Rs_GetItemDetails['VSInvItemShortDescription']; ?>         
            </div> <!-- End of vs_item_short_description -->
            
    
            <div class="vs_item_add_to_cart_wrapper">
                <div class="item_image">
                <!-- Start of Nivo Slider Imaage List -->
    	<div id="wrapper">
              <div class="slider-wrapper theme-default">
              <div id="slider" class="nivoSlider">
             <?php 
			 if(isset($row_Rs_GetItemDetails['GallaryImage1']) && $row_Rs_GetItemDetails['GallaryImage1']!="none.jpg"){
			 ?>
             <img src="user_uploads/files/deals_virtual_store_images/<?php echo $row_Rs_GetItemDetails['GallaryImage1']; ?>" width="635" height="285" alt="" data-transition="boxRandom" data-thumb="user_uploads/files/deals_virtual_store_images/<?php echo $row_Rs_GetItemDetails['GallaryImage1']; ?>"/>
             <?php } ?>

             <?php 
			 if(isset($row_Rs_GetItemDetails['GallaryImage2']) && $row_Rs_GetItemDetails['GallaryImage2']!="none.jpg"){
			 ?>
             <img src="user_uploads/files/deals_virtual_store_images/<?php echo $row_Rs_GetItemDetails['GallaryImage2']; ?>" width="635" height="285" alt=""  data-transition="boxRandom" data-thumb="user_uploads/files/deals_virtual_store_images/<?php echo $row_Rs_GetItemDetails['GallaryImage2']; ?>"/>
             <?php } ?>
             
                          <?php 
			 if(isset($row_Rs_GetItemDetails['GallaryImage3']) && $row_Rs_GetItemDetails['GallaryImage3']!="none.jpg"){
			 ?>
             <img src="user_uploads/files/deals_virtual_store_images/<?php echo $row_Rs_GetItemDetails['GallaryImage3']; ?>" width="635" height="285" alt="" data-transition="boxRandom" data-thumb="user_uploads/files/deals_virtual_store_images/<?php echo $row_Rs_GetItemDetails['GallaryImage3']; ?>"/>
             <?php } ?>
             
             <?php 
			 if(isset($row_Rs_GetItemDetails['GallaryImage4']) && $row_Rs_GetItemDetails['GallaryImage4']!="none.jpg"){
			 ?>
             <img src="user_uploads/files/deals_virtual_store_images/<?php echo $row_Rs_GetItemDetails['GallaryImage4']; ?>" width="635" height="285" alt="" data-transition="boxRandom" data-thumb="user_uploads/files/deals_virtual_store_images/<?php echo $row_Rs_GetItemDetails['GallaryImage4']; ?>"/>
             <?php } ?>
             
            <?php 
			 if(isset($row_Rs_GetItemDetails['GallaryImage5']) && $row_Rs_GetItemDetails['GallaryImage5']!="none.jpg"){
			 ?>
             <img src="user_uploads/files/deals_virtual_store_images/<?php echo $row_Rs_GetItemDetails['GallaryImage5']; ?>" width="635" height="285" alt="" data-transition="boxRandom" data-thumb="user_uploads/files/deals_virtual_store_images/<?php echo $row_Rs_GetItemDetails['GallaryImage5']; ?>"/>
             <?php } ?>
             
                          <?php 
			 if(isset($row_Rs_GetItemDetails['GallaryImage6']) && $row_Rs_GetItemDetails['GallaryImage6']!="none.jpg"){
			 ?>
             <img src="user_uploads/files/deals_virtual_store_images/<?php echo $row_Rs_GetItemDetails['GallaryImage6']; ?>" width="635" height="285" alt="" data-transition="boxRandom" data-thumb="user_uploads/files/deals_virtual_store_images/<?php echo $row_Rs_GetItemDetails['GallaryImage6']; ?>"/>
             <?php } ?>
             

                    </div>
              </div>
  		</div>
                <!-- End of Nivo Slider Image List -->
                
                </div>
                <!-- End of item_image -->
                    <form method="GET" action="?InvItemID=<?php echo $_GET['InvItemID']; ?>" name="form11" id="form11">
<input name="InvItemID" type="hidden" id="ItemID" size="3"  value="<?php echo $row_Rs_GetItemDetails['VSInvItemCode']; ?>"/> 
                     <input name="Quantity" type="text" size="5" maxlength="5" value="1">
                     <input name="ItemCartType" type="hidden" size="5" maxlength="5" value="VirtualStore"> 
                    <input name="btnAddToCart" type="submit" value="Add to cart" id="btnAddToCart"> 
                </form>
            
         
                 
            </div><!-- End of vs_item_add_to_cart_wrapper -->
 

       		<div class="vs_item_description">
              <?php echo $row_Rs_GetItemDetails['VSInvItemDescription']; ?>
        	</div><!-- End of vs_item_details -->
            
    </div>

<!-- End of vs_item -->

<script type="text/javascript" charset="utf-8">
 $(document).ready(function() {
/*
 
 var liftoff = new Date();
    liftoff = new Date(liftoff.getFullYear(), liftoff.getMonth(), liftoff.getDate(), 17, 0, 0);

*/
 var UntilDate = new Date(<?php 
		  echo $UntilDate; 	
	 ?>); 
 var NewUntilDate=new Date(UntilDate.getFullYear(), UntilDate.getMonth()-1, UntilDate.getDate(), 0, 0, 0);
//alert(newYear);
$('#DealsCountDownTimer').countdown({since: NewUntilDate ,compact: true,format: 'dHMS'}); 
});
</script> 
<script type="text/javascript" src="scripts/nivo-slider/jquery.nivo.slider.pack.js"></script>
    <script type="text/javascript">
    $(window).load(function() {
        //$('#slider').nivoSlider();  // Defualt Behaviour
		    $('#slider').nivoSlider({
				effect: 'fade',
				controlNav: false,
				//controlNavThumbs:false
             });
    });
</script>
<?php
// This will Incldude the Code to Enable the Simple Form to Act as Ajax Form
//require_once("scripts/jquery_forms_ajax/jquery_form_include_in_each_page.php"); 
mysql_free_result($Rs_GetItemDetails);
?>

