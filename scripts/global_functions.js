// Kifayat Ullah JavaScript Global Functions
function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
    return pattern.test(emailAddress);
};

/*
if( !isValidEmailAddress( emailaddress ) ) { // do stuff here }
*/

// Force All the Fields to auto Selcect Text on focus
$(document).ready(function(){
		$("input, textarea").focus(
			 function()
			 {
				 $(this).select(); 
			 }
		)
});

// The following functions are used to display notifcations on top of the page.

function ShowNotificatonMessage(vTextToDisplay){
	vTextToDisplay="<dic class=\"notification_icon\">&nbsp</div>&nbsp;&nbsp;&nbsp;&nbsp;"+vTextToDisplay
	$("#notification").html(vTextToDisplay);
	$("#notification").show();
	$('#notification').delay(5000).fadeOut();
}
function ShowErrorMessage(vTextToDisplay){
	vTextToDisplay="<dic class=\"error_icon\">&nbsp</div>&nbsp;&nbsp;&nbsp;&nbsp;"+vTextToDisplay
	$("#error").html(vTextToDisplay);
	$("#error").show();
	$('#error').delay(5000).fadeOut();
}

function ShowWarningMessage(vTextToDisplay){
	vTextToDisplay="<dic class=\"warning_icon\">&nbsp</div>&nbsp;&nbsp;&nbsp;&nbsp;"+vTextToDisplay
	$("#warning").html(vTextToDisplay);
	$("#warning").show();
	$('#warning').delay(5000).fadeOut();
}