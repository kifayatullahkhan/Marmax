<?php 
//Prevent Direct Access to this file. any file when accessed has by defualt count==1
if(count(get_included_files()) ==1) exit("Direct access not permitted.");

function ZorkifMessageBox($TextMessage,$MessageTitle="No Title Defined"){
 				echo "<div class=\"MessageBox\">
				      <div class=\"MessageTitle\">". $MessageTitle ."</div>
                      <p> " . $TextMessage ."</p>
					<div class=\"MessageBoxIcon\"></div>				
					</div>";
}
//set_error_handler("ZorkifErrorHandler");
function ZorkifErrorHandler($errno, $errstr, $errfile, $errline)
{
    if (!(error_reporting() & $errno)) {
        // This error code is not included in error_reporting
        return;
    }

    switch ($errno) {
    case E_USER_ERROR:
        echo "<b>ERROR</b> [$errno] $errstr<br />\n";
        echo "  Fatal error on line $errline in file $errfile";
        echo ", PHP " . PHP_VERSION . " (" . PHP_OS . ")<br />\n";
        echo "Aborting...<br />\n";
        exit(1);
        break;

    case E_USER_WARNING:
        echo "<b>My WARNING</b> [$errno] $errstr<br />\n";
        break;

    case E_USER_NOTICE:
        echo "<b>My NOTICE</b> [$errno] $errstr<br />\n";
        break;

    default:
        echo "Unknown error type: [$errno] $errstr<br />\n";
        break;
    }

    /* Don't execute PHP internal error handler */
    return true;
}

function format_bytes($bytes) {
   if ($bytes < 1024) return $bytes.' B';
   elseif ($bytes < 1048576) return round($bytes / 1024, 2).' KB';
   elseif ($bytes < 1073741824) return round($bytes / 1048576, 2).' MB';
   elseif ($bytes < 1099511627776) return round($bytes / 1073741824, 2).' GB';
   else return round($bytes / 1099511627776, 2).' TB';
}

function getFileSize($FileName){
	if (file_exists($FileName)){
		return format_bytes(filesize($FileName));
	}else{
		return "File Not Found";	
	}
}

function date_diff_in_days($date1, $date2) {
    $current = $date1;
    $datetime2 = date_create($date2);
    $count = 0;
    while(date_create($current) < $datetime2){
        $current = gmdate("Y-m-d", strtotime("+1 day", strtotime($current)));
        $count++;
    }
    return $count;
} 

if (isset($_GET['ln'])) { $_SESSION['ln'] = $_GET['ln']; }


/*
App_Module_ID 	App_Module_Name 		     			Comment
---------------------------------------------------------------------------------------------------------------
1 				User Management          				This section of the Application has all user accou
2 				Web Management  						This section of the Application deals with web pag...
3 				News and Testimonials	 				To manage dynamic addtion of news and testimonials...
4 				Tickets System Administration 			This section of the application helps the administ...
5 				Tickets System User's Panel 			This section of the Application has ticket submiss...
6 				Financial Management 					This section of the Application deals with dynamic...
7 				File Sharing 							This section deals with users file shairing
8 				Extra Tools 							This section of the application provides acces to ...
9 				Hotel Management System 				Hotel or Places Management System
10 				ERP Configuration Setup 				The Main Configuration Area for Setting Up ERP App...
11 				Purchase Order and Proforma Invoices 	Define Purchase Orders , supplier details, proform...
12 				Salesman Order		 					Salesman Order for Customers, Adding his own custo...
13 				Sales Order Processing 					This unit of the business will process the orders ...
14 				Inventory System 						This unit of the software will maintain the Stock ...
15 				Accounting System 						This unit of the software will perform all the bas...
16 				Delivery Order Form 					This unit of the software will handle the delivery...
17 				Production Unit 						This Module of the software will keep track of the...
18 				Wearhouse (Delivery Order Form)			This Module of the software will keep track of the...
19 				Reports 								This section will have access to the Reports of th...
	
*/
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

function GetAccessRightsForThisSectionInERP($GroupID,$ApplicationModuleID,$database_Conn,$Conn){
		mysql_select_db($database_Conn, $Conn);
		if ($GroupID==1) return 1;  // Administrator has Access to All modules of the applications
		$SQLQuery="SELECT * from user_groups_accessrights WHERE App_Module_ID=$ApplicationModuleID AND  GroupID=$GroupID";
		$rs_GetAccessRightsForThisSectionInERP = mysql_query($SQLQuery, $Conn) or die(mysql_error());
		$row_rs_GetAccessRightsForThisSectionInERP = mysql_fetch_assoc($rs_GetAccessRightsForThisSectionInERP);
		$totalRows_rs_get_groups = mysql_num_rows($rs_GetAccessRightsForThisSectionInERP);

		if ($totalRows_rs_get_groups>0 ) 
		    return $totalRows_rs_get_groups;
		else
		    return 0;	
}
function GetAccessRightsForThisSection($GroupID,$ApplicationModuleID,$database_Conn,$Conn){
		mysql_select_db($database_Conn, $Conn);
		if ($GroupID==1) return 1;  // Administrator has Access to All modules of the applications
		$SQLQuery="SELECT * from user_groups_accessrights WHERE App_Module_ID=$ApplicationModuleID AND  GroupID=$GroupID";
		$rs_GetAccessRightsForThisSection = mysql_query($SQLQuery, $Conn) or die(mysql_error());
		$row_rs_GetAccessRightsForThisSection = mysql_fetch_assoc($rs_GetAccessRightsForThisSection);
		$totalRows_rs_get_groups = mysql_num_rows($rs_GetAccessRightsForThisSection);

		if ($totalRows_rs_get_groups>0 ) 
		    return $totalRows_rs_get_groups;
		else
		    return 0;	
}

