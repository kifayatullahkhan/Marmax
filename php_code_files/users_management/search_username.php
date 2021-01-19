<?php 
if(file_exists('Connections/Conn.php')){ require_once('Connections/Conn.php'); }else
if(file_exists('../Connections/Conn.php')){ require_once('../Connections/Conn.php'); }else
if(file_exists('../../Connections/Conn.php')){ require_once('../../Connections/Conn.php'); }

	require_once("../global_configurations_and_functions/global_functions.php");
require_once("../global_configurations_and_functions/global_define_constants.php");
?>
<?php

$q = strtolower($_GET["q"]);
if (!$q) return;

$conn=mysql_connect("localhost","root","");
mysql_select_db("zorkif_erp",$conn)or die(mysql_error());

$query="SELECT * FROM user_accounts WHERE Username ='$q' OR Username LIKE '$q%'";

$result=mysql_query($query,$conn) or die(mysql_error());
$users= array();

while($row=mysql_fetch_assoc($result))
{
	 $users['username']=$row['Username'];
}
foreach ($users as $key) {
	if (strpos(strtolower($key), $q) !== false) {
		echo "$key\n";
	}
}




?>