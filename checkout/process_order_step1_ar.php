<!-- Start of Data Entry Form -->
<div class="DataEntryForm">
  
  <!-- Start of MemberLoginForm -->
  <div class="NewMemberLoginForm">

<div class="box_like_section_wrapper">
<h2>الاشتراك مستخدم</h2>
         
  <form id="frmsignupCheckOut" name="frmsignup" method="post" action="sign_up_form_process.php<?php 
   if (isset($_SERVER['QUERY_STRING'])) {
   echo  "?" . htmlentities($_SERVER['QUERY_STRING']);
   }

  ?>">
     

        <table width="100%" border="0" cellspacing="5" cellpadding="5">
        
          <tr>
            <td><input type="text" name="FirstName" id="FirstName1" accesskey="f" tabindex="1" placeholder="الاسم الاول"  /></td>
            <div id="FirstNameValidation" class="validation_message"> </div>
            <td><input type="text" name="LastName" id="LastName1" accesskey="l" tabindex="2" placeholder="الاسم الاخير"/></td>
          	<div id="LastNameValidation" class="validation_message"> </div>
          </tr>
          <tr>
            <td width="50%"><input type="text" name="SignUpEmail" id="SignUpEmail1" accesskey="e" tabindex="3" placeholder="البريد الإلكتروني"  /></td>
            <div id="SignUpEmailValidation" class="validation_message"> </div>
            <td width="50%"><input type="text" name="SignUpConfirmEmail" id="SignUpConfirmEmail1" accesskey="c" tabindex="4" placeholder="تأكيد البريد الإلكتروني"/></td>
          	<div id="SignUpConfirmEmailValidation" class="validation_message"> </div>
          </tr>
          <tr>
            <td><input type="password" name="SignUpPassword" id="SignUpPassword1" accesskey="p" tabindex="5" placeholder="كلمة السر" /></td>
            <div id="SignUpPasswordValidation" class="validation_message"> </div>
            <td><input type="password" name="SignUpConfirmPassword" id="SignUpConfirmPassword1" accesskey="o" tabindex="6" placeholder="تأكيد كلمة السر"/></td>
         	<div id="SignUpConfirmPasswordValidation" class="validation_message"> </div>
          </tr>
          <tr>
            <td colspan="2" align="center" valign="middle"><input name="btnSubmit2" type="submit" tabindex="7" value="تسجيل" class="button_misbah" /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
   
 

      <input type="hidden" name="MM_insert" value="SignUp" />
      <input type="hidden" name="checkout_process" value="true" />
      <input type="hidden" name="checkout_step1" value="true" />
    </form>
  </div>
</div>
 <!-- End of MemberLoginForm --> 
  
   <!------- Start of Validation By Ghufran -------->
 
 <script type="text/javascript">
   function validate_FirstName(){
  if( $('#FirstName1').val().length<=0 )  { 
  		$("#FirstName1Validation").removeClass("correct");
  		$("#FirstName1Validation").addClass("incorrect");
		ShowWarningMessage("Please Enter Your First Name"); 
		return false;
   }else{	
   		$("#FirstNameValidation").removeClass("incorrect");   
		$("#FirstNameValidation").addClass("correct");   
		return true;
   }// End of If	
}
 function validate_LastName(){
  if( $('#LastName1').val().length<=0 )  { 
  		$("#LastNameValidation").removeClass("correct");
  		$("#LastNameValidation").addClass("incorrect");
		ShowWarningMessage("Please Enter Your Last Name"); 
		return false;
   }else{	
   		$("#LastNameValidation").removeClass("incorrect");   
		$("#LastNameValidation").addClass("correct");   
		return true;
   }// End of If	
}

 
 
 function validate_email(){
  if(!isValidEmailAddress( $('#SignUpEmail1').val() ) ) { 
  		$("#SignUpEmailValidation").removeClass("correct");
  		$("#SignUpEmailValidation").addClass("incorrect");
		ShowWarningMessage("Please Enter valid Email Address"); 
		return false;
   }else{	
   		$("#SignUpEmailValidation").removeClass("incorrect");   
		$("#SignUpEmailValidation").addClass("correct");   
		return true;
   }// End of If	
}
function validate_confirm_email(){
	 
	if(!isValidEmailAddress( $('#SignUpConfirmEmail1').val() ) ) { 
  		$("#SignUpConfirmEmailValidation").removeClass("correct");
  		$("#SignUpConfirmEmailValidation").addClass("incorrect");
		ShowWarningMessage("Both the Email Address Must be the Same");
		return false;
   }else{	
   		$("#SignUpConfirmEmail1Validation").removeClass("incorrect");   
		$("#SignUpConfirmEmail1Validation").addClass("correct");  
		  
   }// End of If

  if($('#SignUpConfirmEmail1').val()!=$('#SignUpEmail1').val()){
        $("#SignUpConfirmEmailValidation").removeClass("correct");
  		$("#SignUpConfirmEmailValidation").addClass("incorrect");
		ShowWarningMessage("Both the Email Address Must be the Same");
		return false;
  }else
        return true;
}
function validate_SignUpPassword(){
	  if( $('#SignUpPassword1').val().length<=0 ) { 
  		$("#SignUpPasswordValidation").removeClass("correct");
  		$("#SignUpPasswordValidation").addClass("incorrect");
		ShowWarningMessage("Please Enter The Password");
		return false;
   }else{	
   		$("#SignUpPasswordValidation").removeClass("incorrect");   
		$("#SignUpPasswordValidation").addClass("correct");  
		return true; 
   }// End of If
}

