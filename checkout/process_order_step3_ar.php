<?php
if (!isset($_SESSION)) {
	@session_start();	
}

// Initial These Variables;
 	 $BillingFirstName				=isset($_SESSION['BillingFirstName'])?$_SESSION['BillingFirstName']:"";
     $BillingLastName				=isset($_SESSION['BillingLastName'])?$_SESSION['BillingLastName']:"";
     $BillingAddressLine1			=isset($_SESSION['BillingAddressLine1'])?$_SESSION['BillingAddressLine1']:"";
     $BillingAddressLine2			=isset($_SESSION['BillingAddressLine2'])?$_SESSION['BillingAddressLine2']:"";
     $BillingCity					=isset($_SESSION['BillingCity'])?$_SESSION['BillingCity']:"";
     $BillingCountryID				=isset($_SESSION['BillingCountryID'])?$_SESSION['BillingCountryID']:"";
     $BillingPhone					=isset($_SESSION['BillingPhone'])?$_SESSION['BillingPhone']:"";
     $BillingEmail					=isset($_SESSION['BillingEmail'])?$_SESSION['BillingEmail']:"";
     $BillingCreditCardType			=isset($_SESSION['BillingCreditCardType'])?$_SESSION['BillingCreditCardType']:"";
	 $BillingCreditCardNo			=isset($_SESSION['BillingCreditCardNo'])?$_SESSION['BillingCreditCardNo']:"";
     $BillingCreditCardSecurityCode	=isset($_SESSION['BillingCreditCardSecurityCode'])?$_SESSION['BillingCreditCardSecurityCode']:"";
	 $BillingCreditCardExpiryMonth=isset($_SESSION['BillingCreditCardExpiryMonth'])?$_SESSION['BillingCreditCardExpiryMonth']:"";
	 $BillingCreditCardExpiryYear 	=isset($_SESSION['BillingCreditCardExpiryYear'])?$_SESSION['BillingCreditCardExpiryYear']:"";

// Check if the Users Wants to Pay On Delivery
 
if ((isset($_POST["OrderPaymentType"])) && ($_POST["OrderPaymentType"] == "PAYONDELIVERY")) {
     $BillingFirstName			    =$_SESSION['BillingFirstName']		="";
     $BillingLastName			     =$_SESSION['BillingLastName']		 ="";
     $BillingAddressLine1		     =$_SESSION['BillingAddressLine1']	="";
     $BillingAddressLine2		     =$_SESSION['BillingAddressLine2']	="";
     $BillingCity				     =$_SESSION['BillingCity']			="";
     $BillingCountryID			    =$_SESSION['BillingCountryID']		="";
     $BillingPhone				    =$_SESSION['BillingPhone']			="";
     $BillingEmail				    =$_SESSION['BillingEmail']			="";
     $BillingCreditCardType		   =$_SESSION['BillingCreditCardType']	="";
	 $BillingCreditCardNo		     =$_SESSION['BillingCreditCardNo']	  ="";
     $BillingCreditCardExpiryMonth	=$_SESSION['BillingCreditCardExpiryMonth']	="";
	 $BillingCreditCardExpiryYear     =$_SESSION['BillingCreditCardExpiryYear']	="";
 	$OrderPaymentType=$_SESSION['OrderPaymentType']		=isset($_POST['OrderPaymentType'])?$_POST['OrderPaymentType']:"";//
	//Set Order Billing Type to Pay on Delivery	 							 
	    // Now Jump to Next Order Process Step by Loading the next Page.
	@header("Location: checkout_step4.php");	
	
}


