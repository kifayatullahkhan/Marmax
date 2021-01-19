<?php 
if(file_exists('Connections/Conn.php')){ require_once('Connections/Conn.php'); }else
if(file_exists('../Connections/Conn.php')){ require_once('../Connections/Conn.php'); }else
if(file_exists('../../Connections/Conn.php')){ require_once('../../Connections/Conn.php'); }

	require_once("../global_configurations_and_functions/global_functions.php");
    require_once("../global_configurations_and_functions/global_define_constants.php");
	
$DEFAULT_SYSTEM_GROUP_LIMITED=15;
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}



if ((isset($_GET['DeleteID'])) && ($_GET['DeleteID'] != "")  && ($_GET['DeleteID'] >$DEFAULT_SYSTEM_GROUP_LIMITED)) {
  $deleteSQL = sprintf("DELETE FROM user_groups WHERE GroupID=%s",
                       GetSQLValueString($_GET['DeleteID'], "int"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($deleteSQL, $Conn) or die(mysql_error());
}

mysql_select_db($database_Conn, $Conn);

$query_Rs_GetUserGroups = "SELECT * FROM user_groups ORDER BY GroupID ASC";

$Rs_GetUserGroups = mysql_query($query_Rs_GetUserGroups, $Conn) or die(mysql_error());
$row_Rs_GetUserGroups = mysql_fetch_assoc($Rs_GetUserGroups);
$totalRows_Rs_GetUserGroups = mysql_num_rows($Rs_GetUserGroups);



?>

<h3 id="why">User Groups List</h3>
<?php if ($totalRows_Rs_GetUserGroups > 0) { // Show if recordset not empty ?>
  <div class="DetailView">
    <table width="100%" border="0" cellpadding="5" cellspacing="0">
      <tr class="DarkHeaderRow">
        <th width="17%">Action</th>
        <th width="34%">Group Name</th>
        <th width="49%">Group Description</th>
      </tr>
      <?php do { ?>
        <tr>
          <td>
            
            <?php if ($row_Rs_GetUserGroups['GroupID']>$DEFAULT_SYSTEM_GROUP_LIMITED) { ?>
            <a href="php_code_files/users_management/user_groups_view_all.php?DeleteID=<?php echo $row_Rs_GetUserGroups['GroupID']; ?>#SecondColumnContents" onclick="return confirm('Are you sure you want to delete this record?');"><img src="images/icons/drop.gif" width="16" height="16" alt="Delete" /></a> | <a href="php_code_files/users_management/user_groups_edit.php?EditID=<?php echo $row_Rs_GetUserGroups['GroupID']; ?>#SecondColumnContents" onclick="return confirm('Are you sure you want to Edit this record?');"><img src="images/icons/design.gif" width="16" height="16" alt="Edit" /></a>
            <?php }else{ ?>
            Locked
            <?php } // end of Group ?>          </td>
          <td><?php echo $row_Rs_GetUserGroups['GroupName']; ?></td>
          <td><?php echo $row_Rs_GetUserGroups['GroupDescription']; ?></td>
        </tr>
        <?php } while ($row_Rs_GetUserGroups = mysql_fetch_assoc($Rs_GetUserGroups)); ?>
    </table>
    
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
  <?php } // Show if recordset not empty ?>
<?php if ($totalRows_Rs_GetUserGroups == 0) { // Show if recordset empty ?>
    <div>
      <div align="center" style="color: #FF0000">No result found </div>
  </div>
    <?php } // Show if recordset empty ?>
<?php
mysql_free_result($Rs_GetUserGroups);

?>