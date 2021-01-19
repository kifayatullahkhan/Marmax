<?php 
$editFormAction = $_SERVER['PHP_SELF'];
 if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

 
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
   $updateSQL = sprintf("UPDATE user_accounts SET FirstName=%s,MiddleNames=%s,LastName=%s AddressLine1=%s, AddressLine2=%s, City=%s, Country=%s, Phone=%s, Email=%s, ContactNo=%s, Others=%s WHERE Username=%s",
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
$query_rs_getuserprofile = sprintf("SELECT Username,FirstName,MiddleNames,LastName AddressLine1, AddressLine2, City, Country, Phone, Email, ContactNo, Others, Picture FROM user_accounts WHERE Username = %s", GetSQLValueString($colname_rs_getuserprofile, "text"));
$rs_getuserprofile = mysql_query($query_rs_getuserprofile, $Conn) or die(mysql_error());
$row_rs_getuserprofile = mysql_fetch_assoc($rs_getuserprofile);
$totalRows_rs_getuserprofile = mysql_num_rows($rs_getuserprofile);
?>
    <div id="data_entry_form" class="round_borders">
    <div class="top_corner"> </div> 
    <div class="contant_wrapper"> 
    
    
    <div id="user_profile">
   
     <form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2" enctype="multipart/form-data">       
         
        
      <fieldset>
     <div id="user_profile_picture"><img src="<?php 
		 
	if($row_rs_getuserprofile['Picture']!="" && file_exists(VIEW_USERS_PROFILE_PICTURE_FILE_UPLOAD_PATH.$row_rs_getuserprofile['Picture'])==true) {
	echo VIEW_USERS_PROFILE_PICTURE_FILE_UPLOAD_PATH.$row_rs_getuserprofile['Picture'];
	}else{
		echo VIEW_USERS_PROFILE_PICTURE_FILE_UPLOAD_PATH."user-default.png";
	}
	 ?>" alt="User's Picture" width="153" height="117" />
     <input type="submit" name="button" id="button" value="&nbsp;Upload&nbsp; &amp; &nbsp;Save&nbsp;" /></div>
    <div id="user_profile_details">
     
      <table width="100%" border="0" cellspacing="10" cellpadding="5">
        <tr>
          <td width="14%"><strong>First Name</strong></td>
          <td width="79%"><?php echo $row_rs_getuserprofile['FirstName']; ?></td>
          <td width="7%">&nbsp;</td>
        </tr>
        <tr>
          <td><strong>City Name</strong></td>
          <td><?php echo $row_rs_getuserprofile['City']; ?></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td></td>
          <td>&nbsp;</td>
        </tr>
        </table>
    </div>
         <div class="file-input">
           <input type="file" name="Attachments" id="Attachments"/>
         </div>
      	   <input type="hidden" name="frmUploadPicture" value="1" />
       </fieldset>
  </form>
     
 <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
    <legend class="legend">User Profile Settings</legend>
      <fieldset> 
       <label>
         Full Name
         <input type="text" name="FirstName" value="<?php echo $row_rs_getuserprofile['FirstName']; ?>" size="32" />
           <div id="validate_FirstName" class="validation_message"> </div>
        </label> 
         <label>
        Middle Names
         <input type="text" name="MiddleNames" value="<?php echo $row_rs_getuserprofile['MiddleNames']; ?>" size="32" />
           <div id="validate_MiddleNames" class="validation_message"> </div>
        </label>
          Last Name
         <input type="text" name="LastName" value="<?php echo $row_rs_getuserprofile['LastName']; ?>" size="32" />
           <div id="validate_LastName" class="validation_message"> </div>
        </label>   
             
            <label>    
             <input type="submit" value="Save Changes" />              
            </label>
      </fieldset> 
      <legend class="legend">Contact Information</legend>
      <fieldset>
            
			<label>
            Phone   
              <input type="text" name="Phone" value="<?php echo htmlentities($row_rs_getuserprofile['Phone'], ENT_COMPAT, ''); ?>" size="32" />
            <div id="validate_Phone" class="validation_message"> </div>
            </label>  
              
             <label>
             Email
              <input type="text" name="Email" value="<?php echo htmlentities($row_rs_getuserprofile['Email'], ENT_COMPAT, ''); ?>" size="32" />
            <div id="validate_Email" class="validation_message"> </div>
            </label>  
              
          
            <label>
            Contact Phone No
              <input type="text" name="ContactNo" value="<?php echo htmlentities($row_rs_getuserprofile['ContactNo'], ENT_COMPAT, ''); ?>" size="32" />
            <div id="validate_ContactNo" class="validation_message"> </div>
            </label>  
             
            <label>    
             <input type="submit" value="Save Changes" />              
            </label>
      </fieldset> 
      <legend class="legend">Address</legend>
      <fieldset> 
          <label>
          Address Line 1
              <input type="text" name="AddressLine1" value="<?php echo htmlentities($row_rs_getuserprofile['AddressLine1'], ENT_COMPAT, ''); ?>" size="32" />
            <div id="validate_AddressLine1" class="validation_message"> </div>
        </label> 
            
            <label>
            Address Line 2
              <input type="text" name="AddressLine2" value="<?php echo htmlentities($row_rs_getuserprofile['AddressLine2'], ENT_COMPAT, ''); ?>" size="32" />
           <div id="validate_AddressLine2" class="validation_message"> </div>
        </label>                             
              
             <label>
              City
              <input type="text" name="City" value="<?php echo htmlentities($row_rs_getuserprofile['City'], ENT_COMPAT, ''); ?>" size="32" />
            <div id="validate_City" class="validation_message"> </div>
            </label>  
               
            <label>
            Country
            <input type="text" name="Country" value="<?php echo htmlentities($row_rs_getuserprofile['Country'], ENT_COMPAT, ''); ?>" size="32" />
            <div id="validate_Country" class="validation_message"> </div>
            </label>  
 
			<label>
            Other
             <input type="text" name="Others" value="<?php echo htmlentities($row_rs_getuserprofile['Others'], ENT_COMPAT, ''); ?>" size="32" />
            <div id="validate_Others" class="validation_message"> </div>
            </label>  
            
            <label>    
             <input type="submit" value="Save Changes" />              
            </label>            
            
          <input type="hidden" name="MM_update" value="form1" />
          <input type="hidden" name="Username" value="<?php echo $row_rs_getuserprofile['Username']; ?>" />
                 </fieldset>
          </form>
     
      
      
      
      
       
          
       
</div>
</div>
 </div>
<?php
mysql_free_result($rs_getuserprofile);
?>
