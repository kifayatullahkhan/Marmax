<?php
//Prevent Direct Access to this file. any file when accessed has by defualt count==1

//if(count(get_included_files()) ==1) exit("Direct access not permitted.");
if (!isset($_SESSION)) {
   session_start();	
}


# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_Conn = "localhost";
$database_Conn = "marmax_com";
$username_Conn = "root";
$password_Conn = "";
@$Conn = mysql_pconnect($hostname_Conn, $username_Conn, $password_Conn) or trigger_error(mysql_error(),E_USER_ERROR); 
@mysql_query("SET NAMES 'utf8'");
@mysql_query('SET CHARACTER SET utf8');
mb_internal_encoding('utf-8');

// Define Time Zone for Your Application
date_default_timezone_set('Asia/Riyadh');
// date_default_timezone_get();
/* Convert internal character encoding to SJIS */
//$str = mb_convert_encoding($str, "SJIS");

?>