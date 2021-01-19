<?php 
if(file_exists('Connections/Conn.php')){ require_once('Connections/Conn.php'); }else
if(file_exists('../Connections/Conn.php')){ require_once('../Connections/Conn.php'); }else
if(file_exists('../../Connections/Conn.php')){ require_once('../../Connections/Conn.php'); }

	require_once("../global_configurations_and_functions/global_functions.php");
require_once("../global_configurations_and_functions/global_define_constants.php");
	
$StatusMessage=""; // This varible will hold the message which will be displayed to the User according to his actions , Update, delte save etc.
$currentPage = $_SERVER["PHP_SELF"];
// Code to verify the Capta Text
  if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
		  require_once('recaptcha-php-1.11/recaptchalib.php');
		  $privatekey = "6LfOG8MSAAAAAFHUr3_DSxqiHEJwibWqJvojlRcU"; // Your Pricarte key from the recapta web site.
		  $resp = recaptcha_check_answer ($privatekey,
										$_SERVER["REMOTE_ADDR"],
										$_POST["recaptcha_challenge_field"],
										$_POST["recaptcha_response_field"]);
		
		  if (!$resp->is_valid) {
			// What happens when the CAPTCHA was entered incorrectly
			$StatusMessage="The CAPTCHA wasn't entered correctly. Go back and try it again.";
		  } else {
			// Your code here to handle a successful verification
						if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
			  $insertSQL = sprintf("INSERT INTO user_accounts (Username, Password, FirstName,MiddleName,LastName, AddressLine1, AddressLine2, City, Country, Phone, Email, ContactNo, Others, GroupID, AccountStatus) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
								   GetSQLValueString($_POST['Username'], "text"),
								   GetSQLValueString($_POST['Password'], "text"),
								   GetSQLValueString($_POST['FirstName'], "text"),
								   GetSQLValueString($_POST['MiddleNames'], "text"),
								   GetSQLValueString($_POST['LastName'], "text"),
								   GetSQLValueString($_POST['AddressLine1'], "text"),
								   GetSQLValueString($_POST['AddressLine2'], "text"),
								   GetSQLValueString($_POST['City'], "text"),
								   GetSQLValueString($_POST['Country'], "text"),
								   GetSQLValueString($_POST['Phone'], "text"),
								   GetSQLValueString($_POST['Email'], "text"),
								   GetSQLValueString($_POST['ContactNo'], "text"),
								   GetSQLValueString($_POST['Others'], "text"),
								  // GetSQLValueString($_POST['GroupID'], "int"),
								   GetSQLValueString(3, "int"),  // User or Internet Users 
								  // GetSQLValueString($_POST['AccountStatus'], "int"));
								   GetSQLValueString(1, "int"));  // 1=Account is Activated by default
			
			  mysql_select_db($database_Conn, $Conn);
			 $Result1 = mysql_query($insertSQL, $Conn) or die(mysql_error());
			
			}
		  }
		  
  }// end of Form Submit Check




?>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<?php
   if(strlen($StatusMessage)>0 ) {
     echo "<div align=\"center\"><br />";
     echo ZorkifMessageBox($StatusMessage);
     echo "<br /></div>";
   }
    ?>
