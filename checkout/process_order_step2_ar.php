<?php
/*   =====================================================================  */
/*   This Code will Add The Shipment Details to the Order of a Customer.    */
/*   =====================================================================  */

if (!isset($_SESSION)) {
	@session_start();	
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

 
 


@mysql_select_db($database_Conn, $Conn);
$query_Rs_GetCountryNamesList = "SELECT * FROM country_names ORDER BY CountryID ASC";
@$Rs_GetCountryNamesList = mysql_query($query_Rs_GetCountryNamesList, $Conn) or die(mysql_error());
@$row_Rs_GetCountryNamesList = mysql_fetch_assoc($Rs_GetCountryNamesList);
@$totalRows_Rs_GetCountryNamesList = mysql_num_rows($Rs_GetCountryNamesList);

//Initial All Variables

	$ShipmentFirstName           =isset($_SESSION['ShipmentFirstName'])?$_SESSION['ShipmentFirstName']:"";
	$ShipmentLastName            =isset($_SESSION['ShipmentLastName'])?$_SESSION['ShipmentLastName']:"";
	$ShipmentAddressLine1        =isset($_SESSION['ShipmentAddressLine1'])?$_SESSION['ShipmentAddressLine1']:"";
	$ShipmentAddressLine2        =isset($_SESSION['ShipmentAddressLine2'])?$_SESSION['ShipmentAddressLine2']:"";
	$ShipmentCity                =isset($_SESSION['ShipmentCity'])?$_SESSION['ShipmentCity']:"";
	$ShipmentCountryID           =isset($_SESSION['ShipmentCountryID'])?$_SESSION['ShipmentCountryID']:"";
	$ShipmentPhone               =isset($_SESSION['ShipmentPhone'])?$_SESSION['ShipmentPhone']:"";
	$ShipmentEmail               =isset($_SESSION['ShipmentEmail'])?$_SESSION['ShipmentEmail']:"";
	$ShipmentCompanyNameIfAny    =isset($_SESSION['ShipmentCompanyNameIfAny'])?$_SESSION['ShipmentCompanyNameIfAny']:"";
	$ShipmentShipmentMethod      =isset($_SESSION['ShipmentShipmentMethod'])?$_SESSION['ShipmentShipmentMethod']:"";;
	$ShipmentIsBusinessAddress   =isset($_SESSION['ShipmentIsBusinessAddress'])?$_SESSION['ShipmentIsBusinessAddress']:"";

if ((isset($_POST["checkout_process"])) && ($_POST["checkout_process"] == "SHIPMENTDETAILS")) {
  
	$ShipmentFirstName           =$_SESSION['ShipmentFirstName']=isset($_POST['FirstName'])?$_POST['FirstName']:"";
	$ShipmentLastName            =$_SESSION['ShipmentLastName']=isset($_POST['LastName'])?$_POST['LastName']:"";
	$ShipmentAddressLine1        =$_SESSION['ShipmentAddressLine1']=isset($_POST['AddressLine1'])?$_POST['AddressLine1']:"";
	$ShipmentAddressLine2        =$_SESSION['ShipmentAddressLine2']=isset($_POST['AddressLine2'])?$_POST['AddressLine2']:"";
	$ShipmentCity                =$_SESSION['ShipmentCity']=isset($_POST['City'])?$_POST['City']:"";
	$ShipmentCountryID           =$_SESSION['ShipmentCountryID']=isset($_POST['CountryID'])?$_POST['CountryID']:"";
	$ShipmentPhone               =$_SESSION['ShipmentPhone']=isset($_POST['Phone'])?$_POST['Phone']:"";;
	$ShipmentEmail               =$_SESSION['ShipmentEmail']=isset($_POST['Email'])?$_POST['Email']:"";;
	$ShipmentCompanyNameIfAny    =$_SESSION['ShipmentCompanyNameIfAny']=isset($_POST['CompanyNameIfAny'])?$_POST['CompanyNameIfAny']:""; 
	$ShipmentShipmentMethod      =$_SESSION['ShipmentShipmentMethod']=isset($_POST['ShipmentMethod'])?$_POST['ShipmentMethod']:""; 
	$ShipmentIsBusinessAddress   =$_SESSION['ShipmentIsBusinessAddress']=isset($_POST['IsBusinessAddress'])?$_POST['IsBusinessAddress']:""; 
 
 
    // Now Jump to Next Order Process Step by Loading the next Page.
	@header("Location: checkout_step3.php");
	
}
  // End of Redirect to Step 4

?>
<!-- Start of Checkout Order Summery -->
<?php require_once("checkout/checkout_order_summery_ar.php"); ?>
<!-- End of Checkout Order Summer -->
<div id="checkout_data_entry_sections"  class="DataEntryForm">
  <form action="checkout_step2.php" method="post" name="frmAddShipmentDetails" id="frmAddShipmentDetails">
    <div class="box_like_section_wrapper">
    <h2>معلومات الاتصال</h2>
   	  <p>&nbsp; </p>
    <table width="100%" align="center">
      <tr valign="baseline">
        <td><input type="text" name="FirstName" id="FirstName2" value="<?php echo $ShipmentFirstName; ?>" size="32" placeholder="الاسم الاول"/></td>
        <div id="FirstName1Validation" class="validation_message"> </div>
        <td><input name="LastName" type="text" id="LastName2" value="<?php echo $ShipmentLastName; ?>" size="32" placeholder="الاسم الاخير" /></td>
      	<div id="LastName1Validation" class="validation_message"> </div>
      </tr>
      <tr valign="baseline">
        <td><input type="text" name="Phone" id="Phone2" value="<?php echo $ShipmentPhone; ?>" size="32" placeholder="رقم جوال" /></td>
        <div id="PhoneValidation" class="validation_message"> </div>
        <td><input type="text" name="Email" id="Email2" value="<?php echo $ShipmentEmail; ?>" size="32" placeholder="البريد الالكتروني"/></td>
      </tr>
     </table>
	<p>&nbsp; </p>
     </div>
    <div class="box_like_section_wrapper">
    <h2>عنوان التوصيل</h2>
    <p>&nbsp;</p>
    <table width="100%" align="center">
      <tr valign="baseline">
        <td width="50%"><input type="text" name="AddressLine1" id="AddressLine2" value="<?php echo $ShipmentAddressLine1; ?>" size="32"  placeholder="العنوان الاول"/></td>
        <div id="AddressLine1Validation" class="validation_message"> </div>
        <td width="50%"><input type="text" name="AddressLine2" value="<?php echo $ShipmentAddressLine2; ?>" size="32"  placeholder="العنوان الثاني"/></td>
      </tr>
      <tr valign="baseline">
        <td><input type="text" name="City" id="City2" value="<?php echo $ShipmentCity; ?>" size="32"  placeholder="المدينة" /></td>
        <div id="CityValidation" class="validation_message"> </div>
        <td><div class="select_combo">
          <select name="CountryID" class="SelectBox">
            <?php 
do {  
?>
            <option value="<?php echo $row_Rs_GetCountryNamesList['CountryID']?>" <?php if (!(strcmp($row_Rs_GetCountryNamesList['CountryID'], $ShipmentCountryID))) {echo "SELECTED";} ?>><?php echo $row_Rs_GetCountryNamesList['CountryName']?></option>
            <?php
} while ($row_Rs_GetCountryNamesList = mysql_fetch_assoc($Rs_GetCountryNamesList));
?>
          </select>
        </div></td>
      </tr>
      <tr valign="baseline">
        <td><input type="text" name="CompanyNameIfAny" value="<?php echo $ShipmentCompanyNameIfAny; ?>" size="32"  placeholder="اسم الشركة"/></td>
        <td><input type="checkbox" name="IsBusinessAddress" value="<?php echo $ShipmentIsBusinessAddress; ?>" />
          عنوان عمل </td>
      </tr>
      </table>
          
    <p>&nbsp;</p>
     </div> 
    <div class="box_like_section_wrapper"> 
    <h2>طريقة التوصيل</h2>
    <p>&nbsp;</p>
    <table width="100%" align="center"> 
      <tr valign="baseline">
        <td width="48%"><div class="select_combo">
          <select name="ShipmentMethod" class="SelectBox">
            <option value="Standard Shipment" <?php if (!(strcmp("Standard Shipment", "$ShipmentShipmentMethod"))) {echo "SELECTED";} ?>>التوصيل العام</option>
            <option value="Eramax" <?php if (!(strcmp("Eramax", "$ShipmentShipmentMethod"))) {echo "SELECTED";} ?>>آرامكس</option>
            <option value="FedEx" <?php if (!(strcmp("FedEx", "$ShipmentShipmentMethod"))) {echo "SELECTED";} ?>>فيديكس</option>
            <option value="Van Delivery" <?php if (!(strcmp("Van Delivery", "$ShipmentShipmentMethod"))) {echo "SELECTED";} ?>>Van Delivery</option>
          </select>
        </div></td>
        <td width="52%"><input name="btnNext" type="submit" id="btnNext" value="التالي" class="button_misbah"/></td>
      </tr>
    </table>
        <p>&nbsp;</p>
</div>
    <input type="hidden" name="checkout_process" value="SHIPMENTDETAILS" />
  </form>
</div>
 
<?php
mysql_free_result($Rs_GetCountryNamesList);
?>

<script type="text/javascript">
 function validate_FirstName(){
	  if( $('#FirstName2').val().length<=0 ) { 
  		$("#FirstNameValidation").removeClass("correct");
  		$("#FirstNameValidation").addClass("incorrect");
		ShowWarningMessage("Please Enter Your First Name");
		return false;
   }else{	
   		$("#FirstNameValidation").removeClass("incorrect");   
		$("#FirstNameValidation").addClass("correct");  
		return true; 
   }// End of If
}
 function validate_LastName(){
	  if( $('#LastName2').val().length<=0 ) { 
  		$("#LastNameValidation").removeClass("correct");
  		$("#LastNameValidation").addClass("incorrect");
		ShowWarningMessage("Please Enter Your Last Name"); 
		return false;
   }else{	
   		$("#LastNameValidation").removeClass("incorrect");   
		$("#LastNameValidation").addClass("correct");  
		return true; 
   }// End of If
}

<!----------Phone ----------->
function validate_Phone(){
	  if( $('#Phone2').val().length<=0 ) { 
  		$("#PhoneValidation").removeClass("correct");
  		$("#PhoneValidation").addClass("incorrect");
		ShowWarningMessage("Please Enter Your Phone Number"); 
		return false;
   }else{	
   		$("#PhoneValidation").removeClass("incorrect");   
		$("#PhoneValidation").addClass("correct");  
		return true; 
   }// End of If
}

<!------------End Phone ---->
function validate_email(){
  if(!isValidEmailAddress( $('#Email2').val() ) ) { 
  		$("#EmailValidation").removeClass("correct");
  		$("#EmailValidation").addClass("incorrect");
		ShowWarningMessage("Please Enter valid Email Address"); 
		return false;
   }else{	
   		$("#UpEmailValidation").removeClass("incorrect");   
		$("#EmailValidation").addClass("correct");   
		return true;
   }// End of If	
}


<!----------Address Line  ----------->
function validate_AddressLine1(){
	  if( $('#AddressLine2').val().length<=0 ) { 
  		$("#AddressLineValidation1").removeClass("correct");
  		$("#AddressLineValidation").addClass("incorrect");
		ShowWarningMessage("Please Enter Your Address");
		return false;
   }else{	
   		$("#AddressLineValidation").removeClass("incorrect");   
		$("#AddressLineValidation").addClass("correct");  
		return true; 
   }// End of If
}

<!------------End Address Line ---->

<!----------City  ----------->
function validate_City(){
	  if( $('#City2').val().length<=0 ) { 
  		$("#CityValidation").removeClass("correct");
  		$("#CityValidation").addClass("incorrect");
		ShowWarningMessage("Please Enter Your City Name"); 
		return false;
   }else{	
   		$("#CityValidation").removeClass("incorrect");   
		$("#CityValidation").addClass("correct");  
		return true; 
   }// End of If
}

<!------------End City ---->
<!------------------------------Blur ----------------->

$('#FirstName2').blur(function() {
	validate_FirstName()
	 
});	

$('#LastName2').blur(function() {
	
	validate_LastName()
	
});
$('#Phone2').blur(function() {

	validate_Phone();
	

});

$('#Email2').blur(function() {

	validate_email();
	

});
$('#AddressLine2').blur(function() {
	validate_AddressLine1();
	  

});
// For Password
$('#City2').blur(function() {
	
	 validate_City();
	
}); 

<!-----------------------------End Blur -------------->

 $('#frmAddShipmentDetails').submit(function(e) {   
		/*
		validate_FirstName();
		validate_LastName();
		validate_Phone();
		validate_AddressLine();
		validate_City();
		// All Fields are Valid
		*/
		 if (validate_FirstName() && validate_LastName() && validate_Phone() && validate_email()  && validate_AddressLine1() && validate_City()){
		// All Fields are Valid
		return true;
		}
		else 
		{
        ShowWarningMessage("Please provide full information.");			
		return false;  
		}
})


$(document).ready(function() {


});// End of document ready
</script>      


