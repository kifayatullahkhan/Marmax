<div id="cart_order_details">
    <div id="checkout_cart_summery">
    <h2> Order Summery </h2>
        <div class="summery_cart_sub_total">
         <div class="text_title">Cart SubTotal </div>
         <div class="text_value"> <?php
	if(file_exists('php_code_files/shopping_cart/get_cart_cost_value.php')){
	 require('php_code_files/shopping_cart/get_cart_cost_value.php');
	}elseif(file_exists('../php_code_files/shopping_cart/get_cart_cost_value.php')){
	require('../php_code_files/shopping_cart/get_cart_cost_value.php');
	}
	 ?> </div>
        </div>
        
        
        
        <div class="summery_cart_total_amount">
          <div class="text_title">Total Amount </div>
         <div class="text_value">  <?php
	if(file_exists('php_code_files/shopping_cart/get_cart_cost_value.php')){
	 require('php_code_files/shopping_cart/get_cart_cost_value.php');
	}elseif(file_exists('../php_code_files/shopping_cart/get_cart_cost_value.php')){
	require('../php_code_files/shopping_cart/get_cart_cost_value.php');
	}
	 ?>  </div>
        </div>        
    </div>
    
    
    <div id="checkout_cart_summery">
    <h2> Jump Back</h2>
      <div class="cart_ask_on_phone">
        If you want to make changes to any of your enter data please click the links below, to jump and edit your data.
      </div>
      <div id="cart_other_links">
        <ul>
            <li><a href="checkout_step2_en.php">Shipment Details</a></li>
            <li><a href="checkout_step3_en.php">Billing Details</a></li>
            <li><a href="checkout_step4_en.php">Order Summery</a></li>
        </ul>
      </div>        
    </div>
    
    
    
    <div id="checkout_cart_summery">
    <h2> Any Question </h2>
      <div class="cart_ask_on_phone">
        Phone: 0545883076
      </div>
      <div class="cart_ask_on_chat">
        Live Chat (offline)
      </div>

        <div id="cart_other_links">
          <ul>
            <li>
              <a href="help.php">Help</a></li>
            <li><a href="faq.php">FAQ</a></li>
            <li><a href="how_do_i.php">How do I?</a></li>
          </ul>
        </div>        
    </div>
</div>