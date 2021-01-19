<?php 
if(!isset($_SESSION)){
	session_start();
}
if(file_exists('Connections/Conn.php')){ require_once('Connections/Conn.php'); }else
if(file_exists('../Connections/Conn.php')){ require_once('../Connections/Conn.php'); }else
if(file_exists('../../Connections/Conn.php')){ require_once('../../Connections/Conn.php'); }


    if (isset($_POST["RemoveItemID"])) 
	//remove product with productID == $remove
    {
        $i=0;
		if(is_array($_SESSION["cart_Items"])){
       
			 //while ($i<count($_SESSION["cart_Items"]) && $_SESSION["cart_Items"][$i] != $_POST["RemoveItemID"])
            //$i++;
			
			
			//echo "i=". $i ."<br>";
			//echo "Item Code=" . $_POST["RemoveItemID"];
			
			$i = array_search($_POST["RemoveItemID"], $_SESSION["cart_Items"]); // $key = 2;
			
			 
					//$_SESSION["cart_Items"][$i] = 0;
					//$_SESSION['cart_Quantity'][$i] = 0;
					unset($_SESSION["cart_Quantity"][$i]);
					unset($_SESSION['cart_ItemCartType'][$i]);
					unset($_SESSION["cart_Items"][$i]);
			 
			/* 
			foreach($_SESSION['cart_Items'] as $key=>$value){
				echo "ItemCode=".$_SESSION['cart_Items'][$key]."<br>";
				echo "Quantity=".$_SESSION['cart_Quantity'][$key]."<br>";
				echo "Cart Type=".$_SESSION['cart_ItemCartType'][$key]."<br><hr><br>";
				
				
			}
			*/
	}
header("Location: ../../shopping_cart_view_cart_details_en.php");
	}
?>