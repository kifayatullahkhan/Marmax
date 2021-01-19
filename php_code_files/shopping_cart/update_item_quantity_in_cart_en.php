<?php 
if(!isset($_SESSION)){
	session_start();
}

  

   

	
	if (isset($_POST["ItemCode"]) && isset($_SESSION['cart_Quantity'])){
        $i=0;
		if(is_array($_SESSION["cart_Items"])){ 
			$i = array_search($_POST["ItemCode"], $_SESSION["cart_Items"]); // $key = 2;
			
			        $_SESSION['cart_Quantity'][$i] = $_POST["cart_Quantity"];			
		}
	}
	



header("Location: ../../shopping_cart_view_cart_details_en.php");

?>