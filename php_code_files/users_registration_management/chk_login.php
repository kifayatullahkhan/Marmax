<?php 
if(file_exists('Connections/Conn.php')){ require_once('Connections/Conn.php'); }else
if(file_exists('../Connections/Conn.php')){ require_once('../Connections/Conn.php'); }else
if(file_exists('../../Connections/Conn.php')){ require_once('../../Connections/Conn.php'); }

	require_once("../global_configurations_and_functions/global_functions.php");
    require_once("../global_configurations_and_functions/global_define_constants.php");

	
	
	
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['Username'])) {
  $loginUsername=$_POST['Username'];
  $password=$_POST['Password'];
  $UserEmailAddress="";
  $MM_fldUserAuthorization = "GroupID";
  $MM_redirectLoginSuccess = "../../user_panel.php";
  $MM_redirectLoginFailed = "login.php?STATUS=LOGINFAILED";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_Conn, $Conn);
  	
  $LoginRS__query=sprintf("SELECT UserID, Username, CONCAT(FirstName,LastName) as FullName, Password, GroupID,Email FROM user_accounts WHERE Username=%s AND Password=%s",
  GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $Conn) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
    
    $loginStrGroup  = mysql_result($LoginRS,0,'GroupID');
	$loginUserID=mysql_result($LoginRS,0,'UserID');
    $UserEmailAddress=mysql_result($LoginRS,0,'Email');
	$loginFullName=mysql_result($LoginRS,0,'FullName');
	
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_UserID'] =$loginUserID;
    $_SESSION['MM_Username'] = $loginUsername;
	$_SESSION['MM_FullName'] = $loginFullName;	
    $_SESSION['MM_UserGroup'] = $loginStrGroup;
    $_SESSION['MM_Email'] = $UserEmailAddress;	     
	$_SESSION['ln']="en";
	$_SESSION['TimeOut'] = time();   

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
