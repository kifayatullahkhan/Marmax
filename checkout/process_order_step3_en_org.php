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
 
if ((isset($_POST["checkout_process"])) && ($_POST["checkout_process"] == "PAYONDELIVERY")) {
     $BillingFirstName			=$_SESSION['BillingFirstName']		="";
     $BillingLastName			=$_SESSION['BillingLastName']		="";
     $BillingAddressLine1		=$_SESSION['BillingAddressLine1']	="";
     $BillingAddressLine2		=$_SESSION['BillingAddressLine2']	="";
     $BillingCity				=$_SESSION['BillingCity']			="";
     $BillingCountryID			=$_SESSION['BillingCountryID']		="";
     $BillingPhone				=$_SESSION['BillingPhone']			="";
     $BillingEmail				=$_SESSION['BillingEmail']			="";
     $BillingCreditCardType		=$_SESSION['BillingCreditCardType']	="";
	 $BillingCreditCardNo		=$_SESSION['BillingCreditCardNo']	="";
     $BillingCreditCardExpiryMonth	=$_SESSION['BillingCreditCardExpiryMonth']	="";
	 $BillingCreditCardExpiryYear=$_SESSION['BillingCreditCardExpiryYear']	="";
	 							   $_SESSION['PaymentMethod']	="PAYONDELIVERY";
	    // Now Jump to Next Order Process Step by Loading the next Page.
	@header("Location: checkout_step4_en.php");	
	
}

if ((isset($_POST["checkout_process"])) && ($_POST["checkout_process"] == "BILLINGDETAILS")) {

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
   $_SESSION['PaymentMethod']	="PAYUSINGCARD";
   
    // Now Jump to Next Order Process Step by Loading the next Page.
	@header("Location: checkout_step4_en.php");
 
 
}

@mysql_select_db($database_Conn, $Conn);
$query_RsGetCountryNames = "SELECT * FROM country_names";
@$RsGetCountryNames = mysql_query($query_RsGetCountryNames, $Conn) or die(mysql_error());
@$row_RsGetCountryNames = mysql_fetch_assoc($RsGetCountryNames);
@$totalRows_RsGetCountryNames = mysql_num_rows($RsGetCountryNames);
?>

<!-- Start of Checkout Order Summery -->
<?php require_once("checkout/checkout_order_summery_en.php"); ?>
<!-- End of Checkout Order Summer -->

<div id="checkout_data_entry_sections" class="DataEntryForm">
 <div class="box_like_section_wrapper">
 <form action="checkout_step3_en.php" method="post" name="frmBillingDetails" id="frmPayOnDelivery">
   <h2>Pay On Delivery  </h2>
   <p><strong>Note</strong>: You will be required to pay cash upon the develivery of the Order to your shipment address</p>
   <p>
     <input type="hidden" name="checkout_process" value="PAYONDELIVERY" />
     <input name="btnNextPayOnDelivery" type="submit" id="btnNextPayOnDelivery" value="Next" class="button_misbah" />
     
   </p>
   <p>&nbsp;</p>
 </form>
 </div>
 
 <div class="explaination_note">
 <h1>Or </h1>
 <p>Pay now, and get VIP benefits</p>
 
 </div>
 