// This functon checks if a module has access allowed for every user group / 1= Allowed 0=not allowed
function Get_Allow_Everyone_AccessessRights($ApplicationModuleID,$database_Conn,$Conn){
		mysql_select_db($database_Conn, $Conn);
		
		$SQLQuery="SELECT * from application_modules WHERE App_Module_ID=$ApplicationModuleID AND  Allow_Everyone=1";
		$rs_GetAccessRightsForThisSection = mysql_query($SQLQuery, $Conn) or die(mysql_error());
		$row_rs_GetAccessRightsForThisSection = mysql_fetch_assoc($rs_GetAccessRightsForThisSection);
		$totalRows_rs_get_groups = mysql_num_rows($rs_GetAccessRightsForThisSection);

		if ($totalRows_rs_get_groups>0 ) 
		    return $totalRows_rs_get_groups;
		else
		    return 0;	
}
// ------------------ Start of Piccture Resize Code -----------------------
// The Code Below is Used to Resise a Picutre that is upload to the server
//------------------------------------------------------------------------
class ResizeImage{
 
   var $image;
   var $image_type;
 
   function load($filename) {
 
      $image_info = getimagesize($filename);
      $this->image_type = $image_info[2];
      if( $this->image_type == IMAGETYPE_JPEG ) {
 
         $this->image = imagecreatefromjpeg($filename);
      } elseif( $this->image_type == IMAGETYPE_GIF ) {
 
         $this->image = imagecreatefromgif($filename);
      } elseif( $this->image_type == IMAGETYPE_PNG ) {
 
         $this->image = imagecreatefrompng($filename);
      }
   }
   function save($filename, $image_type=IMAGETYPE_JPEG, $compression=75, $permissions=null) {
 
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image,$filename,$compression);
      } elseif( $image_type == IMAGETYPE_GIF ) {
 
         imagegif($this->image,$filename);
      } elseif( $image_type == IMAGETYPE_PNG ) {
 
         imagepng($this->image,$filename);
      }
      if( $permissions != null) {
 
         chmod($filename,$permissions);
      }
   }
   function output($image_type=IMAGETYPE_JPEG) {
 
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image);
      } elseif( $image_type == IMAGETYPE_GIF ) {
 
         imagegif($this->image);
      } elseif( $image_type == IMAGETYPE_PNG ) {
 
         imagepng($this->image);
      }
   }
   function getWidth() {
 
      return imagesx($this->image);
   }
   function getHeight() {
 
      return imagesy($this->image);
   }
   function resizeToHeight($height) {
 
      $ratio = $height / $this->getHeight();
      $width = $this->getWidth() * $ratio;
      $this->resize($width,$height);
   }
 
   function resizeToWidth($width) {
      $ratio = $width / $this->getWidth();
      $height = $this->getheight() * $ratio;
      $this->resize($width,$height);
   }
 
   function scale($scale) {
      $width = $this->getWidth() * $scale/100;
      $height = $this->getheight() * $scale/100;
      $this->resize($width,$height);
   }
 
   function resize($width,$height) {
      $new_image = imagecreatetruecolor($width, $height);
      imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
      $this->image = $new_image;
   }      
 
}

// --------------- End of Picture Resieze Code --------------------------


// Email Address Validation Function
function check_email_address($email) {
  // First, we check that there's one @ symbol, 
  // and that the lengths are right.
  if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
    // Email invalid because wrong number of characters 
    // in one section or wrong number of @ symbols.
    return false;
  }
  // Split it into sections to make life easier
  $email_array = explode("@", $email);
  $local_array = explode(".", $email_array[0]);
  for ($i = 0; $i < sizeof($local_array); $i++) {
    if
(!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&
↪'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$",
$local_array[$i])) {
      return false;
    }
  }
  // Check if domain is IP. If not, 
  // it should be valid domain name
  if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) {
    $domain_array = explode(".", $email_array[1]);
    if (sizeof($domain_array) < 2) {
        return false; // Not enough parts to domain
    }
    for ($i = 0; $i < sizeof($domain_array); $i++) {
      if
(!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|
↪([A-Za-z0-9]+))$",
$domain_array[$i])) {
        return false;
      }
    }
  }
  return true;
}
// End of Email Address Validation Function

