
<div id="data_entry_form" class="round_borders">
   
    <div id="item_categories"> 
    <!-- Start of Item -->
        <div class="Item_Category_Display round_borders">
            <div class="Item_Category_DisplayBorder">
                     <div class="Item_CategoryImage">
                          <a href="" AdminPanelLinkID="CouponsCategory"  class="VSvirtualstorelink">
                           <img src="images/admin_zpanel/coupons_category.png">
                            <div class="Item_CategoryPopUpDetails griadent_saima">
                              Coupons Category
                            </div>
                         </a>
                     </div>
            </div>
        </div>
    <!-- End of Item -->

    <!-- Start of Item -->
        <div class="Item_Category_Display round_borders">
            <div class="Item_Category_DisplayBorder">
                     <div class="Item_CategoryImage">
                          <a href="" AdminPanelLinkID="CouponsCategoryItems"  class="VSvirtualstorelink">
                           <img src="images/admin_zpanel/coupons_category.png">
                            <div class="Item_CategoryPopUpDetails griadent_saima">
                              Coupons Items
                            </div>
                         </a>
                     </div>
            </div>
        </div>
    <!-- End of Item -->
     <!-- Start of Item -->
        <div class="Item_Category_Display round_borders">
            <div class="Item_Category_DisplayBorder">
                     <div class="Item_CategoryImage">
                          <a href="" AdminPanelLinkID="VSCategory"  class="VSvirtualstorelink">
                           <img src="images/admin_zpanel/vs_category_icons.png">
                            <div class="Item_CategoryPopUpDetails griadent_saima">
                              VS Category
                            </div>
                         </a>
                     </div>
            </div>
        </div>
    <!-- End of Item -->

      <!-- Start of Item -->
        <div class="Item_Category_Display round_borders">
            <div class="Item_Category_DisplayBorder">
                     <div class="Item_CategoryImage">
                          <a href="" AdminPanelLinkID="VSMainCategory"  class="VSvirtualstorelink">
                           <img src="images/admin_zpanel/vs_category_icons.png">
                            <div class="Item_CategoryPopUpDetails griadent_saima">
                              VS Main Category
                            </div>
                         </a>
                     </div>
            </div>
        </div>
    <!-- End of Item -->
    
     <!-- Start of Item -->
        <div class="Item_Category_Display round_borders">
            <div class="Item_Category_DisplayBorder">
                     <div class="Item_CategoryImage">
                          <a href="" AdminPanelLinkID="SubCategory"  class="VSvirtualstorelink">
                           <img src="images/admin_zpanel/vs_sub_category_icons.png">
                            <div class="Item_CategoryPopUpDetails griadent_saima">
                              Sub Category
                            </div>
                         </a>
                     </div>
            </div>
        </div>
    <!-- End of Item -->

 
     <!-- Start of Item -->
        <div class="Item_Category_Display round_borders">
            <div class="Item_Category_DisplayBorder">
                     <div class="Item_CategoryImage">
                          <a href="" AdminPanelLinkID="VSInvItems"  class="VSvirtualstorelink">
                           <img src="images/admin_zpanel/vs_inv_items.png">
                            <div class="Item_CategoryPopUpDetails griadent_saima">
                              VS Inventory Items
                            </div>
                         </a>
                     </div>
            </div>
        </div>
    <!-- End of Item -->

    
    </div>
   
</div>

<script type="text/javascript">
  
$('#admin_categories a').click(function(event) {
           event.preventDefault();		   
		   var AdminPanelLinkID=$(this).attr('AdminPanelLinkID');  
		   switch (AdminPanelLinkID) {
                    case "CouponsCategory":
							 $.get("admin_zpanel/vs_coupons_categories.php", function(data){
			    				$("#page_contents").html(data);		 
		  					 });
                    break; 
                    case "CouponsCategoryItems":
							 $.get("admin_zpanel/vs_coupons_management.php", function(data){
			    				$("#page_contents").html(data);		 
		  					 });
                    break; 									
                    case "VSCategory":
							 $.get("admin_zpanel/vs_item_categories_management.php", function(data){
			    				$("#page_contents").html(data);		 
		  					 });
                    break;
                    case "VSMainCategory":
							 $.get("admin_zpanel/vs_item_main_categories_management.php", function(data){
			    				$("#page_contents").html(data);		 
		  					 });
                    break;						
                    case "SubCategory":
							 $.get("admin_zpanel/vs_items_sub_category_management.php", function(data){
			    				$("#page_contents").html(data);		 
		  					 });
                    break;
                    case "VSInvItems":
							 $.get("admin_zpanel/vs_users_virtual_stores_inventory_management.php", function(data){
			    				$("#page_contents").html(data);		 
		  					 });
                    break;															                  
                    default:
                        alert('Please Select Correct Category');
                }

});
 
</script>