if (isset($_POST["OrderPaymentType"]) && ($_POST["OrderPaymentType"] == "BILLINGDETAILS")) {
	   $OrderPaymentType			=$_SESSION['OrderPaymentType']		=isset($_POST['OrderPaymentType'])?$_POST['OrderPaymentType']:"";// Set Order Billing Type
     $BillingFirstName			=$_SESSION['BillingFirstName']		=isset($_POST['FirstName'])?$_POST['FirstName']:"";
     $BillingLastName			=$_SESSION['BillingLastName']		=isset($_POST['LastName'])?$_POST['LastName']:"";
     $BillingAddressLine1		=$_SESSION['BillingAddressLine1']	=isset($_POST['AddressLine1'])?$_POST['AddressLine1']:"";
     $BillingAddressLine2		=$_SESSION['BillingAddressLine2']	=isset($_POST['AddressLine2'])?$_POST['AddressLine2']:"";
     $BillingCity				=$_SESSION['BillingCity']			=isset($_POST['City'])?$_POST['City']:"";$_POST['City'];
     $BillingCountryID			=$_SESSION['BillingCountryID']		=isset($_POST['CountryID'])?$_POST['CountryID']:"";
     $BillingPhone				=$_SESSION['BillingPhone']			=isset($_POST['Phone'])?$_POST['Phone']:"";$_POST['Phone'] ;
     $BillingEmail				=$_SESSION['BillingEmail']			=isset($_POST['Email'])?$_POST['Email']:"";$_POST['Email'] ;
     $BillingCreditCardType		=$_SESSION['BillingCreditCardType']	=isset($_POST['CreditCardType'])?$_POST['CreditCardType']:"";$_POST['CreditCardType'];
	 $BillingCreditCardNo		=$_SESSION['BillingCreditCardNo']	=isset($_POST['CreditCardNo'])?$_POST['CreditCardNo']:"";
     $BillingCreditCardExpiryMonth	=$_SESSION['BillingCreditCardExpiryMonth']	=isset($_POST['CreditCardExpiryMonth'])?$_POST['CreditCardExpiryMonth']:"";
	$BillingCreditCardExpiryYear=$_SESSION['BillingCreditCardExpiryYear']	=isset($_POST['CreditCardExpiryYear'])?$_POST['CreditCardExpiryYear']:"";	
   

    // Now Jump to Next Order Process Step by Loading the next Page.
	@header("Location: checkout_step4.php");
}

@mysql_select_db($database_Conn, $Conn);
$query_RsGetCountryNames = "SELECT * FROM country_names";
@$RsGetCountryNames = mysql_query($query_RsGetCountryNames, $Conn) or die(mysql_error());
@$row_RsGetCountryNames = mysql_fetch_assoc($RsGetCountryNames);
@$totalRows_RsGetCountryNames = mysql_num_rows($RsGetCountryNames);
?>

<!-- Start of Checkout Order Summery -->
<?php require_once("checkout/checkout_order_summery_ar.php"); ?>
<!-- End of Checkout Order Summer -->

<div id="checkout_data_entry_sections" class="DataEntryForm">
 <div class="box_like_section_wrapper">
 <form action="checkout_step3.php" method="post" name="frmPayOnDelivery" id="frmPayOnDelivery">
   <h2>الدفع عند التوصيل </h2>
   <p><strong>ملاحظة  :  </strong>سيتوجب عليك الدفع فقط عند استلام المنتج الى العنوان المرفق</p>
    
     <input type="hidden" name="OrderPaymentType" value="PAYONDELIVERY" />
     <input name="btnNextPayOnDelivery" type="submit" id="btnNextPayOnDelivery" value="التالي" class="button_misbah" />
     
   
   <p>&nbsp;</p>
 </form>
 </div>
 
 <div class="explaination_note">
 <h1>أو </h1>
 <p>ادفع الآن واحصل على ميزات عديدة</p>
 
 </div>
 
