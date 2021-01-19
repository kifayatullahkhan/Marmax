<?php 
if(file_exists('Connections/Conn.php')){ require_once('Connections/Conn.php'); }else
if(file_exists('../Connections/Conn.php')){ require_once('../Connections/Conn.php'); }else
if(file_exists('../../Connections/Conn.php')){ require_once('../../Connections/Conn.php'); }

	require_once("../global_configurations_and_functions/global_functions.php");
require_once("../global_configurations_and_functions/global_define_constants.php");
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$StatusMessage=""; // This varible will hold the message which will be displayed to the User according to his actions , Update, delte save etc.

$UserName="";
if (isset($_SESSION['MM_Username']) && isset($_POST['Username'])) {
 // $UserName = $_SESSION['MM_Username'];
 $UserName =$_POST['Username'];
}
$editFormAction = $_SERVER['PHP_SELF'];
/* if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
} */

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "frmPasswordChange")) {
	
	$Password_new=$_POST['Password_new'];
	
	
	/* 
	
	
	*/
	
	$colname_rs_get_user_password = "-1";
	if (isset($_SESSION['MM_Username'])) {
	  $colname_rs_get_user_password = $_SESSION['MM_Username'];
	}
	mysql_select_db($database_Conn, $Conn);
	$query_rs_get_user_password = sprintf("SELECT Username, Password FROM user_accounts WHERE Username = %s", GetSQLValueString($colname_rs_get_user_password, "text"));
	$rs_get_user_password = mysql_query($query_rs_get_user_password, $Conn) or die(mysql_error());
	$row_rs_get_user_password = mysql_fetch_assoc($rs_get_user_password);
	$totalRows_rs_get_user_password = mysql_num_rows($rs_get_user_password);
	if ($totalRows_rs_get_user_password>0) {		
	// -- =====================UPDATE THE PASSWORD=================================================== --
		  $updateSQL = sprintf("UPDATE user_accounts SET Password=%s WHERE Username=%s",
							   GetSQLValueString($Password_new, "text"),
							   GetSQLValueString($UserName, "text"));
		
		  mysql_select_db($database_Conn, $Conn);
		  $Result1 = mysql_query($updateSQL, $Conn) or die(mysql_error());
		  ZorkifMessageBox("Password Changed  Successfully");
	}else{
	   	  ZorkifMessageBox("Failed Attempt: Password could not be changed due to wrong old password or both new and confirm passwords does not mactches");		
		}
}



$currentPage = $_SERVER["PHP_SELF"];

$SearchText="";
if(isset($_POST['SearchText']) && $_POST['SearchText']!="") {
   $SearchText=" WHERE Username LIKE'" .$_POST['SearchText']  ."%'";
}else	
	if(isset($_GET['SearchText']) && $_GET['SearchText']!="") {
	   $SearchText=" WHERE Username LIKE'" .$_GET['SearchText']  ."%'";
	}

$maxRows_rs_get_user_accounts = 10;
$pageNum_rs_get_user_accounts = 0;
if (isset($_GET['pageNum_rs_get_user_accounts'])) {
  $pageNum_rs_get_user_accounts = $_GET['pageNum_rs_get_user_accounts'];
}
$startRow_rs_get_user_accounts = $pageNum_rs_get_user_accounts * $maxRows_rs_get_user_accounts;

mysql_select_db($database_Conn, $Conn);
$query_rs_get_user_accounts = "SELECT * FROM user_accounts  $SearchText ORDER BY Username ASC";
$query_limit_rs_get_user_accounts = sprintf("%s LIMIT %d, %d", $query_rs_get_user_accounts, $startRow_rs_get_user_accounts, $maxRows_rs_get_user_accounts);
$rs_get_user_accounts = mysql_query($query_limit_rs_get_user_accounts, $Conn) or die(mysql_error());
$row_rs_get_user_accounts = mysql_fetch_assoc($rs_get_user_accounts);

if (isset($_GET['totalRows_rs_get_user_accounts'])) {
  $totalRows_rs_get_user_accounts = $_GET['totalRows_rs_get_user_accounts'];
} else {
  $all_rs_get_user_accounts = mysql_query($query_rs_get_user_accounts);
  $totalRows_rs_get_user_accounts = mysql_num_rows($all_rs_get_user_accounts);
}
$totalPages_rs_get_user_accounts = ceil($totalRows_rs_get_user_accounts/$maxRows_rs_get_user_accounts)-1;

mysql_select_db($database_Conn, $Conn);
$query_rs_get_groups = "SELECT * FROM user_groups ORDER BY GroupName ASC";
$rs_get_groups = mysql_query($query_rs_get_groups, $Conn) or die(mysql_error());
$row_rs_get_groups = mysql_fetch_assoc($rs_get_groups);
$totalRows_rs_get_groups = mysql_num_rows($rs_get_groups);

$queryString_rs_get_user_accounts = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rs_get_user_accounts") == false && 
        stristr($param, "totalRows_rs_get_user_accounts") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rs_get_user_accounts = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rs_get_user_accounts = sprintf("&totalRows_rs_get_user_accounts=%d%s", $totalRows_rs_get_user_accounts, $queryString_rs_get_user_accounts);
?>

