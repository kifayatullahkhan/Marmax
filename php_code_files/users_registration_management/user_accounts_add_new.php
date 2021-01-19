<?php 
if(file_exists('Connections/Conn.php')){ require_once('Connections/Conn.php'); }else
if(file_exists('../Connections/Conn.php')){ require_once('../Connections/Conn.php'); }else
if(file_exists('../../Connections/Conn.php')){ require_once('../../Connections/Conn.php'); }

	require_once("../global_configurations_and_functions/global_functions.php");
	require_once("../global_configurations_and_functions/global_define_constants.php");


$editFormAction = $_SERVER['PHP_SELF'];
$currentPage = $_SERVER["PHP_SELF"];

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO user_accounts (Username, Password, FirstName,MiddleNames,LastName, AddressLine1, AddressLine2, City, Country, Phone, Email, ContactNo, Others, GroupID, AccountStatus) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['Username'], "text"),
                       GetSQLValueString($_POST['Password'], "text"),
                       GetSQLValueString($_POST['FirstName'], "text"),
					   GetSQLValueString($_POST['MiddleNames'], "text"),
					   GetSQLValueString($_POST['lastName'], "text"),
                       GetSQLValueString($_POST['AddressLine1'], "text"),
                       GetSQLValueString($_POST['AddressLine2'], "text"),
                       GetSQLValueString($_POST['City'], "text"),
                       GetSQLValueString($_POST['Country'], "text"),
                       GetSQLValueString($_POST['Phone'], "text"),
                       GetSQLValueString($_POST['Email'], "text"),
                       GetSQLValueString($_POST['ContactNo'], "text"),
                       GetSQLValueString($_POST['Others'], "text"),
                       GetSQLValueString($_POST['GroupID'], "int"),
                       GetSQLValueString($_POST['AccountStatus'], "int"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($insertSQL, $Conn) or die(mysql_error());
}
mysql_select_db($database_Conn, $Conn);
$query_rs_get_groups = "SELECT * FROM user_groups ORDER BY GroupName ASC";
$rs_get_groups = mysql_query($query_rs_get_groups, $Conn) or die(mysql_error());
$row_rs_get_groups = mysql_fetch_assoc($rs_get_groups);
$totalRows_rs_get_groups = mysql_num_rows($rs_get_groups);

?>


<h3 id="why">Create User Account </h3>

<div class="DataEntryView">
  <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
    <table width="100%" align="center" cellpadding="0" cellspacing="0">
      <tr valign="baseline">
        <td width="1%" nowrap="nowrap">&nbsp;</td>
        <td width="18%">Username:</td>
        <td width="1%" nowrap="nowrap">&nbsp;</td>
        <td width="18%">Password:</td>
        <td width="1%">&nbsp;</td>
        <td width="61%">Full Name:</td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap">&nbsp;</td>
        <td><input name="Username" type="text" id="Username" value="" size="20"/>
        </td>
        <td nowrap="nowrap">&nbsp;</td>
        <td><input name="Password" type="text" id="Password" value="" size="20" />        </td>
        <td>&nbsp;</td>
        <td><input name="FirstName" type="text" id="FirstName" value="" size="20" /></td>
       </tr>
      <tr valign="baseline">
        <td nowrap="nowrap">&nbsp;</td>
        <td>Address Line1:</td>
        <td nowrap="nowrap">&nbsp;</td>
        <td>Address Line2:</td>
        <td>&nbsp;</td>
        <td>City:</td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap">&nbsp;</td>
        <td><input name="AddressLine1" type="text" id="AddressLine1" value="" size="20" /></td>
        <td nowrap="nowrap">&nbsp;</td>
        <td><input name="AddressLine2" type="text" id="AddressLine2" value="" size="20" /></td>
        <td>&nbsp;</td>
        <td><input name="City" type="text" id="City" value="Riyadh" size="20" /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap">&nbsp;</td>
        <td>Country:</td>
        <td nowrap="nowrap">&nbsp;</td>
        <td>Contact No:</td>
        <td>&nbsp;</td>
        <td>Comments</td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap">&nbsp;</td>
        <td><input name="Country" type="text" id="Country" value="Saudi Arabia" size="20" /></td>
        <td nowrap="nowrap">&nbsp;</td>
        <td><input name="ContactNo" type="text" id="ContactNo" value="" size="20" /></td>
        <td>&nbsp;</td>
        <td><input name="Others" type="text" id="Others" value="N/A" size="20" /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap">&nbsp;</td>
        <td>Phone:</td>
        <td nowrap="nowrap">&nbsp;</td>
        <td>Email</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap">&nbsp;</td>
        <td><input name="Phone" type="text" id="Phone" value="" size="20" /></td>
        <td nowrap="nowrap">&nbsp;</td>
        <td><input name="Email" type="text" id="Email" value="" size="20" /></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap">&nbsp;</td>
        <td>Group Name:</td>
        <td nowrap="nowrap">&nbsp;</td>
        <td>Account Status:</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap">&nbsp;</td>
        <td><select name="GroupID" id="GroupID">
          <?php 
do {  
?>
          <option value="<?php echo $row_rs_get_groups['GroupID']?>" <?php if (!(strcmp($row_rs_get_groups['GroupID'], 7))) {echo "SELECTED";} ?>><?php echo $row_rs_get_groups['GroupName']?></option>
          <?php
} while ($row_rs_get_groups = mysql_fetch_assoc($rs_get_groups));
?>
        </select></td>
        <td nowrap="nowrap">&nbsp;</td>
        <td><select name="AccountStatus" id="AccountStatus">
          <option value="1" <?php if (!(strcmp(1, 1))) {echo "SELECTED";} ?>>Enable</option>
          <option value="0" <?php if (!(strcmp(0, 1))) {echo "SELECTED";} ?>>Disable</option>
        </select></td>
        <td>&nbsp;</td>
        <td><input type="submit" value="Create Account" /></td>
      </tr>
      <tr></tr>
    </table>
    <input type="hidden" name="MM_insert" value="form1" />
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

<?php
@mysql_free_result($rs_get_groups);
?>
