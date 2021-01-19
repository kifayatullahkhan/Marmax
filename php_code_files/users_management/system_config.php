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
  $updateSQL = sprintf("UPDATE company_informaiton SET CompanyName=%s, AddressLine1=%s, AddressLine2=%s, City=%s, Country=%s, Phone=%s, Email=%s, WebSite=%s, ContactPerson=%s WHERE CompanyID=%s",
                       GetSQLValueString($_POST['CompanyName'], "text"),
                       GetSQLValueString($_POST['AddressLine1'], "text"),
                       GetSQLValueString($_POST['AddressLine2'], "text"),
                       GetSQLValueString($_POST['City'], "text"),
                       GetSQLValueString($_POST['Country'], "text"),
                       GetSQLValueString($_POST['Phone'], "text"),
                       GetSQLValueString($_POST['Email'], "text"),
                       GetSQLValueString($_POST['WebSite'], "text"),
                       GetSQLValueString($_POST['ContactPerson'], "text"),
                       GetSQLValueString($_POST['CompanyID'], "int"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($updateSQL, $Conn) or die(mysql_error());
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE system_config SET ShowGalleryLink=%s, ShowDownloadLink=%s, ShowCompanyInformation=%s WHERE Sys_Config_ID=%s",
                       GetSQLValueString(isset($_POST['ShowGalleryLink']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['ShowDownloadLink']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString(isset($_POST['ShowCompanyInformation']) ? "true" : "", "defined","1","0"),
                       GetSQLValueString($_POST['Sys_Config_ID'], "int"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($updateSQL, $Conn) or die(mysql_error());
}

mysql_select_db($database_Conn, $Conn);
$query_Rs_GetCompanyInformation = "SELECT * FROM company_informaiton WHERE CompanyID = 1";
$Rs_GetCompanyInformation = mysql_query($query_Rs_GetCompanyInformation, $Conn) or die(mysql_error());
$row_Rs_GetCompanyInformation = mysql_fetch_assoc($Rs_GetCompanyInformation);
$totalRows_Rs_GetCompanyInformation = mysql_num_rows($Rs_GetCompanyInformation);

mysql_select_db($database_Conn, $Conn);
$query_Rs_GetSystemOption = "SELECT * FROM system_config WHERE Sys_Config_ID = 1";
$Rs_GetSystemOption = mysql_query($query_Rs_GetSystemOption, $Conn) or die(mysql_error());
$row_Rs_GetSystemOption = mysql_fetch_assoc($Rs_GetSystemOption);
$totalRows_Rs_GetSystemOption = mysql_num_rows($Rs_GetSystemOption);

?>
<h3 id="why"> System Configuration </h3>
<div class="DataEntryView">
  <h3>Update Your Comapny Information Here. </h3>
  <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
      <tr valign="baseline">
        <td align="left" nowrap="nowrap">Company's Name:</td>
        <td>Address Line1:</td>
        <td>Address Line2:</td>
        <td>City:</td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="left"><input type="text" name="CompanyName" value="<?php echo htmlentities($row_Rs_GetCompanyInformation['CompanyName'], ENT_COMPAT, ''); ?>" size="32" /></td>
        <td><input type="text" name="AddressLine1" value="<?php echo htmlentities($row_Rs_GetCompanyInformation['AddressLine1'], ENT_COMPAT, ''); ?>" size="32" /></td>
        <td><input type="text" name="AddressLine2" value="<?php echo htmlentities($row_Rs_GetCompanyInformation['AddressLine2'], ENT_COMPAT, ''); ?>" size="32" /></td>
        <td><input type="text" name="City" value="<?php echo htmlentities($row_Rs_GetCompanyInformation['City'], ENT_COMPAT, ''); ?>" size="32" /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="left">Country:</td>
        <td>Phone:</td>
        <td>Email:</td>
        <td>Web Site:</td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="left"><input type="text" name="Country" value="<?php echo htmlentities($row_Rs_GetCompanyInformation['Country'], ENT_COMPAT, ''); ?>" size="32" /></td>
        <td><input type="text" name="Phone" value="<?php echo htmlentities($row_Rs_GetCompanyInformation['Phone'], ENT_COMPAT, ''); ?>" size="32" /></td>
        <td><input type="text" name="Email" value="<?php echo htmlentities($row_Rs_GetCompanyInformation['Email'], ENT_COMPAT, ''); ?>" size="32" /></td>
        <td><input type="text" name="WebSite" value="<?php echo htmlentities($row_Rs_GetCompanyInformation['WebSite'], ENT_COMPAT, ''); ?>" size="32" /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="left">Contact Person:</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="left"><input type="text" name="ContactPerson" value="<?php echo htmlentities($row_Rs_GetCompanyInformation['ContactPerson'], ENT_COMPAT, ''); ?>" size="32" /></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><input type="submit" value="Update Company Information" /></td>
      </tr>
    </table>
    <input type="hidden" name="MM_update" value="form1" />
    <input type="hidden" name="CompanyID" value="<?php echo $row_Rs_GetCompanyInformation['CompanyID']; ?>" />
  </form>
</div>
<br />
<div class="DataEntryView">
  <p>Select the following check boxes to change the display behaviour of the following items on the main home page.</p>
  <form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
    <table width="100%" align="center">
      <tr valign="baseline">
        <td width="46%" align="left" nowrap="nowrap">Show Gallery link in the Menu:</td>
        <td width="54%"><input type="checkbox" name="ShowGalleryLink" value=""  <?php if (!(strcmp(htmlentities($row_Rs_GetSystemOption['ShowGalleryLink'], ENT_COMPAT, ''),1))) {echo "checked=\"checked\"";} ?> /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="left">Show Download link in the Menu:</td>
        <td><input type="checkbox" name="ShowDownloadLink" value=""  <?php if (!(strcmp(htmlentities($row_Rs_GetSystemOption['ShowDownloadLink'], ENT_COMPAT, ''),1))) {echo "checked=\"checked\"";} ?> /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="left">Show Company Information At The Bottom Of Every Page:</td>
        <td><input type="checkbox" name="ShowCompanyInformation" value=""  <?php if (!(strcmp(htmlentities($row_Rs_GetSystemOption['ShowCompanyInformation'], ENT_COMPAT, ''),1))) {echo "checked=\"checked\"";} ?> /></td>
      </tr>
      <tr valign="baseline">
        <td colspan="2" align="center" nowrap="nowrap"><input type="submit" value="Update Configuration" /></td>
      </tr>
    </table>
    <input type="hidden" name="MM_update" value="form2" />
    <input type="hidden" name="Sys_Config_ID" value="<?php echo $row_Rs_GetSystemOption['Sys_Config_ID']; ?>" />
  </form>
</div>
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
    $('#form1').ajaxForm(options); 
	$('#form2').ajaxForm(options);
}); 
 
// pre-submit callback 
function showRequest(formData, jqForm, options) { 
    // formData is an array; here we use $.param to convert it to a string to display it 
    // but the form plugin does this for you automatically when it submits the data 
    //var queryString = $.param(formData); 
 
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
<?php

mysql_free_result($Rs_GetCompanyInformation);

mysql_free_result($Rs_GetSystemOption);
?>