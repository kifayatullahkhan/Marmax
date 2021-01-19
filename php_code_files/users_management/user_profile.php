<?php 
if(file_exists('Connections/Conn.php')){ require_once('Connections/Conn.php'); }else
if(file_exists('../Connections/Conn.php')){ require_once('../Connections/Conn.php'); }else
if(file_exists('../../Connections/Conn.php')){ require_once('../../Connections/Conn.php'); }

	require_once("../global_configurations_and_functions/global_functions.php");
    require_once("../global_configurations_and_functions/global_define_constants.php");
	

$editFormAction = $_SERVER['PHP_SELF'];
 if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

 
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
   $updateSQL = sprintf("UPDATE user_accounts SET FirstName=%s,MiddleNames=%s,LastName=%s, AddressLine1=%s, AddressLine2=%s, City=%s, Country=%s, Phone=%s, Email=%s, ContactNo=%s, Others=%s WHERE Username=%s",
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
                       GetSQLValueString($_SESSION['MM_Username'], "text"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($updateSQL, $Conn) or die(mysql_error());
}
// Process Uoloaded Picture
	if(isset($_POST['frmUploadPicture'])){
		// Process Uploaded File
			if($_FILES['Attachments']['error']<=0) {	 
			$FileName=$_SESSION['MM_Username']."_".date("ldSFYhisA"). "_".basename($_FILES['Attachments']['name']);
			$upload_file_path=USERS_PROFILE_PICTURE_FILE_UPLOAD_PATH.$FileName;
			$temp=$_FILES['Attachments']['tmp_name'];
			move_uploaded_file($temp,$upload_file_path)or die("Can't move file".mysql_error()); 
			 
			 $updateSQL = sprintf("UPDATE user_accounts SET Picture=%s WHERE Username=%s",
						   GetSQLValueString($FileName, "text"),
						   GetSQLValueString($_SESSION['MM_Username'], "text"));
			
			  mysql_select_db($database_Conn, $Conn);
			  $Result1 = mysql_query($updateSQL, $Conn) or die(mysql_error());
			}
		}
// End of Process Uploaded Picture
$colname_rs_getuserprofile = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_rs_getuserprofile = $_SESSION['MM_Username'];
}
mysql_select_db($database_Conn, $Conn);
$query_rs_getuserprofile = sprintf("SELECT Username,FirstName, MiddleNames, LastName, AddressLine1, AddressLine2, City, Country, Phone, Email, ContactNo, Others, Picture FROM user_accounts WHERE Username = %s", GetSQLValueString($colname_rs_getuserprofile, "text"));
$rs_getuserprofile = mysql_query($query_rs_getuserprofile, $Conn) or die(mysql_error());
$row_rs_getuserprofile = mysql_fetch_assoc($rs_getuserprofile);
$totalRows_rs_getuserprofile = mysql_num_rows($rs_getuserprofile);
?>
<script src="../../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<h3 id="why"> User's Profile </h3>
<div align="center" class="DataEntryView">
  <table width="100%" border="0" cellspacing="5" cellpadding="5">
    <tr>
      <td><div align="center" class="DataEntryView">
        <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
          <table width="100%" align="center" cellpadding="5" cellspacing="5">
            <tr valign="baseline" class="DarkHeaderRow">
              <td align="left" valign="middle" nowrap="nowrap">First Name:</td>
              <td align="left" valign="middle">Address Line1:</td>
              <td align="left" valign="middle">Address Line2:</td>
              <td align="left" valign="middle">City:</td>
            </tr>
            <tr valign="baseline">
              <td width="22%" align="left" valign="middle" nowrap="nowrap"><span id="sprytextfield1">
              <input type="text" name="FirstName" value="<?php echo $row_rs_getuserprofile['FirstName']; ?>" size="32" />
              <span class="textfieldRequiredMsg">*</span></span></td>
              <td width="26%" align="left" valign="middle"><span id="sprytextfield2">
              <input type="text" name="AddressLine1" value="<?php echo htmlentities($row_rs_getuserprofile['AddressLine1'], ENT_COMPAT, ''); ?>" size="32" />
              <span class="textfieldRequiredMsg">*</span></span></td>
              <td width="31%" align="left" valign="middle"><span id="sprytextfield3">
              <input type="text" name="AddressLine2" value="<?php echo htmlentities($row_rs_getuserprofile['AddressLine2'], ENT_COMPAT, ''); ?>" size="32" />
              <span class="textfieldRequiredMsg">*</span></span></td>
              <td width="21%" align="left" valign="middle"><span id="sprytextfield4">
              <input type="text" name="City" value="<?php echo htmlentities($row_rs_getuserprofile['City'], ENT_COMPAT, ''); ?>" size="32" />
              </span></td>
              </tr>
            <tr valign="baseline" class="DarkHeaderRow">
              <td align="left" valign="middle" nowrap="nowrap">Country:</td>
              <td align="left" valign="middle">Phone:</td>
              <td align="left" valign="middle">Email:</td>
              <td align="left" valign="middle">Contact No:</td>
              </tr>
            <tr valign="baseline">
              <td align="left" valign="middle" nowrap="nowrap"><span id="sprytextfield5">
              <input type="text" name="Country" value="<?php echo htmlentities($row_rs_getuserprofile['Country'], ENT_COMPAT, ''); ?>" size="32" />
              <span class="textfieldRequiredMsg">*</span></span></td>
              <td align="left" valign="middle"><span id="sprytextfield6">
              <input type="text" name="Phone" value="<?php echo htmlentities($row_rs_getuserprofile['Phone'], ENT_COMPAT, ''); ?>" size="32" />
              <span class="textfieldRequiredMsg">*</span></span></td>
              <td align="left" valign="middle"><span id="sprytextfield7">
              <input type="text" name="Email" value="<?php echo htmlentities($row_rs_getuserprofile['Email'], ENT_COMPAT, ''); ?>" size="32" />
              <span class="textfieldRequiredMsg">*</span></span></td>
              <td align="left" valign="middle"><span id="sprytextfield8">
              <input type="text" name="ContactNo" value="<?php echo htmlentities($row_rs_getuserprofile['ContactNo'], ENT_COMPAT, ''); ?>" size="32" />
              </span></td>
              </tr>
            <tr valign="baseline" class="DarkHeaderRow">
              <td align="left" valign="middle" nowrap="nowrap">Comments:</td>
              <td align="left" valign="middle">&nbsp;</td>
              <td align="left" valign="middle">&nbsp;</td>
              <td align="left" valign="middle">&nbsp;</td>
              </tr>
            <tr valign="baseline">
              <td colspan="3" align="left" valign="middle" nowrap="nowrap"><span id="sprytextfield9">
                <input type="text" name="Others" value="<?php echo htmlentities($row_rs_getuserprofile['Others'], ENT_COMPAT, ''); ?>" size="50" />
                <span class="textfieldRequiredMsg">*</span></span></td>
              <td align="left" valign="middle"><input type="submit" value="Save Changes" />
                <input type="button" name="btnCancel" id="btnCancel" value="Cancel" onclick="window.location.href='<?php echo $_SERVER["PHP_SELF"] ?>';" /></td>
            </tr>
            </table>
          <input type="hidden" name="MM_update" value="form1" />
          <input type="hidden" name="Username" value="<?php echo $row_rs_getuserprofile['Username']; ?>" />
          </form>
      </div></td>
    </tr>
    <tr>
      <td><div align="center" class="DataEntryView">
        <form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2" enctype="multipart/form-data">
          <div class="DataEntryView">
            <table width="153" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="154" height="117"><img src="<?php 
	if($row_rs_getuserprofile['Picture']!="" && file_exists(USERS_PROFILE_PICTURE_FILE_UPLOAD_PATH.$row_rs_getuserprofile['Picture'])==true) {
	echo USERS_PROFILE_PICTURE_FILE_UPLOAD_PATH.$row_rs_getuserprofile['Picture'];
	}else{
		echo USERS_PROFILE_PICTURE_FILE_UPLOAD_PATH."user-default.png";
	}
	 ?>" alt="User's Picture" width="153" height="117" /></td>
                </tr>
              <tr>
                <td height="2" class="small-text"><div align="center">Size:153 x 117 Pixels</div></td>
                </tr>
              </table>
            <div align="center"> Your Profile Picture
              <label for="textfield"></label>
              <input type="file" name="Attachments" id="Attachments" />
              <br />
              <br />
              <input type="submit" name="button" id="button" value="Upload &amp; Save" />
              <input type="hidden" name="frmUploadPicture" value="1" />
              </div>
            <p>&nbsp;</p>
            </div>
          </form>
      </div></td>
    </tr>
  </table>
</div>
<p>&nbsp;</p>
<?php
mysql_free_result($rs_getuserprofile);
?>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5");
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6");
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7");
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8");
var sprytextfield9 = new Spry.Widget.ValidationTextField("sprytextfield9");
</script>
