<?php
if (!isset($_SESSION)) {
  session_start();
}
   $MM_redirectLoginFailed = "php_code_files/users_registration_management/login.php?STATUS=NOTLOGEDIN";   
	if (
		!isset($_SESSION['MM_UserID']     ) ||  
		!isset($_SESSION['MM_Username']   ) ||
		!isset($_SESSION['MM_UserGroup']  ) ||
		!isset($_SESSION['MM_Email']      ) ||
		!isset($_SESSION['TimeOut']       )  
    ) {
		
	// Not Loged In	
	header("Location: ". $MM_redirectLoginFailed );
	exit;
	}


?>