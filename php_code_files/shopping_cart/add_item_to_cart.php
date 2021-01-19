<?php 
if(!isset($_SESSION)){
	session_start();
}
if(file_exists('Connections/Conn.php')){ require_once('Connections/Conn.php'); }else
if(file_exists('../Connections/Conn.php')){ require_once('../Connections/Conn.php'); }else
if(file_exists('../../Connections/Conn.php')){ require_once('../../Connections/Conn.php'); }

$InvItemID="";
$Quantity=0;
$ItemCartType="";
$DataValidation=false;

if (isset($_GET['InvItemID']) && isset($_GET['Quantity']) && strlen($_GET['InvItemID'])>0 && $_GET['Quantity']>0 && isset($_GET['ItemCartType'])) {
	$InvItemID=$_GET['InvItemID'];
	$Quantity=$_GET['Quantity'];
	$ItemCartType=$_GET['ItemCartType'];
	$DataValidation=true;
}else
if (isset($_POST['InvItemID']) && isset($_POST['Quantity']) && strlen($_POST['InvItemID'])>0 && $_POST['Quantity']>0 && isset($_POST['ItemCartType'])) {
	$InvItemID=$_POST['InvItemID'];
	$Quantity=$_POST['Quantity'];
	$ItemCartType=$_POST['ItemCartType'];
	$DataValidation=true;	
}


if(	$DataValidation==true){
if (!isset($_SESSION["cart_Items"]))
        { 
$_SESSION['cart_Items']=array();
$_SESSION['cart_Quantity']=array();
$_SESSION['cart_ItemCartType']=array();
		}

//array_push($_SESSION['cart_Items'],$InvItemID);
//array_push($_SESSION['cart_Quantity'],$Quantity);


        //check for current product in visitor's shopping cart content
        $i=0;
        while ($i<count($_SESSION["cart_Items"]) && $_SESSION["cart_Items"][$i] != $InvItemID) $i++;
        if ($i < count($_SESSION["cart_Items"])) //increase current product's item quantity
        {
            $_SESSION["cart_Quantity"][$i]+=$Quantity;
        }
        else //no such product in the cart - add it
        {
            $_SESSION["cart_Items"][] =  $InvItemID;
            $_SESSION["cart_Quantity"][] = $Quantity;
			$_SESSION['cart_ItemCartType'][] =$ItemCartType;
        }
		 
	/*
	foreach($_SESSION['cart_Items'] as $key=>$value)
		{
		// and print out the values
		echo 'ItemID='.$value."'".' Quantity=' . $_SESSION['cart_Quantity'][$key]."'".' <br />';
		}
		*/
	
} // End if if statement // Check for ItemID and Quantity

//We can remove items from the array by using array_diff function.
//$_SESSION[cart]=array_diff($_SESSION[cart],$prod_id);
//header("Location: ../../../online_shop.php");

?>