<h3 id="why">Change User's Password  </h3>
<br />
<div align="center"  class="DataEntryView">
  <form action="<?php echo $editFormAction; ?>" method="post" name="frmPasswordChange" id="frmPasswordChange">
    <table width="100%" align="center" cellpadding="5" cellspacing="5">
      <tr valign="baseline">
        <td nowrap="nowrap">Username:</td>
        <td>New Password:</td>
        <td>&nbsp;</td>
      </tr>
      <tr valign="baseline">
        <td width="25%" nowrap="nowrap"><input name="Username" type="text" id="Username" value="<?php echo $row_rs_get_user_accounts['Username']; ?>" size="32" /></td>
        <td width="25%"><input name="Password_new" type="password" id="Password_new" value="" size="32" /></td>
        <td width="77%"><input type="submit" value="Change Password" /></td>
      </tr>
    </table>
    <input type="hidden" name="MM_update" value="frmPasswordChange" />
  </form>
</div>

<div id="searchBox">
  <form id="frmSearch" name="frmSearch" method="post" action="<?php echo $currentPage; ?>">
    <label for="SearchText">Enter Username to Search</label>
    <input type="text" name="SearchText" id="SearchText" />
    <input type="submit" name="button" id="button" value="Search" />
    (Do blank search to show all records)
  </form>
  <script> 
// prepare the form when the DOM is ready 
$(document).ready(function() { 
    var options = { 
        target:        '#SecondColumnContents',   // target element(s) to be updated with server response 
        beforeSubmit:  showRequest,  // pre-submit callback 
        success:       showResponse  // post-submit callback 
 
        // other available options: 
        //url:       url         // override for form's 'action' attribute 
        //type:      type        // 'get' or 'post', override for form's 'method' attribute 
        //dataType:  null        // 'xml', 'script', or 'json' (expected server response type) 
        //clearForm: true        // clear all form fields after successful submit 
        //resetForm: true        // reset the form after successful submit 
 
        // $.ajax options can be used here too, for example: 
        //timeout:   3000 
    }; 
 
    // bind form using 'ajaxForm' 
    $('#frmPasswordChange').ajaxForm(options); 
	$('#frmSearch').ajaxForm(options); 
	
}); 
 
// pre-submit callback 
function showRequest(formData, jqForm, options) { 
    // formData is an array; here we use $.param to convert it to a string to display it 
    // but the form plugin does this for you automatically when it submits the data 
    var queryString = $.param(formData); 
 
    // jqForm is a jQuery object encapsulating the form element.  To access the 
    // DOM element for the form do this: 
    // var formElement = jqForm[0]; 
 
    //The Following Is Disabled By Kifayat 
    //alert('About to submit: \n\n' + queryString); 
 
    // here we could return false to prevent the form from being submitted; 
    // returning anything other than false will allow the form submit to continue 
    return true; 
} 
 
// post-submit callback 
function showResponse(responseText, statusText, xhr, $form)  { 
    // for normal html responses, the first argument to the success callback 
    // is the XMLHttpRequest object's responseText property 
 
    // if the ajaxForm method was passed an Options Object with the dataType 
    // property set to 'xml' then the first argument to the success callback 
    // is the XMLHttpRequest object's responseXML property 
 
    // if the ajaxForm method was passed an Options Object with the dataType 
    // property set to 'json' then the first argument to the success callback 
    // is the json data object returned by the server 
 
       //The Following Is Disabled By Kifayat 
    // alert('status: ' + statusText + '\n\nresponseText: \n' + responseText + 
    //    '\n\nThe output div should have already been updated with the responseText.'); 
} 

 
$(function() {
   // all links in the div called "SecondColumnContents"
   $("#SecondColumnContents a").autoajax()
  })
  


    </script> 
</div>

<br />
<br />
<div class="DetailView">
  <table width="643" border="0" cellpadding="5" cellspacing="5" >
    <tr  class="DarkHeaderRow"  >
      
      <th width="14%">Username</th>
      <th width="14%">Password</th>
      <th width="14%">First Name</th>
      <th width="12%">City</th>
      <th width="12%">Email</th>
    </tr>
    <?php do { ?>
      <tr>
        <td><?php echo $row_rs_get_user_accounts['Username']; ?></td>
        <td><?php echo $row_rs_get_user_accounts['Password']; ?></td>
        <td><?php echo $row_rs_get_user_accounts['FirstName']; ?></td>
        <td><?php echo $row_rs_get_user_accounts['City']; ?></td>
        <td><?php echo $row_rs_get_user_accounts['Email']; ?></td>
      </tr>
      <?php } while ($row_rs_get_user_accounts = mysql_fetch_assoc($rs_get_user_accounts)); ?>
    </table>
</div>
<?php
 if ($totalPages_rs_get_user_accounts>0){
?>
<div align="center">
<table border="0">
  <tr>
    <td><?php if ($pageNum_rs_get_user_accounts > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_rs_get_user_accounts=%d%s", $currentPage, 0, $queryString_rs_get_user_accounts); ?>#SecondColumnContents">First</a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_rs_get_user_accounts > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_rs_get_user_accounts=%d%s", $currentPage, max(0, $pageNum_rs_get_user_accounts - 1), $queryString_rs_get_user_accounts); ?>#SecondColumnContents">Previous</a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_rs_get_user_accounts < $totalPages_rs_get_user_accounts) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_rs_get_user_accounts=%d%s", $currentPage, min($totalPages_rs_get_user_accounts, $pageNum_rs_get_user_accounts + 1), $queryString_rs_get_user_accounts); ?>#SecondColumnContents">Next</a>
        <?php } // Show if not last page ?></td>
    <td><?php if ($pageNum_rs_get_user_accounts < $totalPages_rs_get_user_accounts) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_rs_get_user_accounts=%d%s", $currentPage, $totalPages_rs_get_user_accounts, $queryString_rs_get_user_accounts); ?>#SecondColumnContents">Last</a>
        <?php } // Show if not last page ?></td>
  </tr>
</table>

</div>
<?php
 }
?>



<?php

mysql_free_result($rs_get_user_accounts);

?>
 