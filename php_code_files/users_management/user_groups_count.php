<?php 
if(file_exists('Connections/Conn.php')){ require_once('Connections/Conn.php'); }else
if(file_exists('../Connections/Conn.php')){ require_once('../Connections/Conn.php'); }else
if(file_exists('../../Connections/Conn.php')){ require_once('../../Connections/Conn.php'); }

	require_once("../global_configurations_and_functions/global_functions.php");
	require_once("../global_configurations_and_functions/global_define_constants.php");
	

mysql_select_db($database_Conn, $Conn);
$query_RsCountGroups = "SELECT count(user_groups.GroupName) as TotalGroups FROM user_groups";
$RsCountGroups = mysql_query($query_RsCountGroups, $Conn) or die(mysql_error());
$row_RsCountGroups = mysql_fetch_assoc($RsCountGroups);
$totalRows_RsCountGroups = mysql_num_rows($RsCountGroups);
echo $row_RsCountGroups['TotalGroups'];
mysql_free_result($RsCountGroups);
?>