function remove_end_characters_from_str($string, $stringToRemove) {
    $stringToRemoveLen = strlen($stringToRemove);
    $stringLen = strlen($string);
   
    $pos = $stringLen - $stringToRemoveLen;

    $out = substr($string, 0, $pos);

    return $out;
}

 // Encryption Decryption Functions
   $ZorkifSecretKeyForAllEncryption = "ZXD!@786"; // Secret Password Key for Encryption
    function fnEncryptData($sValue)
    {
        return trim(
            base64_encode(
                mcrypt_encrypt(
                    MCRYPT_RIJNDAEL_256,
                    $GLOBALS['ZorkifSecretKeyForAllEncryption'], $sValue, 
                    MCRYPT_MODE_ECB, 
                    mcrypt_create_iv(
                        mcrypt_get_iv_size(
                            MCRYPT_RIJNDAEL_256, 
                            MCRYPT_MODE_ECB
                        ), 
                        MCRYPT_RAND)
                    )
                )
            );
    }

    function fnDecryptData($sValue)
    {
        return trim(
            mcrypt_decrypt(
                MCRYPT_RIJNDAEL_256, 
                $GLOBALS['ZorkifSecretKeyForAllEncryption'], 
                base64_decode($sValue), 
                MCRYPT_MODE_ECB,
                mcrypt_create_iv(
                    mcrypt_get_iv_size(
                        MCRYPT_RIJNDAEL_256,
                        MCRYPT_MODE_ECB
                    ), 
                    MCRYPT_RAND
                )
            )
        );
    }


// Function to Send Email in a Customise Format

function fnZorkifSendMail($FromEmail,$ToEmail,$CC,$BCC,$Subject,$MailMessage){

	
	// To send HTML mail, the Content-type header must be set
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	// Additional headers
	$headers .= 'To: '. $ToEmail . "\r\n";
	if(isset($FromEmail) && strlen($ToEmail)>3) {
		$headers .= 'From: '.$FromEmail . "\r\n";
	}
	if(isset($CC) && strlen($CC)>3) {
		$headers .= 'Cc: '.$CC . "\r\n";
	}
	if(isset($BCC) && strlen($BCC)>3) {
		$headers .= 'Bcc: '. $BCC . "\r\n";
	}
	 		
	mail($ToEmail,$Subject,$MailMessage,$headers);

return true;	
}

// Start of Credit Card Validation Function
//echo validateCC("1738292928284637", "Dinners");
function fnValidateCC($cc_num, $type) {

	if($type == "American") {
	$denum = "American Express";
	} elseif($type == "Dinners") {
	$denum = "Diner's Club";
	} elseif($type == "Discover") {
	$denum = "Discover";
	} elseif($type == "Master") {
	$denum = "Master Card";
	} elseif($type == "Visa") {
	$denum = "Visa";
	}

	if($type == "American") {
	$pattern = "/^([34|37]{2})([0-9]{13})$/";//American Express
	if (preg_match($pattern,$cc_num)) {
	$verified = true;
	} else {
	$verified = false;
	}
	
	
	} elseif($type == "Dinners") {
	$pattern = "/^([30|36|38]{2})([0-9]{12})$/";//Diner's Club
	if (preg_match($pattern,$cc_num)) {
	$verified = true;
	} else {
	$verified = false;
	}
	
	
	} elseif($type == "Discover") {
	$pattern = "/^([6011]{4})([0-9]{12})$/";//Discover Card
	if (preg_match($pattern,$cc_num)) {
	$verified = true;
	} else {
	$verified = false;
	}
	
	
	} elseif($type == "Master") {
	$pattern = "/^([51|52|53|54|55]{2})([0-9]{14})$/";//Mastercard
	if (preg_match($pattern,$cc_num)) {
	$verified = true;
	} else {
	$verified = false;
	}
	
	
	} elseif($type == "Visa") {
	$pattern = "/^([4]{1})([0-9]{12,15})$/";//Visa
	if (preg_match($pattern,$cc_num)) {
	$verified = true;
	} else {
	$verified = false;
	}
	
	}
	
	if($verified == false) {
	//Do something here in case the validation fails
	//echo "Credit card invalid. Please make sure that you entered a valid <em>" . $denum . "</em> credit card ";
		return false;
	
	} else { //if it will pass...do something
		//echo "Your <em>" . $denum . "</em> credit card is valid";
		return true;
	}


}
// End of Credit Card Validation Function




/* ======================================*/
/*  Upload Images Files If any Attached  */
/* ======================================*/
function fnUploadFileToPath($FileTempName,$FileActualName,$DefinedUploadFilePath){ 
  		     //Cech if no files are bing uploaded at all
			 if(empty($_FILES)) return false;
			 
			// Process Uploaded File  		 
			$UploadedFileName="";
			$upload_file_path=$DefinedUploadFilePath;
			//if ($error == UPLOAD_ERR_OK) {	 
			$UploadedFileName=$_SESSION['MM_UserID']."_".date("dmyzHs").rand(11111,99999). ".".pathinfo($FileActualName, PATHINFO_EXTENSION);;
		    $upload_file_path= $upload_file_path.$UploadedFileName;
			$temp=$FileTempName;
			if(is_uploaded_file($FileTempName)){
			move_uploaded_file($temp,$upload_file_path)or die("Can't move file".mysql_error()); 
			//}
            return $UploadedFileName;
			}else{
				return false;	
			}
}
?>