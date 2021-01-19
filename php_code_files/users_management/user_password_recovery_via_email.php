<?php 
if(file_exists('Connections/Conn.php')){ require_once('Connections/Conn.php'); }else
if(file_exists('../Connections/Conn.php')){ require_once('../Connections/Conn.php'); }else
if(file_exists('../../Connections/Conn.php')){ require_once('../../Connections/Conn.php'); }

	require_once("../global_configurations_and_functions/global_functions.php");
    require_once("../global_configurations_and_functions/global_define_constants.php");
	
  if(isset($_POST['Username']) && strlen($_POST['Username'])>0) {
	 require_once "user_send_password_recovery_mail.php";
	 
  }else {
?>
<div class="DataEntryView">
<h3 id="why" style="margin:5px;">Password Recovery</h3><br />
<br />

<form action="index.php?ID=sendmepassword" method="post" enctype="multipart/form-data" name="frmpasswordrecovery">
  <div align="center">
    <table width="296" border="0" cellspacing="10" cellpadding="5">
      <tr>
        <th width="266"><div align="center">Enter  username here to reset password</div></th>
      </tr>
      <tr>
        <td><label for="Username"></label>
          <div align="center">
            <input name="Username" type="text" id="Username" size="50">
          </div></td>
      </tr>
      <tr>
        <td><div align="center">
          <input type="submit" name="btnSendPassword" id="btnSendPassword" value="Send me Password">
        </div></td>
      </tr>
    </table>
    <p>The Password will be send to the email address you used at the time of registration.</p>
  </div>
</form>

</div>
<?php  } // show Password reset form or process the script ?>