<form action="checkout_step3.php" method="POST" name="frmBillingDetails" id="frmBillingDetails">
    <div class="box_like_section_wrapper">
    <h2>معلومات الفاتورة</h2>
    <p>&nbsp;</p>
      <table width="100%" align="center">
        <tr valign="baseline">
          <td></td>
          <td></td>
        </tr>
        <tr valign="baseline">
          <td><input type="text" name="FirstName" id="FirstName3" value="<?php echo $BillingFirstName;?>" size="32"  placeholder="الاسم الأول" /></td>
          <div id="FirstNameValidation" class="validation_message"> </div>
          <td><input type="text" name="LastName" id="LastName3" value="<?php echo $BillingLastName;?>" size="32"  placeholder="الاسم الأخير" /></td>
        	<div id="LastNameValidation" class="validation_message"> </div>
        </tr>
        <tr valign="baseline">
          <td><input type="text" name="AddressLine1" id="AddressLine3" value="<?php echo $BillingAddressLine1;?>" size="32"  placeholder="العنوان الأول" /></td>
          <div id="AddressLineValidation" class="validation_message"> </div>
          <td><input type="text" name="AddressLine2" value="<?php echo $BillingAddressLine2;?>" size="32"  placeholder="العنوان الثاني" /></td>
        </tr>
        <tr valign="baseline">
          <td><input type="text" name="City" id="City3" value="<?php echo $BillingCity;?>" size="32"  placeholder="المدينة" /></td>
          <div id="CityValidation" class="validation_message"> </div>
          <td><div class="select_combo">
            <select name="CountryID" class="SelectBox">
              <?php 
do {  
?>
              <option value="<?php echo $row_RsGetCountryNames['CountryID']?>" <?php if (!(strcmp($row_RsGetCountryNames['CountryID'],  $BillingCountryID))) {echo "SELECTED";} ?> ><?php echo $row_RsGetCountryNames['CountryName']?></option>
              <?php
} while ($row_RsGetCountryNames = mysql_fetch_assoc($RsGetCountryNames));
?>
            </select>
          </div></td>
        </tr>
        <tr valign="baseline">
          <td><input type="text" name="Phone" id="Phone3" value="<?php echo $BillingPhone;?>" size="32"  placeholder="الهاتف" /></td>
         	<div id="PhoneValidation" class="validation_message"> </div>
          <td><input type="text" name="Email" id="Email3" value="<?php echo $BillingEmail;?>" size="32"  placeholder="البريد الالكتروني" /></td>
        	<div id="EmailValidation" class="validation_message"> </div>
        </tr>
      </table>
      <p>&nbsp;</p>
    </div>
      
    <div class="box_like_section_wrapper"> 
    <h2>بطاقة الدفع</h2>
    <p>&nbsp;</p>  
    <table width="100%" align="center">
 
    <tr valign="baseline">
      <td width="50%"><div class="select_combo">
        <select name="CreditCardType" id="CreditCardType" class="SelectBox">
          <option value="Visa" <?php if (!(strcmp("Visa", $BillingCreditCardType))) {echo "selected=\"selected\"";} ?>>Visa</option>
          <option value="MasterCard" <?php if (!(strcmp("MasterCard", $BillingCreditCardType))) {echo "selected=\"selected\"";} ?>>MasterCard</option>
   
          <option value="Discover" <?php if (!(strcmp("Discover", $BillingCreditCardType))) {echo "selected=\"selected\"";} ?>>Discover</option>
    
          <option value="American Express" <?php if (!(strcmp("American Express", $BillingCreditCardType))) {echo "selected=\"selected\"";} ?>>American Express</option>
        </select>
      </div>
        </td>
      <td>&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td><input type="text" name="CreditCardNo" id="CreditCardNo3" value="<?php echo $BillingCreditCardNo;?>"   placeholder="رقم بطاقة الائتمان" /></td>
      <div id="CreditCardNoValidation" class="validation_message"> </div>
      <td><input type="text" name="CreditCardSecurityCode" id="CreditCardSecurityCode3" value="<?php echo $BillingCreditCardSecurityCode;?>" size="32"  placeholder="الرقم السري لبطاقة الائتمان" /></td>
      <div id="CreditCardSecurityCodeValidation" class="validation_message"> </div>
    </tr>
    <tr valign="baseline">
      <td><div class="select_combo">
        <select name="CreditCardExpiryMonth" id="CreditCardExpiryMonth" class="SelectBox">
          <option value="1" <?php if (!(strcmp(1, $BillingCreditCardExpiryMonth))) {echo "selected=\"selected\"";} ?>>January</option>
          <option value="2" <?php if (!(strcmp(2, $BillingCreditCardExpiryMonth))) {echo "selected=\"selected\"";} ?>>February</option>
          <option value="3" <?php if (!(strcmp(3, $BillingCreditCardExpiryMonth))) {echo "selected=\"selected\"";} ?>>March</option>
          <option value="4" <?php if (!(strcmp(4, $BillingCreditCardExpiryMonth))) {echo "selected=\"selected\"";} ?>>April</option>
          <option value="5" <?php if (!(strcmp(5, $BillingCreditCardExpiryMonth))) {echo "selected=\"selected\"";} ?>>May</option>
          <option value="6" <?php if (!(strcmp(6, $BillingCreditCardExpiryMonth))) {echo "selected=\"selected\"";} ?>>June</option>
          <option value="7" <?php if (!(strcmp(7, $BillingCreditCardExpiryMonth))) {echo "selected=\"selected\"";} ?>>July</option>
          <option value="8" <?php if (!(strcmp(8, $BillingCreditCardExpiryMonth))) {echo "selected=\"selected\"";} ?>>August</option>
          <option value="9" <?php if (!(strcmp(9, $BillingCreditCardExpiryMonth))) {echo "selected=\"selected\"";} ?>>September</option>
          <option value="10" <?php if (!(strcmp(10, $BillingCreditCardExpiryMonth))) {echo "selected=\"selected\"";} ?>>October</option>
          <option value="11" <?php if (!(strcmp(11, $BillingCreditCardExpiryMonth))) {echo "selected=\"selected\"";} ?>>November</option>
          <option value="12" <?php if (!(strcmp(12, $BillingCreditCardExpiryMonth))) {echo "selected=\"selected\"";} ?>>December</option>
        </select>
      </div></td>
      <td><input name="CreditCardExpiryYear" id="CreditCardExpiryYear3" type="text" value="<?php echo $BillingCreditCardExpiryYear;?>" id="CreditCardExpiryYear" size="8" placeholder="تاريخ انتهاء الصلاحية"/></td>
   <div id="CreditCardExpiryYearValidation" class="validation_message">
   </div>
    </tr>
    <tr valign="baseline">
      <td>&nbsp;</td>
      <td><input name="btnNext" type="submit" id="btnNext" value="التالي" class="button_misbah" /></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  </div>
    <input type="hidden" name="OrderPaymentType" value="BILLINGDETAILS" />
     
