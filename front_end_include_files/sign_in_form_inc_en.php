    <div id="sign_in_form" class="round_borders">
    <div class="top_corner"> </div> 
    <div class="contant_wrapper"> 
             
     <form id="frmsignin" name="frmsignin" method="post" action="check_sign_in.php">
      <legend class="legend">User Sign In</legend>
      <fieldset>
 
      <label>
        Your Email
        <input type="text" name="SigninEmail" id="SigninEmail" accesskey="f" tabindex="1" />
        <div id="EmailAddressValidation" class="validation_message"> </div>        
      </label>
      <label>
         Your Password
        <input type="password" name="SigninPassword" id="SigninPassword" accesskey="p" tabindex="2" />   
        <div id="PasswordValidation" class="validation_message"> </div>       
      </label>
      <label><input name="btnSubmit" type="submit" value="Login" class="button_misbah" /></label>
      </fieldset>
      </form>
 
			 </div>

       <div class="bottom_corner"> </div>
     </div>

<script type="text/javascript">
 
function validate_sign_in_email(){
	 
  if(!isValidEmailAddress( $('#SigninEmail').val() ) ) { 
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
	  if( $('#SigninPassword').val().length<=0 ) { 
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


 $('#frmsignin').submit(function(e) {   

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