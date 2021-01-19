<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}
 
	if(file_exists('Connections/Conn.php')){ require_once('Connections/Conn.php'); }else
	if(file_exists('../Connections/Conn.php')){ require_once('../Connections/Conn.php'); }else
	if(file_exists('../../Connections/Conn.php')){ require_once('../../Connections/Conn.php'); }
	require_once("php_code_files/global_configurations_and_functions/global_define_constants.php");
	require_once("php_code_files/global_configurations_and_functions/global_functions.php");
    
	

$UrlReferrerPageName=preg_replace('/\?.*/', '', $_SERVER['HTTP_REFERER']);
$HeaderRedirectLocationPath=$UrlReferrerPageName;
if (isset($_GET['CONTENT_TYPE'])) {
 	$HeaderRedirectLocationPath=$UrlReferrerPageName."?CONTENT_TYPE=".$_GET['CONTENT_TYPE'];	
}


if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['SigninEmail'])) {
  $loginUsername=$_POST['SigninEmail'];
  $password=$_POST['SigninPassword'];
  $UserEmailAddress="";
  $MM_fldUserAuthorization = "GroupID";
  $MM_redirectLoginSuccess =$HeaderRedirectLocationPath; // "user_panel.php";
  if (isset($_GET['CONTENT_TYPE'])) {
		$MM_redirectLoginFailed = $HeaderRedirectLocationPath. "&STATUS=LOGINFAILED";
  }else{
  		$MM_redirectLoginFailed = $HeaderRedirectLocationPath. "?STATUS=LOGINFAILED";
  }
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_Conn, $Conn);
  	
  $LoginRS__query=sprintf("SELECT UserID, Username, CONCAT(FirstName,LastName) as FullName, Password, FirstName,LastName, GroupID,Email FROM user_accounts WHERE Username=%s AND Password=%s",
  GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $Conn) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
    
    $loginStrGroup  = mysql_result($LoginRS,0,'GroupID');
	$loginUserID=mysql_result($LoginRS,0,'UserID');
    $UserEmailAddress=mysql_result($LoginRS,0,'Email');
	$UserFirstName=mysql_result($LoginRS,0,'FirstName');
	$UserLastName=mysql_result($LoginRS,0,'LastName');
	$UserFullName=trim($UserFirstName." ".$UserLastName);
	$loginFullName=mysql_result($LoginRS,0,'FullName');
	if (strlen($UserFullName)==0) $UserFullName="New User";
	
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_UserID'] =$loginUserID;
    $_SESSION['MM_Username'] = $loginUsername;
	$_SESSION['CustomerOrderID']="";
    $_SESSION['MM_UserGroup'] = $loginStrGroup;
    $_SESSION['MM_Email'] = $UserEmailAddress;	     
	$_SESSION['ln']="en";
	$_SESSION['TimeOut'] = time();   
	$_SESSION['MM_Firstname'] = $UserFirstName;
	$_SESSION['MM_Lastname'] = $UserLastName;
	$_SESSION['MM_FullName']	=$loginFullName;
	if(isset($_POST['checkout_process']) && $_POST['checkout_process']="true") {
		if(!empty($_SERVER['QUERY_STRING']) && $_GET['STATUS']=="PROCEEDTOSTEP2") { 
		header("Location: " . $HeaderRedirectLocationPath);
		}else{
		header("Location: " . $HeaderRedirectLocationPath ."?STATUS=PROCEEDTOSTEP2");	
		}
	}else{
			if (isset($_SESSION['PrevUrl']) && false) {
			  $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
			}
			header("Location: " . $MM_redirectLoginSuccess );
	 }
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
