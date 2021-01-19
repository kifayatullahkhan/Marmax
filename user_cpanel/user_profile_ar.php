<?php 
$editFormAction = $_SERVER['PHP_SELF'];
 if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

 
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
   $updateSQL = sprintf("UPDATE user_accounts SET FirstName=%s, MiddleNames=%s, LastName=%s, AddressLine1=%s, AddressLine2=%s, City=%s, Country=%s, Phone=%s, Email=%s, ContactNo=%s, Others=%s WHERE Username=%s",
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
$query_rs_getuserprofile = sprintf("SELECT Username,FirstName,MiddleNames,LastName, AddressLine1, AddressLine2, City, Country, Phone, Email, ContactNo, Others, Picture FROM user_accounts WHERE Username = %s", GetSQLValueString($colname_rs_getuserprofile, "text"));
$rs_getuserprofile = mysql_query($query_rs_getuserprofile, $Conn) or die(mysql_error());
$row_rs_getuserprofile = mysql_fetch_assoc($rs_getuserprofile);
$totalRows_rs_getuserprofile = mysql_num_rows($rs_getuserprofile);
?>
<form action="index.php?page_name=user_profile" method="post" name="form1" id="form1" enctype="multipart/form-data">       
    
<div class="DataEntryForm">
<div class="box_like_section_wrapper">
<h2> User Profile Photo</h2>
<br><br>
<table width="100%" border="0" cellspacing="5" cellpadding="5">
  <tr>
    <td>&nbsp;</td>
    <td><img src="<?php 		 
	if($row_rs_getuserprofile['Picture']!="" && file_exists(VIEW_USERS_PROFILE_PICTURE_FILE_UPLOAD_PATH.$row_rs_getuserprofile['Picture'])==true) {
	echo VIEW_USERS_PROFILE_PICTURE_FILE_UPLOAD_PATH.$row_rs_getuserprofile['Picture'];
	}else{
		echo VIEW_USERS_PROFILE_PICTURE_FILE_UPLOAD_PATH."user-default.png";
	}
	 ?>" alt="User's Picture" width="153" height="117" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="file" name="Attachments" id="Attachments"/></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="button" id="button" value="&nbsp;Upload&nbsp; &amp; &nbsp;Save&nbsp;" class="button_misbah"/></td>
    <td>&nbsp;</td>
  </tr>
</table>
<input type="hidden" name="frmUploadPicture" value="1" />
<br><br>

	 
	</div>
 </div>    
     
<div class="DataEntryForm">
<div class="box_like_section_wrapper">
<h2>Basic Information</h2>  
<table width="100%" border="0" cellspacing="5" cellpadding="5">
  <tr>
    <td align="right">First Name</td>
  </tr>
  <tr>
    <td align="right"><input type="text" name="FirstName" value="<?php echo $row_rs_getuserprofile['FirstName']; ?>" size="32" /></td>
    </tr>
      <tr>
    <td align="right">Middle Names</td>
  </tr>
  <tr>
    <td align="right"><input type="text" name="MiddleNames" value="<?php echo $row_rs_getuserprofile['MiddleNames']; ?>" size="32" /></td>
    </tr>
     <tr>
    <td align="right">Last Name</td>
  </tr>
  <tr>
    <td align="right"><input type="text" name="LastName" value="<?php echo $row_rs_getuserprofile['LastName']; ?>" size="32" /></td>
    </tr>
    
    
    
    
  <tr>
    <td align="right">Email</td>
  </tr>
  <tr>
    <td align="right"><input type="text" name="Email" value="<?php echo htmlentities($row_rs_getuserprofile['Email'], ENT_COMPAT, ''); ?>" size="32" /></td>
  </tr>
  <tr>
  </table>
   </div>
  </div>

<div class="DataEntryForm">
<div class="box_like_section_wrapper">
<h2>Contact Information</h2>   
<table width="100%" border="0" cellspacing="5" cellpadding="5">
     
  <tr>
    <td width="50%" align="right">Phone</td>
    <td width="50%" align="right"> Contact Phone No</td>
    </tr>
  <tr>
    <td align="right"><input type="text" name="Phone" value="<?php echo htmlentities($row_rs_getuserprofile['Phone'], ENT_COMPAT, ''); ?>" size="32" /></td>
    <td align="right"><input type="text" name="ContactNo" value="<?php echo htmlentities($row_rs_getuserprofile['ContactNo'], ENT_COMPAT, ''); ?>" size="32" /></td>
  </tr>
  <tr>
    <td align="right"><span class="legend">Address Line1</span></td>
    <td align="right">Address Line 2 </td>
  </tr>
  <tr>
    <td align="right"><input type="text" name="AddressLine1" value="<?php echo htmlentities($row_rs_getuserprofile['AddressLine1'], ENT_COMPAT, ''); ?>" size="32" /></td>
    <td align="right"><input type="text" name="AddressLine2" value="<?php echo htmlentities($row_rs_getuserprofile['AddressLine2'], ENT_COMPAT, ''); ?>" size="32" /></td>
    </tr>
  <tr>
    <td align="right">City</td>
    <td align="right">Country</td>
    </tr>
  <tr>
    <td align="right"><input type="text" name="City" value="<?php echo htmlentities($row_rs_getuserprofile['City'], ENT_COMPAT, ''); ?>" size="32" /></td>
    <td align="right"><input type="text" name="Country" value="<?php echo htmlentities($row_rs_getuserprofile['Country'], ENT_COMPAT, ''); ?>" size="32" /></td>
    </tr>
  <tr>
    <td align="right">Other</td>
    <td align="right">&nbsp;</td>
    </tr>
  <tr>
    <td align="right"><input type="text" name="Others" value="<?php echo htmlentities($row_rs_getuserprofile['Others'], ENT_COMPAT, ''); ?>" size="32" /></td>
    <td align="right"><input type="submit" value="Save Changes" class="button_misbah"/></td>
    </tr>
   </table>
    </div>
 </div>
<input type="hidden" name="MM_update" value="form1" />
<input type="hidden" name="Username" value="<?php echo $row_rs_getuserprofile['Username']; ?>" />
                
</form>
<div id="validate_FirstName" class="validation_message"> </div>
<div id="validate_MiddleNames" class="validation_message"> </div>
<div id="validate_LastName" class="validation_message"> </div> 
<div id="validate_Phone" class="validation_message"> </div> 
<div id="validate_Email" class="validation_message"> </div> 
<div id="validate_ContactNo" class="validation_message"> </div>     
<div id="validate_AddressLine1" class="validation_message"> </div> 
<div id="validate_AddressLine2" class="validation_message"> </div> 
<div id="validate_City" class="validation_message"> </div> 
<div id="validate_Country" class="validation_message"> </div> 
<div id="validate_Others" class="validation_message"> </div>   

<?php
mysql_free_result($rs_getuserprofile);
?>
