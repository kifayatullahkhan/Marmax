<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$maxRows_Rs_GetLatestNews = 2;
$pageNum_Rs_GetLatestNews = 0;
if (isset($_GET['pageNum_Rs_GetLatestNews'])) {
  $pageNum_Rs_GetLatestNews = $_GET['pageNum_Rs_GetLatestNews'];
}
$startRow_Rs_GetLatestNews = $pageNum_Rs_GetLatestNews * $maxRows_Rs_GetLatestNews;

mysql_select_db($database_Conn, $Conn);
$query_Rs_GetLatestNews = "SELECT NewsID, NewsTitle, NewsText, DATE_FORMAT(Dated,'%d %M %Y') as Dated, Username FROM news WHERE Language='ar' ORDER BY NewsID DESC";
$query_limit_Rs_GetLatestNews = sprintf("%s LIMIT %d, %d", $query_Rs_GetLatestNews, $startRow_Rs_GetLatestNews, $maxRows_Rs_GetLatestNews);
$Rs_GetLatestNews = mysql_query($query_limit_Rs_GetLatestNews, $Conn) or die(mysql_error());
$row_Rs_GetLatestNews = mysql_fetch_assoc($Rs_GetLatestNews);

if (isset($_GET['totalRows_Rs_GetLatestNews'])) {
  $totalRows_Rs_GetLatestNews = $_GET['totalRows_Rs_GetLatestNews'];
} else {
  $all_Rs_GetLatestNews = mysql_query($query_Rs_GetLatestNews);
  $totalRows_Rs_GetLatestNews = mysql_num_rows($all_Rs_GetLatestNews);
}
$totalPages_Rs_GetLatestNews = ceil($totalRows_Rs_GetLatestNews/$maxRows_Rs_GetLatestNews)-1;
?>
<ul id="js-news" class="js-hidden">
                  <?php do { ?>
                    	<li  class="news-item">                          
                         <a href="news.php"><?php echo $row_Rs_GetLatestNews['NewsTitle']; ?></a> &gt;&gt;
                         <?php echo $row_Rs_GetLatestNews['NewsText']; ?> |
                         <strong class="NewsDate"><?php echo  $row_Rs_GetLatestNews['Dated']; ?></strong> 
                       
                    	</li>


                   <?php } while ($row_Rs_GetLatestNews = mysql_fetch_assoc($Rs_GetLatestNews)); ?>
                       
</ul>
<?php
mysql_free_result($Rs_GetLatestNews);
?>