</form>

</div>
 <!-------------------------Validation ----------------------------->
      <script type="text/javascript">

<!------------First Name --------->
 function validate_FirstName(){
	  if( $('#FirstName3').val().length<=0 ) { 
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
<!------------End of First Name --------->

<!------------Last Name --------->
 function validate_LastName(){
	  if( $('#LastName3').val().length<=0 ) { 
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
<!------------End od Last Name --------->

<!----------Start validation Address Line  ----------->
function validate_AddressLine1(){
	  if( $('#AddressLine3').val().length<=0 ) { 
  		$("#AddressLineValidation").removeClass("correct");
  		$("#AddressLineValidation").addClass("incorrect");
		ShowWarningMessage("Please Enter Your Address ");
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
	  if( $('#City3').val().length<=0 ) { 
  		$("#CityValidation").removeClass("correct");
  		$("#CityValidation").addClass("incorrect");
		ShowWarningMessage("Please Enter The City Name");
		return false;
   }else{	
   		$("#CityValidation").removeClass("incorrect");   
		$("#CityValidation").addClass("correct");  
		return true; 
   }// End of If
}

<!------------End City ---->


<!----------Phone validation ----------->
function validate_Phone(){
	  if( $('#Phone3').val().length<=0 ) { 
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
<!----------Email validation ----------->
function validate_Email(){
	  if( $('#Email3').val().length<=0 ) { 
  		$("#EmailValidation").removeClass("correct");
  		$("#EmailValidation").addClass("incorrect");
		ShowWarningMessage("Please Enter Valid Email Address");
		return false;
   }else{	
   		$("#EmailValidation").removeClass("incorrect");   
		$("#EmailValidation").addClass("correct");  
		return true; 
   }// End of If
}
<!------------End Email ---->
<!------------Start validate_CreditCardNo ---->
function validate_CreditCardNo(){
	  if( $('#CreditCardNo3').val().length<=0 ) { 
  		$("#CreditCardNoValidation").removeClass("correct");
  		$("#CreditCardNoValidation").addClass("incorrect");
		ShowWarningMessage("Please Enter Your Credit Card Number");
		return false;
   }else{	
   		$("#CreditCardNoValidation").removeClass("incorrect");   
		$("#CreditCardNoValidation").addClass("correct");  
		return true; 
   }// End of If
}
<!------------End validate_CreditCardNo ---->

<!------------Start validation CreditCard Security ---->
function validate_CreditCardSecurityCode(){
	  if( $('#CreditCardSecurityCode3').val().length<=0 ) { 
  		$("#CreditCardSecurityCodeValidation").removeClass("correct");
  		$("#CreditCardSecurityCodeValidation").addClass("incorrect");
		ShowWarningMessage("Please Enter Credit Card Security Code");
		return false;
   }else{	
   		$("#CreditCardSecurityCodeValidation").removeClass("incorrect");   
		$("#CreditCardSecurityCodeValidation").addClass("correct");  
		return true; 
   }// End of If
}
<!------------End CreditCard Security ------->

<!------------ Start validation CreditCardExpiryYear ----------->
function validate_CreditCardExpiryYear(){
	  if( $('#CreditCardExpiryYear3').val().length<=0 ) { 
  		$("#CreditCardExpiryYearValidation").removeClass("correct");
  		$("#CreditCardExpiryYearValidation").addClass("incorrect");
		ShowWarningMessage("Please Enter Credit Card Expiry Date");
		return false;
   }else{	
   		$("#CreditCardExpiryYearValidation").removeClass("incorrect");   
		$("#CreditCardExpiryYearValidation").addClass("correct");  
		return true; 
   }// End of If
}
<!------------End CreditCardExpiryYear---------->
<!------------------------------Blur ----------------->

$('#FirstName3').blur(function() {
	validate_FirstName()	 
});	

$('#LastName3').blur(function() {	
	validate_LastName()	
});
$('#AddressLine3').blur(function() {	
	validate_AddressLine1()	
});
$('#Phone3').blur(function() {

	validate_Phone();	
});
$('#AddressLine3').blur(function() {
	validate_AddressLine1();
});
// For Password
$('#City3').blur(function() {	
	 validate_City();	
}); 

$('#CreditCardNo3').blur(function() {	
	 validate_CreditCardNo();	
});
$('#CreditCardSecurityCode3').blur(function() {	
	 validate_CreditCardSecurityCode();	
});
$('#CreditCardExpiryYear3').blur(function() {	
	 validate_CreditCardExpiryYear();	
});

<!-----------------------------End Blur -------------->

 $('#frmBillingDetails').submit(function(e) {   

		/*validate_FirstName1();
		validate_LastName1();
		validate_AddressLine1();
		validate_City();
		validate_Phone();
		validate_Email();
		validate_CreditCardNo();
		validate_CreditCardSecurityCode();
		validate_CreditCardExpiryYear();
		*/
		// All Fields are Valid
		if (validate_FirstName() && validate_LastName()  && validate_AddressLine1() && validate_City() && validate_Phone() && validate_Email() && validate_CreditCardNo() && validate_CreditCardSecurityCode() && validate_CreditCardExpiryYear()){
		//if(0){
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

      <!------------------------End Validation -------------------------->
      


<?php
mysql_free_result($RsGetCountryNames);
?>
