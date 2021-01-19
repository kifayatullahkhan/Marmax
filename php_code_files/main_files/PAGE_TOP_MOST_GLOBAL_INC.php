<?php 
  ob_start();  // do not fluch until the end of the Script has been completed
  if (!isset($_SESSION)) {
  session_start();
}

?>
<?php require_once("Connections/Conn.php"); ?>
<?php require_once('include_code/include_global.php'); ?>
<?php require_once('include_code/restrict_access_to_this_page.php'); ?>
