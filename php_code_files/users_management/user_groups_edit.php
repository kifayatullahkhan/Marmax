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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE user_groups SET GroupName=%s, GroupDescription=%s WHERE GroupID=%s",
                       GetSQLValueString($_POST['GroupName'], "text"),
                       GetSQLValueString($_POST['GroupDescription'], "text"),
                       GetSQLValueString($_POST['GroupID'], "int"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($updateSQL, $Conn) or die(mysql_error());
}


$colname_Rs_GetGroupForEdit = "-1";
if (isset($_GET['EditID'])) {
  $colname_Rs_GetGroupForEdit = $_GET['EditID'];
}
mysql_select_db($database_Conn, $Conn);
$query_Rs_GetGroupForEdit = sprintf("SELECT * FROM user_groups WHERE GroupID = %s", GetSQLValueString($colname_Rs_GetGroupForEdit, "int"));
$Rs_GetGroupForEdit = mysql_query($query_Rs_GetGroupForEdit, $Conn) or die(mysql_error());
$row_Rs_GetGroupForEdit = mysql_fetch_assoc($Rs_GetGroupForEdit);
$totalRows_Rs_GetGroupForEdit = mysql_num_rows($Rs_GetGroupForEdit);
?>


<h3 id="why">Update User Groups Details</h3>

<?php if ($totalRows_Rs_GetGroupForEdit > 0) { // Show if recordset not empty ?>
  <div class="DataEntryView">
   
    <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
      <table align="center" width="100%">
        <tr valign="baseline">
          <td>Group Name:</td>
        </tr>
        <tr valign="baseline">
          <td width="78%"><input type="text" name="GroupName" value="<?php echo htmlentities($row_Rs_GetGroupForEdit['GroupName'], ENT_COMPAT, ''); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td>Group Description:</td>
        </tr>
        <tr valign="baseline">
          <td><input type="text" name="GroupDescription" value="<?php echo htmlentities($row_Rs_GetGroupForEdit['GroupDescription'], ENT_COMPAT, ''); ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td><input type="submit" value="Save Changes" />
          <input type="button" name="btnCancel2" id="btnCancel2" value="Cancel" onclick="window.location.href='<?php echo $_SERVER["PHP_SELF"] ?>';" /></td>
        </tr>
      </table>
      <input type="hidden" name="MM_update" value="form2" />
      <input type="hidden" name="GroupID" value="<?php echo $row_Rs_GetGroupForEdit['GroupID']; ?>" />
    </form>
  <script type="text/javascript"> 
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
    $('#form1').ajaxForm(options); 
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

 



    </script> 
  </div>
  <?php } // Show if recordset not empty ?>
<?php
@mysql_free_result($Rs_GetGroupForEdit);
?>