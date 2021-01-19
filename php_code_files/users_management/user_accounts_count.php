<?php 
if(file_exists('Connections/Conn.php')){ require_once('Connections/Conn.php'); }else
if(file_exists('../Connections/Conn.php')){ require_once('../Connections/Conn.php'); }else
if(file_exists('../../Connections/Conn.php')){ require_once('../../Connections/Conn.php'); }

	require_once("../global_configurations_and_functions/global_functions.php");
    require_once("../global_configurations_and_functions/global_define_constants.php");

mysql_select_db($database_Conn, $Conn);
$query_RsCountUsers = "SELECT count(user_accounts.Username) as TotalUsers FROM user_accounts";
$RsCountUsers = mysql_query($query_RsCountUsers, $Conn) or die(mysql_error());
$row_RsCountUsers = mysql_fetch_assoc($RsCountUsers);
$totalRows_RsCountUsers = mysql_num_rows($RsCountUsers);
echo $row_RsCountUsers['TotalUsers'];
mysql_free_result($RsCountUsers);
?>
