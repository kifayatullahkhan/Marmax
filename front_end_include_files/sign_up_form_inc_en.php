    <div id="sign_up_form" class="round_borders">
    <div class="top_corner"> </div> 
    <div class="contant_wrapper"> 
         <form id="frmsignup" name="frmsignup" method="post" action="sign_up_form_process.php">
      
      <legend class="legend">User Sign Up</legend>
      <fieldset>
 	
    	<label>
        First Name
        <input type="text" name="FirstName" id="FirstName" accesskey="f" tabindex="1" placeholder="First Name"  />
        <div id="FirstNameValidation" class="validation_message"> </div>
      </label>
       <label>
        Last Name
        <input type="text" name="LastName" id="LastName" accesskey="n" tabindex="2" placeholder="Last Name"/>
        <div id="LastNameValidation" class="validation_message"> </div>
      </label>
      <br />
      <label>
        Your Email
        <input type="text" name="SignUpEmail" id="SignUpEmail" accesskey="e" tabindex="3" placeholder="Enter Email"  />
        <div id="SignUpEmailValidation" class="validation_message"> </div>
      </label>
       <label>
        Confirm Email
        <input type="text" name="SignUpConfirmEmail" id="SignUpConfirmEmail" accesskey="c" tabindex="4" placeholder="Confirm Email"/>
        <div id="SignUpConfirmEmailValidation" class="validation_message"> </div>
      </label>
      <br />
      <label>
         Password
        <input type="password" name="SignUpPassword" id="SignUpPassword" accesskey="p" tabindex="5" placeholder="Chose a Password" />
        <div id="SignUpPasswordValidation" class="validation_message"> </div>
      </label>
      
      <label>
        Confirm Password
        <input type="password" name="SignUpConfirmPassword" id="SignUpConfirmPassword" accesskey="o" tabindex="6" placeholder="Confirm the Password"/>
        <div id="SignUpConfirmPasswordValidation" class="validation_message"> </div>
      </label>      
      <label><input name="btnSubmit" type="submit" value="Login" class="button_misbah"   /></label>
      </fieldset>
      <input type="hidden" name="MM_insert" value="SignUp" />
      
    </div>
    <div class="bottom_corner"> </div>
    </div>
    
    
    
<!------- Start of Validation By Ghufran -------->
 
 <script type="text/javascript">
 
  function validate_FirstName(){
  if( $('#FirstName').val().length<=0 )  { 
  		$("#FirstNameValidation").removeClass("correct");
  		$("#FirstNameValidation").addClass("incorrect");
		ShowWarningMessage("Please Enter Your First Name"); 
		return false;
   }else{	
   		$("#FirstNameValidation").removeClass("incorrect");   
		$("#FirstNameValidation").addClass("correct");   
		return true;
   }// End of If	
}
 function validate_LastName(){
  if( $('#LastName').val().length<=0 )  { 
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
  if(!isValidEmailAddress( $('#SignUpEmail').val() ) ) { 
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
	 
	if(!isValidEmailAddress( $('#SignUpConfirmEmail').val() ) ) { 
  		$("#SignUpConfirmEmailValidation").removeClass("correct");
  		$("#SignUpConfirmEmailValidation").addClass("incorrect");
		ShowWarningMessage("Both the Email Address Must be the Same"); 
		return false;
   }else{	
   		$("#SignUpConfirmEmailValidation").removeClass("incorrect");   
		$("#SignUpConfirmEmailValidation").addClass("correct");  
		  
   }// End of If

  if($('#SignUpConfirmEmail').val()!=$('#SignUpEmail').val()){
        $("#SignUpConfirmEmailValidation").removeClass("correct");
  		$("#SignUpConfirmEmailValidation").addClass("incorrect");
		ShowWarningMessage("Both the Email Address Must be the Same");
		return false;
  }else
        return true;
}
function validate_SignUpPassword(){
	  if( $('#SignUpPassword').val().length<=0 ) { 
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
	  if(  $('#SignUpConfirmPassword').val().length<=0 ) { 
  		$("#SignUpConfirmPasswordValidation").removeClass("correct");
  		$("#SignUpConfirmPasswordValidation").addClass("incorrect");
		ShowWarningMessage("Passwords does not matches!");
		return false;
   }else{	
   		$("#SignUpConfirmPasswordValidation").removeClass("incorrect");   
		$("#SignUpConfirmPasswordValidation").addClass("correct");   
   }// End of If
  if($('#SignUpConfirmPassword').val()!=$('#SignUpPassword').val()){
        $("#SignUpConfirmPasswordValidation").removeClass("correct");
  		$("#SignUpConfirmPasswordValidation").addClass("incorrect");
		ShowWarningMessage("Passwords does not matches!");
		return false;
  }else
  		return true;
}


	$('#FirstName').blur(function() {
	validate_FirstName()
	
});
	
	
$('#LastName').blur(function() {
	validate_LastName()
	
});
$('#SignUpEmail').blur(function() {

	validate_email();
	

});
$('#SignUpConfirmEmail').blur(function() {
	validate_confirm_email();
	 

});
// For Password
$('#SignUpPassword').blur(function() {
	
	 validate_SignUpPassword();
	
}); 
$('#SignUpConfirmPassword').blur(function() {
	 validate_SignUpConfirmPassword();
	 
});


 $('#frmsignup').submit(function(e) { 
	    /*validate_email() ;
	    validate_confirm_email() ;
	    validate_SignUpPassword() ;
	    validate_SignUpConfirmPassword() 
		*/ 
        if (validate_FirstName() && validate_LastName() && validate_email() &&	validate_confirm_email() && validate_SignUpPassword() && validate_SignUpConfirmPassword()){
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