
//Define the messages types using an array:

var myMessages = ['info','warning','error','success','loginfailed'];


/*
The below function hides the notification messages. Messages could have dynamic heights and for that, each message's height is calculated in order to hide it properly.

*/
function hideAllMessages()
{
                 var messagesHeights = new Array(); // this array will store height for each

                 for (i=0; i<myMessages.length; i++)
                 {
                                  messagesHeights[i] = $('.' + myMessages[i]).outerHeight(); // fill array
                                  $('.' + myMessages[i]).css('top', -messagesHeights[i]); //move element outside viewport
                 }
}





//The showMessage function is called when document ready.


function showMessage(type)
{
        $('.'+ type +'-trigger').click(function(){
                  hideAllMessages();
                  $('.'+type).animate({top:"0"}, 500);
        });
}


//On page load, first of all we'll hide all the messages: hideAllMessages(). Then, for each trigger, show the equivalent message:


$(document).ready(function(){

                 // Initially, hide them all
                 hideAllMessages();

                 // Show message
                 for(var i=0;i<myMessages.length;i++)
                 {
                        showMessage(myMessages[i]);
                 }

                 // When message is clicked, hide it
                 $('.message').click(function(){
                                  $(this).animate({top: -$(this).outerHeight()}, 500);
                  });            

});


function showMessageLoginFailed()
{
         
                  hideAllMessages();
                  $('.loginfailed').animate({top:"0"}, 500);
     
}

function showMessageSuccessFull()
{
         
                  hideAllMessages();
                  $('.success').animate({top:"0"}, 500);
     
}



//jQuery Plugin to Find Query String Variables values values
// Usage:  $.QueryString["param"]


(function($) {
    $.QueryString = (function(a) {
        if (a == "") return {};
        var b = {};
        for (var i = 0; i < a.length; ++i)
        {
            var p=a[i].split('=');
            if (p.length != 2) continue;
            b[p[0]] = decodeURIComponent(p[1].replace(/\+/g, " "));
        }
        return b;
    })(window.location.search.substr(1).split('&'))
})(jQuery);

