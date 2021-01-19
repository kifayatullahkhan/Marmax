<div id="cart_order_details">
    <div id="checkout_cart_summery">
    <h2> ملخص الطلب </h2>
        <div class="summery_cart_sub_total">
         <div class="text_title">مجموع السلة  </div>
         <div class="text_value"> <?php
	if(file_exists('php_code_files/shopping_cart/get_cart_cost_value.php')){
	 require('php_code_files/shopping_cart/get_cart_cost_value.php');
	}elseif(file_exists('../php_code_files/shopping_cart/get_cart_cost_value.php')){
	require('../php_code_files/shopping_cart/get_cart_cost_value.php');
	}
	 ?> </div>
        </div>
        
        
        
        <div class="summery_cart_total_amount">
          <div class="text_title">المجموع  </div>
         <div class="text_value"> <?php
	if(file_exists('php_code_files/shopping_cart/get_cart_cost_value.php')){
	 require('php_code_files/shopping_cart/get_cart_cost_value.php');
	}elseif(file_exists('../php_code_files/shopping_cart/get_cart_cost_value.php')){
	require('../php_code_files/shopping_cart/get_cart_cost_value.php');
	}
	 ?> </div>
        </div>        
    </div>
    
    
    <div id="checkout_cart_summery">
    <h2>الى الخلف</h2>
      <div class="cart_ask_on_phone">
        اذا أردت اجراء اي تعديل بالبيانات المدخلة , اختر من الروابط المرفقة للرجوع للصفحة المطلوبة .
      </div>
      <div id="cart_other_links">
        <ul>
            <li>
              <a href="checkout_step2.php">معلومات التوصيل </a></li>
            <li><a href="checkout_step3.php">معلومات الفاتورة</a></li>
            <li><a href="checkout_step4.php">ملخص الطلب</a></li>
        </ul>
      </div>        
    </div>
    
    
    
    <div id="checkout_cart_summery">
    <h2> للاستفسارات  </h2>
      <div class="cart_ask_on_phone">
        هاتف : 
      </div>
      <div class="cart_ask_on_chat">
       محادثة فورية
      </div>

        <div id="cart_other_links">
          <ul>
            <li>
              <a href="help.php">مساعدة</a></li>
            <li><a href="faq.php">FAQ</a></li>
            <li><a href="how_do_i.php">How do I?</a></li>
          </ul>
        </div>        
    </div>
</div>