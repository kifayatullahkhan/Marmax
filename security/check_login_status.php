<?php

if (!isset($_SESSION)){
	session_start();	
}
 
if(!isset($_SESSION['MM_UserID'])) {
	header("Location: index.php?STATUS=ACCESSDENIED");
}
 
?>