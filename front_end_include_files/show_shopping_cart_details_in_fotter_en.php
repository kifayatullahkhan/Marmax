<?php
		if(!isset($_SESSION)){
		session_start();
		}
		if(isset($_SESSION["cart_Items"]) && count($_SESSION["cart_Items"])>0){		
			  // Show the Details of the Shopping Cart
?>
<!-- Start of Show Shopping Cart -->
<div class="center_to_page">

    <div class="show_sopping_cart_footer_wrapper">

<div class="cart_no_of_items">
    <div class="cart_icon"></div>
	<?php
	// The Code Below will show the Count of Items in the Shopping cart Session variable
	if(!isset($_SESSION)){
	session_start();
    }
	if(isset($_SESSION["cart_Items"])){
	echo count($_SESSION["cart_Items"]);	
	}
	
	?> Items
</div>



<div class="cart_total_amount">
    <div class="cart_total_amount_icon"></div>
    <div class="cart_total_amount_title">SAR</div>
	<div id="cart_total_amount_value"><?php
	if(file_exists('php_code_files/shopping_cart/get_cart_cost_value.php')){
	 require_once('php_code_files/shopping_cart/get_cart_cost_value.php');
	}elseif(file_exists('../php_code_files/shopping_cart/get_cart_cost_value.php')){
	require_once('../php_code_files/shopping_cart/get_cart_cost_value.php');
	}
	 ?></div>

</div>


<div class="cart_check_out_link">
    <div class="cart_check_out_link_icon"></div>
<a href="checkout_en.php">Checkout</a>
</div>

<div class="cart_show_details_link">
    <div class="cart_show_details_link_icon"></div>
<a href="index_en.php?page_name=view_shopping_cart_details">Details</a>
</div>

<div class="cart_continue_shopping_link">
    <div class="cart_continue_shopping_link_icon"></div>
<a href="index_en.php">Continue</a>
</div>


    	
    </div>
</div>
<!-- End of Show Shopping Cart -->
<?php 
		}// end od session item count
?>