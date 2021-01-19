<?php
// *** Logout the current user.
 
if (!isset($_SESSION)) {
  session_start();
}
if (isset($_SESSION['ln']) && $_SESSION['ln']=="en") 
$logoutGoTo = "index_en.php";
else
$logoutGoTo = "index.php";

    $_SESSION['MM_UserID'] =NULL;
    $_SESSION['MM_Username'] = NULL;
    $_SESSION['MM_UserGroup'] = NULL;
    $_SESSION['MM_Email'] = NULL;     
	$_SESSION['ln']=NULL;
	$_SESSION['TimeOut'] = NULL;
	$_SESSION['MM_Firstname'] = NULL;
	


    unset($_SESSION['MM_UserID']);  
	unset($_SESSION['MM_Username']);
	unset($_SESSION['MM_UserGroup']);
    unset($_SESSION['MM_Email']);    
	unset($_SESSION['TimeOut']);
	unset($_SESSION['MM_Firstname']);
	
	unset($_SESSION['cart_Items']);
 	unset($_SESSION['cart_Quantity']);
 	unset($_SESSION['cart_ItemCartType']);




if ($logoutGoTo != "") {header("Location: $logoutGoTo");
exit;
}
?>
