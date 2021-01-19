<?php
if (!isset($_SESSION)) {
  session_start();
}
$UserName="";
if (isset($_SESSION['MM_Username'])) {
  $UserName = $_SESSION['MM_Username'];
}
$editFormAction = $_SERVER['PHP_SELF'];
/* if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
} */

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "frmPasswordChange")) {
	
	$Password_new=$_POST['Password_new'];
	$Password_old=$_POST['Password_old'];
	$Password_confirm=$_POST['Password_confirm'];
	
	
	/* 
	
	
	*/
	
	$colname_rs_get_user_password = "-1";
	if (isset($_SESSION['MM_Username'])) {
	  $colname_rs_get_user_password = $_SESSION['MM_Username'];
	}
	mysql_select_db($database_Conn, $Conn);
	$query_rs_get_user_password = sprintf("SELECT Username, Password FROM user_accounts WHERE Username = %s AND Password=%s", GetSQLValueString($colname_rs_get_user_password, "text"),GetSQLValueString($Password_old, "text"));
	$rs_get_user_password = mysql_query($query_rs_get_user_password, $Conn) or die(mysql_error());
	$row_rs_get_user_password = mysql_fetch_assoc($rs_get_user_password);
	$totalRows_rs_get_user_password = mysql_num_rows($rs_get_user_password);
	if ($totalRows_rs_get_user_password>0 && $Password_new==$Password_confirm) {		
	// -- =====================UPDATE THE PASSWORD=================================================== --
		  $updateSQL = sprintf("UPDATE user_accounts SET Password=%s WHERE Username=%s",
							   GetSQLValueString($_POST['Password_confirm'], "text"),
							   GetSQLValueString($UserName, "text"));
		
		  mysql_select_db($database_Conn, $Conn);
		  $Result1 = mysql_query($updateSQL, $Conn) or die(mysql_error());
		  ZorkifMessageBox("Password Changed  Successfully");
	}else{
	   	  ZorkifMessageBox("Failed Attempt: Password could not be changed due to wrong old password or both new and confirm passwords does not mactches","Information");		
		}
}


?>
 

 
  <form action="<?php echo $editFormAction; ?>" method="post" name="frmPasswordChange" id="frmPasswordChange">
  <div class="DataEntryForm">
<div class="box_like_section_wrapper">
<h2>Change User Password</h2>
<br>      
         Current Password<br>
         <input name="Password_old" type="password" id="Password_old" value="" size="32"  accesskey="o" tabindex="1" />
            <div id="validate_old_password" class="validation_message"> </div>
        
   
   
          
         New Password<br>
         <input name="Password_new" type="password" id="Password_new" value="" size="32" accesskey="n" tabindex="2" />
            <div id="validate_new_password" class="validation_message"> </div>
          
   
         
         Confirm New Password<br>
         <input name="Password_confirm" type="password" id="Password_confirm" value="" size="32"  accesskey="c" tabindex="3" />
            <div id="validate_confirm_password" class="validation_message"> </div>
         
        
           
          <input type="submit" value="Change Password" name="btnChangePassword" class="button_misbah"/>
            
       
       <input type="hidden" name="MM_update" value="frmPasswordChange" />
       <br><br>


 </div>
 </div>
  
  </form>
 
 		 