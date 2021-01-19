<?php 
if(file_exists('Connections/Conn.php')){ require_once('Connections/Conn.php'); }else
if(file_exists('../Connections/Conn.php')){ require_once('../Connections/Conn.php'); }else
if(file_exists('../../Connections/Conn.php')){ require_once('../../Connections/Conn.php'); }

	require_once("../global_configurations_and_functions/global_functions.php");
require_once("../global_configurations_and_functions/global_define_constants.php");
?>
<?php
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

$currentPage = $_SERVER["PHP_SELF"];

$editFormAction = $_SERVER['PHP_SELF'];
/* if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
 */
 if ((isset($_GET['DeleteID'])) && ($_GET['DeleteID'] != "") && (isset($_GET['DeleteID']))) {
  $deleteSQL = sprintf("DELETE FROM erp_departments WHERE DepartmentID=%s",
                       GetSQLValueString($_GET['DeleteID'], "int"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($deleteSQL, $Conn) or die(mysql_error());
}
  

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE erp_departments SET DepartmentName=%s WHERE DepartmentID=%s",
                       GetSQLValueString($_POST['DepartmentName'], "text"),
                       GetSQLValueString($_POST['DepartmentID'], "int"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($updateSQL, $Conn) or die(mysql_error());
}
  
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO erp_departments (DepartmentName) VALUES (%s)",
                       GetSQLValueString($_POST['DepartmentName'], "text"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($insertSQL, $Conn) or die(mysql_error());
}

                   
$colname_Rs_GetSelectedDepartment = "-1";
if (isset($_GET['EditID'])) {
  $colname_Rs_GetSelectedDepartment = $_GET['EditID'];
}
mysql_select_db($database_Conn, $Conn);
$query_Rs_GetSelectedDepartment = sprintf("SELECT * FROM erp_departments WHERE DepartmentID = %s", GetSQLValueString($colname_Rs_GetSelectedDepartment, "int"));
$Rs_GetSelectedDepartment = mysql_query($query_Rs_GetSelectedDepartment, $Conn) or die(mysql_error());
$row_Rs_GetSelectedDepartment = mysql_fetch_assoc($Rs_GetSelectedDepartment);
$totalRows_Rs_GetSelectedDepartment = mysql_num_rows($Rs_GetSelectedDepartment);

mysql_select_db($database_Conn, $Conn);
/* Setting for Searching a Record Based on a Name or Description */
	$SearchText="";
	$SearchByFieldName="DepartmentName";
	if (isset($_POST['SearchText']) && $_POST['SearchText']!="Search Record…") {
	 $SearchText=" WHERE ".$SearchByFieldName ." LIKE '".$_POST['SearchText']."%'";
//$SearchText=$SearchByFieldName ." LIKE %".$_POST['SeaarchText']."%";
}
/*=============================================== */

if(!isset($_POST['SearchText'])){
$query_Rs_GetDepartments = "SELECT * FROM erp_departments ORDER BY DepartmentName ASC";
}
else {
$query_Rs_GetDepartments = "SELECT * FROM erp_departments $SearchText ORDER BY DepartmentName ASC";
}


$Rs_GetDepartments = mysql_query($query_Rs_GetDepartments, $Conn) or die(mysql_error());
$row_Rs_GetDepartments = mysql_fetch_assoc($Rs_GetDepartments);
$totalRows_Rs_GetDepartments = mysql_num_rows($Rs_GetDepartments);


?>

<h3 id="why">Departments List</h3>
<?php if ($totalRows_Rs_GetSelectedDepartment == 0) { // Show if recordset not empty ?>
<div>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
 
      <div align="center" class="DataEntryView">
        <table width="100%" align="center" cellpadding="5" cellspacing="5">
        <tr valign="baseline">
          <td width="50%">Enter New Department Name</td>
          <td width="50%">&nbsp;</td>
        </tr>
        <tr valign="baseline">
          <td><div align="left">
                <input type="text" name="DepartmentName" value="" size="32" />
                
                <input type="submit" value="Save " />
            </div></td>
          <td>&nbsp;</td>
        </tr>
      </table>
  </div>
      <input type="hidden" name="MM_insert" value="form1" />
 
  </form>
</div>
  <?php } // Show if recordset not empty ?>
  
  
 <?php if ($totalRows_Rs_GetSelectedDepartment > 0) { // Show if recordset not empty ?>
 <div>
  <form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
    <table width="100%" align="center">
      <tr valign="baseline">
        <td width="289">Update Department Name</td>
        <td width="289">&nbsp;</td>
      </tr>
      <tr valign="baseline">
        <td><input type="text" name="DepartmentName" value="<?php echo htmlentities($row_Rs_GetSelectedDepartment['DepartmentName'], ENT_COMPAT, ''); ?>" size="32" />
          <input type="submit" value="Save Changes" /></td>
        <td>&nbsp;</td>
      </tr>
      </table>
    <input type="hidden" name="MM_update" value="form2" />
    <input type="hidden" name="DepartmentID" value="<?php echo $row_Rs_GetSelectedDepartment['DepartmentID']; ?>" />
  </form>
  </div>
  <?php } // Show if recordset not empty ?>

    
    <?php if ($totalRows_Rs_GetDepartments > 0) { // Show if recordset not empty ?>
      <div class="DetailView">
        <table width="100%" border="0" cellpadding="5" cellspacing="5">
          <tr>
            <th width="8%" colspan="2">Action</th>
          <th width="92%">DepartmentName</th>
            </tr>
          <?php do { ?>
            <tr>
              <td><a href="<?php echo $editFormAction; ?>?EditID=<?php echo $row_Rs_GetDepartments['DepartmentID']; ?>#SecondColumnContents" onclick="return confirm('Are you sure you want to Edit this record?');"><img src="images/icons/design.gif" alt="Delete" width="16" height="16" /></a></td>
              <td><a href="<?php echo $editFormAction; ?>?DeleteID=<?php echo $row_Rs_GetDepartments['DepartmentID']; ?>#SecondColumnContents" onclick="return confirm('Are you sure you want to Delete this record?');"><img src="images/icons/drop.gif" alt="Delete" width="16" height="16" /></a></td>
              <td><?php echo $row_Rs_GetDepartments['DepartmentName']; ?></td>
            </tr>
            <?php } while ($row_Rs_GetDepartments = mysql_fetch_assoc($Rs_GetDepartments)); ?>
        </table>
      </div>
      <?php } // Show if recordset not empty ?>


<?php if ($totalRows_Rs_GetDepartments == 0) { // Show if recordset empty ?>
    <div align="center" style="color: #FF0000">No result found </div>
  <?php } // Show if recordset empty ?>
<?php
mysql_free_result($Rs_GetDepartments);
?>
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
	<?php if ($totalRows_Rs_GetSelectedDepartment == 0) { // Show if recordset not empty ?>
    $('#form1').ajaxForm(options); 
		<?php } ?>
	
	 <?php if ($totalRows_Rs_GetSelectedDepartment > 0) { // Show if recordset not empty ?>
	$('#form2').ajaxForm(options);
	<?php } ?>
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
@mysql_free_result($Rs_GetSelectedDepartment);
?>
