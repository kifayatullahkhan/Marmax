<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO feed_back (YourName, YourEmail, YourPhone, YourCompany, HowDidYouFindUs, Comments) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['YourName'], "text"),
                       GetSQLValueString($_POST['YourEmail'], "text"),
                       GetSQLValueString($_POST['YourPhone'], "text"),
                       GetSQLValueString($_POST['YourCompany'], "text"),
                       GetSQLValueString($_POST['HowDidYouFindUs'], "text"),
                       GetSQLValueString($_POST['Comments'], "text"));

  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($insertSQL, $Conn) or die(mysql_error());
}
//<form action="<?php echo $editFormAction; >" method="post" name="form1" id="form1">
?>
 <h2><strong>Feedback</strong></h2>
 <div align="center" class="DataEntryView">

<form action="send_feed_back.php" method="post" name="form1" id="form1">
  <table width="100%" align="center">
    <tr valign="baseline">
      <td width="25%" align="right" nowrap="nowrap"><div align="left">Your Name:</div></td>
      <td width="25%"><input type="text" name="YourName" value="" size="32" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td width="25%" align="right" nowrap="nowrap"><div align="left">Your Email:</div></td>
      <td width="25%"><input type="text" name="YourEmail" value="" size="32" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td width="25%" align="right" nowrap="nowrap"><div align="left">Your Phone:</div></td>
      <td width="25%"><input type="text" name="YourPhone" value="" size="32" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td width="25%" align="right" nowrap="nowrap"><div align="left">Your Company:</div></td>
      <td width="25%"><input type="text" name="YourCompany" value="" size="32" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td width="25%" align="right" nowrap="nowrap"><div align="left">How Did You Find Us?</div></td>
      <td width="25%"><input type="text" name="HowDidYouFindUs" value="" size="32" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td width="25%" align="right" valign="top" nowrap="nowrap"><div align="left">Comments:</div></td>
      <td width="25%"><textarea name="Comments" cols="50" rows="5"></textarea></td>
      <td>&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td width="25%" align="right" nowrap="nowrap"><div align="left"></div></td>
      <td width="25%"><input type="submit" value="Send Feedback" />
        <input type="button" name="btnCancel" id="btnCancel" value="Cancel" onclick="window.location.href='<?php echo $_SERVER["PHP_SELF"] ?>';" /></td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
</div>
<p>&nbsp;</p>
