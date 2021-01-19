<?php 
if(file_exists('Connections/Conn.php')){ require_once('Connections/Conn.php'); }else
if(file_exists('../Connections/Conn.php')){ require_once('../Connections/Conn.php'); }else
if(file_exists('../../Connections/Conn.php')){ require_once('../../Connections/Conn.php'); }

	require_once("../global_configurations_and_functions/global_functions.php");
    require_once("../global_configurations_and_functions/global_define_constants.php");
	
$colname_Rs_GetEmail_PasswdReset = "-1";
if (isset($_POST['Username'])) {
  $colname_Rs_GetEmail_PasswdReset = $_POST['Username'];
}
mysql_select_db($database_Conn, $Conn);
$query_Rs_GetEmail_PasswdReset = sprintf("SELECT Password, FirstName, Email FROM user_accounts WHERE Username = %s", GetSQLValueString($colname_Rs_GetEmail_PasswdReset, "text"));
$Rs_GetEmail_PasswdReset = mysql_query($query_Rs_GetEmail_PasswdReset, $Conn) or die(mysql_error());
$row_Rs_GetEmail_PasswdReset = mysql_fetch_assoc($Rs_GetEmail_PasswdReset);
$totalRows_Rs_GetEmail_PasswdReset = mysql_num_rows($Rs_GetEmail_PasswdReset);
?>
<?php
require_once('phpmailer/class.phpmailer.php');
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch

$mail->IsSMTP(); // telling the class to use SMTP
ob_flush();
try {
  $mail->Host       = "mail.zorkif.com"; // SMTP server
//  $mail->SMTPDebug  = 2;                     // 1= debug off 2=debug on enables SMTP debug information (for testing)
  $mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)
  $mail->SMTPAuth   = true;                  // enable SMTP authentication
  $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
  $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
  $mail->Port       = 465;                   // set the SMTP port for the GMAIL server
  $mail->Username   = "passwordrecovery@zorkif.com";  // GMAIL username
  $mail->Password   = "whoami_110";            // GMAIL password
  //$mail->AddReplyTo('name@yourdomain.com', 'First Last');
  $mail->AddAddress($row_Rs_GetEmail_PasswdReset['Email'], $row_Rs_GetEmail_PasswdReset['FirstName']);
  $mail->SetFrom('passwordrecovery@zorkif.com', 'Password Recovery');
 // $mail->AddReplyTo('name@yourdomain.com', 'First Last');
  $mail->Subject = 'Zorkif.com [Password Recovery Service]';
  $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
 
  $mail->MsgHTML(file_get_contents('header_of_password_reset_mail.html') ."<div align=\"center\"><strong>Your Password Is:</strong> ".$row_Rs_GetEmail_PasswdReset['Password']."</div>".file_get_contents('footer_of_password_reset_mail.html'));
 
 // $mail->AddAttachment('images/phpmailer.gif');      // attachment
  //$mail->AddAttachment('images/ztc/zorkif_bottom_corner_logo.gif'); // attachment
  $mail->Send();
 echo "<br /> <br /><br />". ZorkifMessageBox("<div align=\"center\" style=\"padding:100px; font-size:1.8em\"><strong>Password Sent to the Email Address stored on your account</strong></div>")."</p>\n";
} catch (phpmailerException $e) {
    echo $e->errorMessage(); //Pretty error messages from PHPMailer
} catch (Exception $e) {
    echo $e->getMessage(); //Boring error messages from anything else!
}

?>
<?php
mysql_free_result($Rs_GetEmail_PasswdReset);
?>
