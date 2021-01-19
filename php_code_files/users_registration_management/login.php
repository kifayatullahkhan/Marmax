<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Zorkif Business One [User Login]</title>
<link rel="stylesheet" type="text/css" href="login.css"/>
<script type="text/javascript" src="../../scripts/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="../../scripts/message_notifications/message_notifications_jquery.js"></script> 
 <link rel="stylesheet" type="text/css" href="../../scripts/message_notifications/message_notifications.css"/>
</head>

<body>
<div class="container">



    <div class="login_form">
    
    
          <div id="login_form_header">
              <div id="zorkif_business_one_logo"><img src="../../images/sign_in/zorkif_business_one_logo.png" width="200" height="78" />
              </div>
              
              <div id="title_text"> 
              Developed By: Kifayat Ullah
              </div>
          </div>
      
      
          <div id="user_image">
            <img src="../../images/sign_in/user.png" width="256" height="256" />
          </div>
          
          <div id="login_form_filed_view">
           <form action="chk_login.php" method="post" enctype="multipart/form-data" name="frmLogin">
           <div class="FormElementWrapper">
           <strong>Username</strong><br />
           <input name="Username" type="text" class="text_filed"/>           
           </div>
           <div class="FormElementWrapper">
           <strong>Password</strong><br />
           <input name="Password" type="password" class="text_filed" />           
           </div>
           
           <div class="FormElementWrapper">
            
           <input name="BtnSubmit" type="Submit" class="button" value="Login" />           
           </div>
           
           
           </form>
          
          </div>
          
          
    </div>
    
      
    
    

</div>​
<?php require_once("../../scripts/message_notifications/message_notifications.php"); ?>
<script type="text/javascript">
     if ($.QueryString["STATUS"]=='LOGINFAILED') showMessageLoginFailed();
</script>

</body>
</html>