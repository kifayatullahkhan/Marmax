<?php 
if (!isset($_SESSION)) {
	session_start();	
}


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


$OrderReferenceNo=$_SESSION['MM_UserID']."-".date('mymds').rand(111, 999);
$OrderStatus="PENDING";
$UserID=$_SESSION['MM_UserID'];
$InsertedOrderID=0;

// Start Shipment Details 
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
// End of Shipment Details

 // Preocess only if not pay on delivery
 //  Also Set the checkout_process Type for next steps

// Start of Billing Details 
	 $OrderPaymentType		       =isset($_SESSION['OrderPaymentType'])?$_SESSION['OrderPaymentType']:$_POST['OrderPaymentType'];
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

?>

<!-- Start of Checkout Order Summery -->
<?php require_once("checkout/checkout_order_summery_ar.php"); ?>
<!-- End of Checkout Order Summer -->

<div id="checkout_data_entry_sections"  class="DataEntryForm">


<form action="checkout_step5.php" method="post" name="frmCompleteOrder" id="frmCompleteOrder">
  <div class="box_like_section_wrapper">
    <h2>معلومات الاتصال</h2>
    <p>&nbsp; </p>
    <table width="100%" align="center">
      <tr valign="baseline">
        <td>الاسم الأول :</td>
        <td>الاسم الأخير :</td>
      </tr>
      <tr valign="baseline">
        <td><?php echo $ShipmentFirstName; ?></td>
        <td><?php echo $ShipmentLastName; ?></td>
      </tr>
      <tr valign="baseline">
        <td>الهاتف :</td>
        <td>البريد الالكتروني :</td>
      </tr>
      <tr valign="baseline">
        <td><?php echo $ShipmentPhone; ?></td>
        <td><?php echo $ShipmentEmail; ?></td>
      </tr>
    </table>
    <p>&nbsp; </p>
  </div>
  <div class="box_like_section_wrapper">
    <h2>معلومات التوصيل</h2>
    <p>&nbsp;</p>
    <table width="100%" align="center">
      <tr valign="baseline">
        <td>العنوان الاول :</td>
        <td>العنوان الثاني :</td>
      </tr>
      <tr valign="baseline">
        <td width="50%"><?php echo $ShipmentAddressLine1; ?></td>
        <td width="50%"><?php echo $ShipmentAddressLine2; ?></td>
      </tr>
      <tr valign="baseline">
        <td>المدينة :</td>
        <td><span class="select_combo">اسم الدولة :</span></td>
      </tr>
      <tr valign="baseline">
        <td><?php echo $ShipmentCity; ?></td>
        <td><div class="select_combo"><?php echo $row_Rs_GetCountryNamesList['CountryID']; ?>
        </div></td>
      </tr>
      <tr valign="baseline">
        <td>اسم الشركة :</td>
        <td>عنوان عمل :</td>
      </tr>
      <tr valign="baseline">
        <td><?php echo $ShipmentCompanyNameIfAny; ?></td>
        <td><?php echo $ShipmentIsBusinessAddress; ?></td>
      </tr>
    </table>
    <p>&nbsp;</p>
  </div>
  <div class="box_like_section_wrapper">
    <h2>طريقة التوصيل </h2>
    <p>&nbsp;</p>
    <table width="100%" align="center">
      <tr valign="baseline">
        <td><span class="select_combo">طريقة التوصيل :</span></td>
        <td>&nbsp;</td>
      </tr>
      <tr valign="baseline">
        <td width="51%"><div class="select_combo"><?php echo $ShipmentShipmentMethod; ?>
        </div></td>
        <td width="49%">&nbsp;</td>
      </tr>
    </table>
    <p>&nbsp;</p>
  </div>

<!-- Start of Billing Details -->
<?php
if(!isset( $_SESSION['OrderPaymentType']) ||  $_SESSION['OrderPaymentType']	!="PAYONDELIVERY") {
 ?>
    <div class="box_like_section_wrapper">
    <h2>عنوان الفاتورة</h2>
    <p>&nbsp;</p>
      <table width="100%" align="center">
        <tr valign="baseline">
          <td></td>
          <td></td>
        </tr>
        <tr valign="baseline">
          <td>الاسم الأول : <?php echo $BillingFirstName;?></td>
          <td>الاسم الأخير : <?php echo $BillingLastName;?></td>
        </tr>
        <tr valign="baseline">
          <td>العنوان الأول : <?php echo $BillingAddressLine1;?></td>
          <td>العنوان الأخير : <?php echo $BillingAddressLine2;?></td>
        </tr>
        <tr valign="baseline">
          <td>المدينة :<?php echo $BillingCity;?></td>
          <td>الدولة : <?php echo  $BillingCountryID;?> </td>
        </tr>
        <tr valign="baseline">
          <td>الهاتف : <?php echo $BillingPhone;?></td>
          <td>البريد الالكتروني : <?php echo $BillingEmail;?></td>
        </tr>
      </table>
      <p>&nbsp;</p>
    </div>
      
    <div class="box_like_section_wrapper"> 
    <h2>معلومات بطاقة الائتمان</h2>
    <p>&nbsp;</p>  
    <table width="100%" align="center">
 
    <tr valign="baseline">
      <td width="50%">نوع البطاقة : <?php echo $BillingCreditCardType; ?>
        </td>
      <td>&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td>رقم البطاقة :<?php echo $BillingCreditCardNo;?></td>
      <td>الرقم السري للبطاقة : <?php echo $BillingCreditCardSecurityCode;?></td>
    </tr>
    <tr valign="baseline">
      <td>شهر الانتهاء : <?php echo $BillingCreditCardExpiryMonth; ?></td>
      <td>سنة الانتهاء : <?php echo $BillingCreditCardExpiryYear;?></td>
    </tr>
    <tr valign="baseline">
      <td>&nbsp;</td>
     
    </tr>
  </table>
  <p>&nbsp;</p>
  </div>
<?php 
}// End of If Statement - -Show the Above region if Payment method is not set to Pay Cash on Delivery $_SESSION['OrderPaymentType']	="PAYONDELIVERY";
?>
  <!-- End of Billing Details -->
    <input type="hidden" name="checkout_process" value="FINISH" />
     <input name="btnNext" type="submit" id="btnNext" value="التالي " class="button_misbah" />
</form>


</div>