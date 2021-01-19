<?php 
if(file_exists('Connections/Conn.php')){ require_once('Connections/Conn.php'); }else
if(file_exists('../Connections/Conn.php')){ require_once('../Connections/Conn.php'); }else
if(file_exists('../../Connections/Conn.php')){ require_once('../../Connections/Conn.php'); }

	require_once("../global_configurations_and_functions/global_functions.php");
    require_once("../global_configurations_and_functions/global_define_constants.php");
	
$StatusMessage=""; // This varible will hold the message which will be displayed to the User according to his actions , Update, delte save etc.

//------------ Code to Delete ---------------

if ((isset($_GET['DeleteID'])) && ($_GET['DeleteID'] != "")) {
  $deleteSQL = sprintf("DELETE FROM user_accounts WHERE UserID=%s AND UserID<>1",
                       GetSQLValueString($_GET['DeleteID'], "int"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($deleteSQL, $Conn) or die(mysql_error());
  if ($_GET['DeleteID']==1)
  $StatusMessage="Sorry! Administrator Account Can Not be Deleted";
  else
  $StatusMessage="User Account Deleted Successfully";
}

// ------ End of Delete Code ----------------

$editFormAction = $_SERVER['PHP_SELF'];
/* if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
} */


$currentPage = $_SERVER["PHP_SELF"];

$SearchUsername="";
if(isset($_POST['SearchUsername']) && $_POST['SearchUsername']!="") {
   $SearchUsername="   Username LIKE'" .$_POST['SearchUsername']  ."%' AND ";
}else	
	if(isset($_GET['SearchUsername']) && $_GET['SearchUsername']!="") {
	   $SearchUsername="  Username LIKE'" .$_GET['SearchUsername']  ."%'  AND ";
	}

$maxRows_rs_get_user_accounts = 10;
$pageNum_rs_get_user_accounts = 0;
if (isset($_GET['pageNum_rs_get_user_accounts'])) {
  $pageNum_rs_get_user_accounts = $_GET['pageNum_rs_get_user_accounts'];
}
$startRow_rs_get_user_accounts = $pageNum_rs_get_user_accounts * $maxRows_rs_get_user_accounts;

mysql_select_db($database_Conn, $Conn);
$query_rs_get_user_accounts = "SELECT user_accounts.*,user_groups.GroupName FROM user_accounts,user_groups WHERE $SearchUsername  user_accounts.GroupID=user_groups.GroupID ORDER BY UserID DESC";
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
 

<div id="searchBox">
  <form id="frmSearch" name="frmSearch" method="post" action="<?php echo $currentPage; ?>">
    <label for="SearchUsername">Enter Username to Search</label>
    <input type="text" name="SearchUsername" id="SearchUsername" />
    <input type="submit" name="button" id="button" value="Search"/>
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
<div class="DetailView">
  <table width="100" border="0" cellpadding="5" cellspacing="5">
    <tr class="DarkHeaderRow">
     
      <th colspan="2">Action</th>
      <th width="21%">Username</th>
      <th width="20%">Password</th>
      <th width="19%">Group Name</th>
      <th width="19%">Full Name</th>
      <th width="17%">City</th>
      <th width="17%">Email</th>
    </tr>
    <?php do { ?>
      <tr>
       <td><div align="center"><a href="php_code_files/users_management/user_accounts_view_all.php?DeleteID=<?php echo $row_rs_get_user_accounts['UserID']; ?>#SecondColumnContents" onclick="return confirm('Are you sure you want to delete this record?');"><img src="images/icons/drop.gif" width="16" height="16" alt="Delete" /></a></div></td>
       <td><a href="php_code_files/users_management/user_accounts_edit.php?EditID=<?php echo $row_rs_get_user_accounts['UserID']; ?>#SecondColumnContents" onclick="return confirm('Are you sure you want to Edit this record?');"><img src="images/icons/design.gif" width="16" height="16" alt="Edit" /></a></td>
       <td><?php echo $row_rs_get_user_accounts['Username']; ?></td>
        <td><?php echo $row_rs_get_user_accounts['Password']; ?></td>
        <td><?php echo $row_rs_get_user_accounts['GroupName']; ?></td>
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

mysql_free_result($rs_get_user_accounts);
?>