<form action="checkout_step3_en.php" method="post" name="frmBillingDetails" id="frmBillingDetails">
    <div class="box_like_section_wrapper">
    <h2>Billing Address</h2>
    <p>&nbsp;</p>
      <table width="100%" align="center">
        <tr valign="baseline">
          <td></td>
          <td></td>
        </tr>
        <tr valign="baseline">
          <td><input type="text" name="FirstName" id="FirstName11" value="<?php echo $BillingFirstName;?>" size="32"  placeholder="FirstName" /></td>
          <div id="FirstName11Validation" class="validation_message"> </div>
          <td><input type="text" name="LastName" id="LastName11" value="<?php echo $BillingLastName;?>" size="32"  placeholder="LastName" /></td>
        	<div id="LastName11Validation" class="validation_message"> </div>
        </tr>
        <tr valign="baseline">
          <td><input type="text" name="AddressLine1" id"AddressLine11" value="<?php echo $BillingAddressLine1;?>" size="32"  placeholder="AddressLine1" /></td>
          <div id="AddressLine11Validation" class="validation_message"> </div>
          <td><input type="text" name="AddressLine2" value="<?php echo $BillingAddressLine2;?>" size="32"  placeholder="AddressLine2" /></td>
        </tr>
        <tr valign="baseline">
          <td><input type="text" name="City" id="City1" value="<?php echo $BillingCity;?>" size="32"  placeholder="City" /></td>
          <div id="City1Validation" class="validation_message"> </div>
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
          <td><input type="text" name="Phone" id="Phone1" value="<?php echo $BillingPhone;?>" size="32"  placeholder="Phone" /></td>
          <div id="Phone1Validation" class="validation_message"> </div>
          <td><input type="text" name="Email" value="<?php echo $BillingEmail;?>" size="32"  placeholder="Email" /></td>
        </tr>
      </table>
      <p>&nbsp;</p>
    </div>

  
      
    <div class="box_like_section_wrapper"> 
    <h2>Billing Card Details</h2>
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
      <td><input type="text" name="CreditCardNo" value="<?php echo $BillingCreditCardNo;?>"   placeholder="Credit Card Number" /></td>
      <td><input type="text" name="CreditCardSecurityCode" value="<?php echo $BillingCreditCardSecurityCode;?>" size="32"  placeholder="Credit Card Security Code" /></td>
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
      <td><input name="CreditCardExpiryYear" type="text" value="<?php echo $BillingCreditCardExpiryYear;?>" id="CreditCardExpiryYear" size="8" placeholder="Expiry Year"/></td>
    </tr>
    <tr valign="baseline">
      <td>&nbsp;</td>
      <td><input name="btnNext" type="submit" id="btnNext" value="Next" class="button_misbah" /></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  </div>
    <input type="hidden" name="checkout_process" value="BILLINGDETAILS" />
     
</form>

</div>
      
 <!-------------------------Validation ----------------------------->
      <script type="text/javascript">

<!------------First Name --------->
 function validate_FirstName11(){
	  if( $('#FirstName11').val().length<=0 ) { 
  		$("#FirstName11Validation").removeClass("correct");
  		$("#FirstName11Validation").addClass("incorrect");
		return false;
   }else{	
   		$("#FirstName11Validation").removeClass("incorrect");   
		$("#FirstName11Validation").addClass("correct");  
		return true; 
   }// End of If
}
<!------------End of First Name --------->

<!------------Last Name --------->
 function validate_LastName11(){
	  if( $('#LastName11').val().length<=0 ) { 
  		$("#LastName11Validation").removeClass("correct");
  		$("#LastName11Validation").addClass("incorrect");
		return false;
   }else{	
   		$("#LastName11Validation").removeClass("incorrect");   
		$("#LastName11Validation").addClass("correct");  
		return true; 
   }// End of If
}
<!------------End od Last Name --------->



<!----------Address Line  ----------->
function validate_AddressLine11(){
	  if( $('#AddressLine11').val().length<=0 ) { 
  		$("#AddressLine11Validation").removeClass("correct");
  		$("#AddressLine11Validation").addClass("incorrect");
		return false;
   }else{	
   		$("#AddressLine11Validation").removeClass("incorrect");   
		$("#AddressLine11Validation").addClass("correct");  
		return true; 
   }// End of If
}

<!------------End Address Line ---->
<!----------City  ----------->
function validate_City1(){
	  if( $('#City1').val().length<=0 ) { 
  		$("#City1Validation").removeClass("correct");
  		$("#City1Validation").addClass("incorrect");
		return false;
   }else{	
   		$("#City1Validation").removeClass("incorrect");   
		$("#City1Validation").addClass("correct");  
		return true; 
   }// End of If
}

<!------------End City ---->


<!----------Phone ----------->
function validate_Phone1(){
	  if( $('#Phone1').val().length<=0 ) { 
  		$("#Phone1Validation").removeClass("correct");
  		$("#Phone1Validation").addClass("incorrect");
		return false;
   }else{	
   		$("#Phone1Validation").removeClass("incorrect");   
		$("#Phone1Validation").addClass("correct");  
		return true; 
   }// End of If
}

<!------------End Phone ---->

 $('#frmBillingDetails').submit(function(e) {   

		/*validate_FirstName1();
		validate_LastName1();
		validate_AddressLine1();
		validate_City();
		validate_Phone();
		*/
		// All Fields are Valid
		if (validate_FirstName11() && validate_LastName11()  && validate_AddressLine11() && validate_City1() && validate_Phone1()){
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



