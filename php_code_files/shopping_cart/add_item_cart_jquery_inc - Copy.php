<script type="text/javascript">

 
  // Add Item to Cart 
  $('.AddToCartButton a').click(function(event) {
           event.preventDefault();	
		    
		   var ItemID=$(this).attr('InvItemID');  
		   var Quantity=$(this).attr('Quantity');  
		   var ItemCartType=$(this).attr('ItemCartType'); 
		   var Add2CartFilePath="php_code_files/shopping_cart/add_item_to_cart.php";
		if(ItemCartType=="VirtualStore"){
			Add2CartFilePath=Add2CartFilePath+"?InvItemID="+ItemID+"&Quantity="+Quantity+"&ItemCartType=VirtualStore";
		}else{			
			Add2CartFilePath=Add2CartFilePath+"?InvItemID="+ItemID+"&Quantity="+Quantity+"&ItemCartType=CouponDeals";
		}
		//alert(Add2CartFilePath);
		   $.get(Add2CartFilePath, function(data){
			    $("#cart_total_amount_value").html(data);	
				//alert("Add Item to Cart");  
				
				// **************************************************************************
				//  The Code below will be used to Read shopping cart session Cost totals.
				// **************************************************************************

				$.get("front_end_include_files/show_shopping_cart_details_in_fotter_ar.php", function(data){
			    $("#footer_cart_wrapper").html(data);	
					//alert("Reading Cart Totals");  
				
		  		 });
				// **************************************************************************

				// **************************************************************************
				//  Relaod/Show the car values
				// **************************************************************************

				$.get("php_code_files/shopping_cart/get_cart_cost_value.php", function(data){
			    $("#cart_total_amount_value").html(data);	
					//alert("Reading Cart Totals");  
				
		  		 });
				// **************************************************************************

		   });
		 
		   
		   
  });
  //End of Add Item to Cart
</script>