<h3>Register User Account</h3>
<p>User account registration is very simple and requires less than a minute.</p>
<div class="DataEntryView">
  <form action="<?php echo $currentPage ."?ID=registeruser"; ?>" method="post" name="form1" id="form1">
    <table width="100%" align="center" cellpadding="5" cellspacing="5">
      <tr valign="baseline">
        <td nowrap="nowrap" align="right"><div align="left">Username:</div></td>
        <td><span id="sprytextfield1">
          <input type="text" name="Username" value="<?php if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) { echo $_POST['Username']; } ?>" size="20" />
        <span class="textfieldRequiredMsg">*</span></span></td>
        <td align="right" nowrap="nowrap"><div align="left">Address Line1:</div></td>
        <td><span id="sprytextfield6">
          <input type="text" name="AddressLine1" value="<?php if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) { echo $_POST['AddressLine1']; } ?>" size="20" />
        <span class="textfieldRequiredMsg">*</span></span></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right"><div align="left">Password:</div></td>
        <td><span id="sprytextfield2">
          <input type="password" name="Password" value="<?php if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) { echo $_POST['Password']; } ?>" size="20" />
        <span class="textfieldRequiredMsg">*</span></span></td>
        <td align="right" nowrap="nowrap"><div align="left">Address Line2:</div></td>
        <td><span id="sprytextfield7">
          <input type="text" name="AddressLine2" value="<?php if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) { echo $_POST['AddressLine2']; } ?>" size="20" />
        <span class="textfieldRequiredMsg">*</span></span></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right"><div align="left">Full Name:</div></td>
        <td><span id="sprytextfield3">
          <input type="text" name="FirstName" value="<?php if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) { echo $_POST['FirstName']; } ?>" size="20" />
        <span class="textfieldRequiredMsg">*</span></span></td>
        <td align="right" nowrap="nowrap"><div align="left">City:</div></td>
        <td><span id="sprytextfield8">
          <input type="text" name="City" value="<?php if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) { echo $_POST['Username']; } ?>" size="20" />
        <span class="textfieldRequiredMsg">*</span></span></td>
      </tr>
      <tr valign="baseline">
        <td align="right" nowrap="nowrap"><div align="left">Phone:</div></td>
        <td><span id="sprytextfield4">
          <input type="text" name="Phone" value="<?php if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) { echo $_POST['Phone']; } ?>" size="20" />
        <span class="textfieldRequiredMsg">*</span></span></td>
        <td align="right" nowrap="nowrap"><div align="left">Country:</div></td>
        <td><span id="sprytextfield9">
          <input type="text" name="Country" value="<?php if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) { echo $_POST['Country']; } ?>" size="20" />
        <span class="textfieldRequiredMsg">*</span></span></td>
      </tr>
      <tr valign="baseline">
        <td align="right" nowrap="nowrap"><div align="left">Contact No:</div></td>
        <td><span id="sprytextfield5">
          <input type="text" name="ContactNo" value="<?php if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) { echo $_POST['ContactNo']; } ?>" size="20" />
        <span class="textfieldRequiredMsg">*</span></span></td>
        <td align="right" nowrap="nowrap"><div align="left">Email:</div></td>
        <td><span id="sprytextfield10">
          <input type="text" name="Email" value="<?php if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) { echo $_POST['Email']; } ?>" size="20" />
        <span class="textfieldRequiredMsg">*</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
      </tr>
      <tr valign="baseline">
        <td align="right" nowrap="nowrap"><div align="left"></div></td>
        <td></td>
        <td align="right" nowrap="nowrap"><div align="left">Others:</div></td>
        <td><span id="sprytextfield11">
          <input type="text" name="Others" value="<?php if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) { echo $_POST['Others']; } ?>" size="20" />
        <span class="textfieldRequiredMsg">*</span></span></td>
      </tr>
      <tr valign="baseline">
        <td colspan="4" align="center" valign="middle" nowrap="nowrap"><?php
          require_once('recaptcha-php-1.11/recaptchalib.php');
  $publickey = "6LfOG8MSAAAAAAWrkasdATDRUM6B4bJSRsw0s3Vs"; // you got this from the signup page  // You Public Ket
  echo recaptcha_get_html($publickey);
		?></td>
      </tr>
      <tr valign="baseline">
        <td colspan="4" align="center" valign="middle" nowrap="nowrap"><input type="submit" value="Create User Account" />
        <input type="button" name="btnCancel" id="btnCancel" value="Cancel" onclick="window.location.href='<?php echo $_SERVER["PHP_SELF"] ?>';" /></td>
      </tr>
     </table>
    <input type="hidden" name="MM_insert" value="form1" />
  </form>
</div>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {validateOn:["blur"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "none", {validateOn:["blur"]});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "none", {validateOn:["blur"]});
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "none", {validateOn:["blur"]});
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7", "none", {validateOn:["blur"]});
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8", "none", {validateOn:["blur"]});
var sprytextfield9 = new Spry.Widget.ValidationTextField("sprytextfield9", "none", {validateOn:["blur"]});
var sprytextfield10 = new Spry.Widget.ValidationTextField("sprytextfield10", "email", {validateOn:["blur"]});
var sprytextfield11 = new Spry.Widget.ValidationTextField("sprytextfield11", "none", {validateOn:["blur"]});
</script>