function validate_SignUpConfirmPassword() {
	  if(  $('#SignUpConfirmPassword1').val().length<=0 ) { 
  		$("#SignUpConfirmPasswordValidation").removeClass("correct");
  		$("#SignUpConfirmPasswordValidation").addClass("incorrect");
		ShowWarningMessage("Passwords does not matchese");
		return false;
   }else{	
   		$("#SignUpConfirmPasswordValidation").removeClass("incorrect");   
		$("#SignUpConfirmPasswordValidation").addClass("correct");   
   }// End of If
  if($('#SignUpConfirmPassword1').val()!=$('#SignUpPassword1').val()){
        $("#SignUpConfirmPasswordValidation").removeClass("correct");
  		$("#SignUpConfirmPasswordValidation").addClass("incorrect");
		ShowWarningMessage("Passwords does not matches!");
		return false;
  }else
  		return true;
}


$('#FirstName1').blur(function() {
	validate_FirstName()
	
});	
$('#LastName1').blur(function() {
	validate_LastName()
	
});
$('#SignUpEmail1').blur(function() {
	
	validate_email();
	
});
$('#SignUpConfirmEmail1').blur(function() {
	validate_confirm_email();  
	
});
// For Password
$('#SignUpPassword1').blur(function() {
	
	 validate_SignUpPassword();

}); 
$('#SignUpConfirmPassword1').blur(function() {
	 validate_SignUpConfirmPassword();
	 
});


 $('#frmsignupCheckOut').submit(function(e) { 
 
		/*validate_FirstName();
		validate_LastName();
	    validate_email() ;
	    validate_confirm_email() ;
	    validate_SignUpPassword() ;
	    validate_SignUpConfirmPassword() 
		*/ 
        if (validate_FirstName()&& validate_LastName() && validate_email() &&	validate_confirm_email() && validate_SignUpPassword() && validate_SignUpConfirmPassword()){
		// All Fields are Valid
		return true;
		}
		else 
		{
        ShowWarningMessage("Please make sure that all fields are filled properly.");			
		return false;  
		}
})


$(document).ready(function() {


});// End of document ready
</script>      

 <!-------End Of Validation By Ghufran ----------->

  
  
  <!-- Start of ExistingMemberLoginForm -->
  <div class="ExistingMemberLoginForm">

   <div class="box_like_section_wrapper"> 
   <h2>تسجيل الدخول المستخدم</h2>
   <form id="frmsigninCheckout" name="frmsignin" method="post" action="check_sign_in.php<?php 
   if (isset($_SERVER['QUERY_STRING'])) {
   echo  "?" . htmlentities($_SERVER['QUERY_STRING']);
   }

  ?>">
   <table width="100%" border="0" cellspacing="5" cellpadding="5">
     <tr>
       <td><input type="text" name="SigninEmail" id="SigninEmail1" accesskey="f" tabindex="8" placeholder="البريد الإلكتروني" /></td>
     	<div id="SigninEmailValidation" class="validation_message"> </div>
     </tr>
     <tr>
       <td><input type="password" name="SigninPassword" id="SigninPassword1" accesskey="p" tabindex="9" placeholder="كلمة السر"/></td>
     	<div id="SigninPasswordValidation" class="validation_message"> </div>
     </tr>
     <tr>
       <td><input name="btnSubmit" type="submit" tabindex="10" value="دخول" class="button_misbah" /></td>
     </tr>
     <tr>
       <td>&nbsp;</td>
     </tr>
     </table>
        <input type="hidden" name="checkout_process" value="true" />
    </form>
    </div>

 
  </div>
  <!-- End of ExistingMemberLoginForm -->
  
</div>
<!-- End of Data Entry Form -->

<script type="text/javascript">
 
function validate_sign_in_email(){
	 
  if(!isValidEmailAddress( $('#SigninEmail1').val() ) ) { 
  		$("#SigninEmailAddressValidation").removeClass("correct");
  		$("#SigninEmailAddressValidation").addClass("incorrect");
		return false;
   }else{	
   		$("#SigninEmailAddressValidation").removeClass("incorrect");   
		$("#SigninEmailAddressValidation").addClass("correct");   
		return true;
   }// End of If	
}
function validate_SigninPassword(){
	  if( $('#SigninPassword1').val().length<=0 ) { 
  		$("#SigninPasswordValidation").removeClass("correct");
  		$("#SigninPasswordValidation").addClass("incorrect");
		return false;
   }else{	
   		$("#SigninPasswordValidation").removeClass("incorrect");   
		$("#SigninPasswordValidation").addClass("correct");  
		return true; 
   }// End of If
}




$('#SigninEmail').blur(function() {
	
	validate_sign_in_email();

});

// For Password
$('#SigninPassword').blur(function() {
	
	 validate_SigninPassword();

}); 

 $('#frmsigninCheckout').submit(function(e) {   
validate_sign_in_email();
		validate_SigninPassword();
        if (validate_sign_in_email() &&	validate_SigninPassword()){
		// All Fields are Valid
		return true;
		}
		else 
		{
        ShowWarningMessage("Please provide the correct username and password.");			
		return false;  
		}
})


$(document).ready(function() {


});// End of document ready
</script>    


 
