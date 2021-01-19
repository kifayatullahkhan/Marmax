             <div id="UserAccountMenu"><a href="index.php?page_name=user_profile"><?php echo $_SESSION['MM_FullName']; ?></a> <a id="UserDetailsMenu"> </a>
                 <div id="UserDetailsMenuList">
                         <ul>
                         	<li> 
                                  <div id="account_settings_icon"> </div>
                                  <div class="cpanel_link_title"> 
                                  <a class="iframe" href="index.php?page_name=user_profile">صفحة المستخدم</a></div>
                         	</li>
                           <li>
                                 <div id="change_password_icon"> </div>
                                 <div class="cpanel_link_title"><a href="index.php?page_name=user_change_password">تغيير كلمة المرور</a></div>
                            </li>
                           <li>
                                 <div id="shopping_cart_icon"> </div>
                                 <div class="cpanel_link_title"><a href="index.php?page_name=show_my_orders">عرض الطلبات</a></div>
                            </li>
                           <li class="last"> 
                                 <div id="sign_out_icon"> </div>
                                 <div class="cpanel_link_title"><a href="sign_out.php">خروج</a></div>
                            </li>
                         </ul>
                 </div>
             </div>