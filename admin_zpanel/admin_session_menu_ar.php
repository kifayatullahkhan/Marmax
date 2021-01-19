             <div id="UserAccountMenu"><a class="iframe" href="admin_zpanel_en.php"><?php echo $_SESSION['MM_Firstname'] ." " .$_SESSION['MM_Lastname']; ?></a> <a id="UserDetailsMenu"> </a>
                 <div id="UserDetailsMenuList">
                         <ul>
                         	<li> 
                                  <div id="account_settings_icon"> </div>
                                  <div class="cpanel_link_title"> 
                                  <a class="iframe" href="admin_zpanel.php">Control Panel</a></div>
                         	</li>
                           <li>
                                 <div id="change_password_icon"> </div>
                                 <div class="cpanel_link_title"><a href="admin_zpanel.php?page_name=admin_change_password">Change Password</a></div>
                            </li>
                           <li>
                                 <div id="shopping_cart_icon"> </div>
                                 <div class="cpanel_link_title"><a href="dmin_zpanel.php?page_name=admin_change_users_password">Change User Password</a></div>
                            </li>
                           <li class="last"> 
                                 <div id="sign_out_icon"> </div>
                                 <div class="cpanel_link_title"><a href="sign_out.php">Sign Out</a></div>
                            </li>
                         </ul>
                 </div>
             </div>