<?php 
	if(file_exists('Connections/Conn.php')){ require_once('Connections/Conn.php'); }else
	if(file_exists('../Connections/Conn.php')){ require_once('../Connections/Conn.php'); }else
	if(file_exists('../../Connections/Conn.php')){ require_once('../../Connections/Conn.php'); }

	require_once("php_code_files/global_configurations_and_functions/global_functions.php");
    require_once("php_code_files/global_configurations_and_functions/global_define_constants.php");
	
if (isset($_SERVER['HTTP_REFERER'])) {
 	$HeaderRedirectLocationPath=$_SERVER['HTTP_REFERER'];
}else{
	 $HeaderRedirectLocationPath="index.php?STATUS=USERNAMEORPASSWORDINCORRECT";
	
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "SignUp")) {
	 if(check_email_address($_POST['SignUpEmail']) && strlen($_POST['SignUpPassword'])>3) {
		 $colname_chk_if_username_existed = "-1";
if (isset($_POST['SignUpEmail'])) {
  $colname_chk_if_username_existed = $_POST['SignUpEmail'];
}
mysql_select_db($database_Conn, $Conn);
$query_chk_if_username_existed = sprintf("SELECT * FROM user_accounts WHERE Username = %s", GetSQLValueString($colname_chk_if_username_existed, "text"));
$chk_if_username_existed = mysql_query($query_chk_if_username_existed, $Conn) or die(mysql_error());
$row_chk_if_username_existed = mysql_fetch_assoc($chk_if_username_existed);
$totalRows_chk_if_username_existed = mysql_num_rows($chk_if_username_existed);

mysql_free_result($chk_if_username_existed);
if($totalRows_chk_if_username_existed==0){
   $insertSQL = sprintf("INSERT INTO user_accounts (Username, Password, FirstName,LastName, Email, GroupID, AccountStatus) VALUES (%s, %s, %s,%s, %s, %s, %s)",
                       GetSQLValueString($_POST['SignUpEmail'], "text"),
                       GetSQLValueString($_POST['SignUpPassword'], "text"),
                       GetSQLValueString($_POST['FirstName'], "text"),
					   GetSQLValueString($_POST['LastName'], "text"),
                       GetSQLValueString($_POST['SignUpEmail'], "text"),
                       GetSQLValueString(15, "int"), //15 	Members 	Web Site Visitors Memebers
                       GetSQLValueString(1, "int")); //Account is Activated by default
 
  mysql_select_db($database_Conn, $Conn);
  $Result1 = mysql_query($insertSQL, $Conn) or die(mysql_error());
  $UserID=mysql_insert_id();

  
  //Define Header Location Based on Form Access Type
  $HeaderRedirectLocationPath=$HeaderRedirectLocationPath."?STATUS=SIGNUPSUCCESSFULL";
  if(isset($_POST['checkout_process']) && $_POST['checkout_process']="true") {
  // Create Session Object for Auto Logon to Page
     if(!isset($SESSION)) session_start();
		$_SESSION['MM_UserID'] = $UserID; 
		$_SESSION['MM_Username'] = $_POST['SignUpEmail'];
		$_SESSION['MM_FullName']=$_POST['FirstName'] . " ". $_POST['LastName'];
		$_SESSION['MM_UserGroup'] = 15; // Defualt Group ID for Online User is 15	
  // End of Session Auto Logon
  if($_SESSION['ln']=="ar") {
	$HeaderRedirectLocationPath="checkout.php?STATUS=PROCEEDTOSTEP2";  
  }else if($_SESSION['ln']=="en") {
	$HeaderRedirectLocationPath="checkout_en.php?STATUS=PROCEEDTOSTEP2";  
  }
  }

   header("Location: ".$HeaderRedirectLocationPath);
  
		 }// if username  already existed
		 else {
		 
			 
			if(!empty($_SERVER['QUERY_STRING']) && $_GET['STATUS']=="USERALREADYEXISTED") { 
			  header("Location: ". $HeaderRedirectLocationPath);
			}
			else{
			   header("Location: ". $HeaderRedirectLocationPath."?STATUS=USERALREADYEXISTED");
			}
			
		 }// end of if username all ready existed
	 }else {
		 
		 	if(!empty($_SERVER['QUERY_STRING']) && $_GET['STATUS']=="USERNAMEORPASSWORDINCORRECT") { 
			  header("Location: ". $HeaderRedirectLocationPath);
			}
			else{
			   header("Location: ". $HeaderRedirectLocationPath."?STATUS=USERNAMEORPASSWORDINCORRECT");
			}
			
		 
	 }
		 // End of Failed Validation Check 
 }
 
?>
 