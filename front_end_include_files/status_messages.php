<?php if(isset($_GET['STATUS'])) {  
// Types of Message Boxes
//ShowNotificatonMessage(text);
//ShowErrorMessage(text);
//ShowWarningMessage(text);

switch ($_GET['STATUS']){
	case "USERNAMEORPASSWORDINCORRECT":
			$STATUSMESSAGE="Incorrect Username or Password";
			echo "<script type=\"text/javascript\">
                  $(document).ready(function() {
                    ShowErrorMessage(\"". $STATUSMESSAGE."\");	
                   });// End of document ready
                  </script>";
			break;
	case "LOGINFAILED":
			$STATUSMESSAGE="Failed Login Attempt";
			echo "<script type=\"text/javascript\">
                  $(document).ready(function() {
                    ShowErrorMessage(\"". $STATUSMESSAGE."\");	
                   });// End of document ready
                  </script>";
			break;	
			//SIGNUPSUCCESSFULL	
	case "SIGNUPSUCCESSFULL":
			$STATUSMESSAGE="Your Account has Been Successfully Created";
			echo "<script type=\"text/javascript\">
                  $(document).ready(function() {
                    ShowNotificatonMessage(\"". $STATUSMESSAGE."\");	
                   });// End of document ready
                  </script>";
			break;					
	default:
			$STATUSMESSAGE="Unknown Error";
			echo "<script type=\"text/javascript\">
                  $(document).ready(function() {
                    ShowErrorMessage(\"". $STATUSMESSAGE."\");	
                   });// End of document ready
                  </script>";			
	
}// End of SWITCH CASE
 
}// End of IF STATUS CHECK
?> 
 
 
 			