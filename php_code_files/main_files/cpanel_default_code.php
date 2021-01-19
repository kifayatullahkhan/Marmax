<div style="width:600px; background-color:#FFFFFF;">
 
  <!-- Container Area of the  Page Body Text-->
  <div id="PageBodyAreaforText"><br />
<div style="background-color:#FFFFFF">
    <?php if(GetAccessRightsForThisSection($_SESSION['MM_UserGroup'],1,$database_Conn,$Conn)>=1   || Get_Allow_Everyone_AccessessRights(1,$database_Conn,$Conn)>=1) {?>      
      <div id="CP_Usermanagement" class="CollapsiblePanel">
        <div class="CollapsiblePanelTab" tabindex="0">User Management</div>
        <div class="CollapsiblePanelContent"><br />
            <div align="center" class="CPanelTableView">
            <table border="0" cellspacing="10" cellpadding="0" class="DataEntryView">
              <tr>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="user_accounts.php"><img src="images/cpanel/add-user.png" alt="Manage User Account for the Software Login System" width="56" height="53" border="0" /><br />
                    User Accounts </a></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="user_groups.php"><img src="images/cpanel/add-group.png" alt="Manage  User Groups in the Software for Login system and Rights Assignment" width="56" height="53" border="0" /><br />
                    Groups</a></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="change_user_password.php"><img src="images/cpanel/change-user-password.png" alt="Change any User's Password" width="56" height="53" border="0" /><br />User Password</a></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="change_password.php"><img src="images/cpanel/change-password.png" alt="Change your Password" width="56" height="53" border="0" /><br />Change Passwd</a></div>
                </div></td>
              </tr>
              <tr>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="user_groups_accessrights.php"><img src="images/cpanel/add-zb1-module.png" alt="Change Group Access Rights to different modules of the application" width="56" height="53" border="0" /><br />
                    Access Rights</a></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="system_config.php"><img src="images/cpanel/scm.png" alt="System level configurations" width="56" height="53" border="0" /><br />
                    System Config</a></div>
                </div></td>
                <td align="center"><div class="roundedmenubox">
                  <div align="center"><a href="departments_management.php"><img src="images/cpanel/business_departments.gif" alt="Add Business Departments" width="56" height="53" border="0" /><br />
                     Departments</a></div>
                </div></td>
                <td align="center">&nbsp;</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <p>&nbsp;</p>   
      <?php  } // end of Group Based Show Area ?>

   
   
   
   
   
    <?php if(GetAccessRightsForThisSection($_SESSION['MM_UserGroup'],2,$database_Conn,$Conn)>=1   || Get_Allow_Everyone_AccessessRights(2,$database_Conn,$Conn)>=1) {?>  
       
      <a name="WebManagement" id="WebManagement"></a>
      <div id="CP_WebManagement" class="CollapsiblePanel">
        <div class="CollapsiblePanelTab" tabindex="0">Web Management</div>
        <div class="CollapsiblePanelContent">
          <div align="center" class="CPanelTableView">
            <table border="0" cellspacing="10" cellpadding="0">
              <tr>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="page_management_cms.php"><img src="images/cpanel/add-page.png" alt="Add New CMS Page to your web site." width="56" height="53" border="0" /><br />Add Page</a></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="page_management_cms_view_all.php"><img src="images/cpanel/view-pages.png" alt="View the List of dynamic Web Pages in your web site" width="55" height="53" border="0" /><br />
                    View Pages</a></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="page_management_cms_menu_builder.php"><img src="images/cpanel/sub-menu.png" alt="Build a Dynamic Menu List for Web Pages to be Accessable" width="55" height="53" border="0" /><br />
                    Menu Builder</a></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="page_management_cms_menu_builder_view_all.php"><img src="images/cpanel/top-menu.png" alt="View the List of dynamic menu" width="55" height="53" border="0" /><br />
                    Menu List</a></div>
                </div></td>
              </tr>
              <tr>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="page_visitors_comments.php"><img src="images/cpanel/add-edit-course.png" alt="Add New CMS Page to your web site." width="56" height="53" border="0" /><br />
                  Visitor's Comments</a></div>
                </div></td>
                <td align="center">&nbsp;</td>
                <td align="center">&nbsp;</td>
                <td align="center">&nbsp;</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <p>&nbsp;</p>       
       <?php  } // end of Group Based Show Area ?>








    <?php if(GetAccessRightsForThisSection($_SESSION['MM_UserGroup'],3,$database_Conn,$Conn)>=1   || Get_Allow_Everyone_AccessessRights(3,$database_Conn,$Conn)>=1) {?>       
       
      <a name="NewsManagement" id="NewsManagement"></a>
      <div id="CP_NewsManagement" class="CollapsiblePanel">
        <div class="CollapsiblePanelTab" tabindex="0">News &amp; Testimonials Management</div>
        <div class="CollapsiblePanelContent">
               <div align="center" class="CPanelTableView">
            <table border="0" cellspacing="10" cellpadding="0">
              <tr>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="news_addnew.php"><img src="images/cpanel/add-news.png" alt="Add Dynamic news content to your web site." width="56" height="53" border="0" /><br />
                    Add News</a></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="news_viewall.php"><img src="images/cpanel/view-news.png" alt="view the list of news added to the web site." width="56" height="53" border="0" /><br />
                    View News</a></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="testimonials_addnew.php"><img src="images/cpanel/add-testimonial.png" alt="add client testimomnials dynamic content to web site." width="56" height="53" border="0" /><br />
                    Add Testimonial</a></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="testimonials_viewall.php"><img src="images/cpanel/view-pages.png" alt="Manage client testimonal list" width="55" height="53" border="0" /><br />
                    View Testimonial</a></div>
                </div></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <p>&nbsp;</p>    
       <?php  } // end of Group Based Show Area ?>
            








    <?php if(GetAccessRightsForThisSection($_SESSION['MM_UserGroup'],4,$database_Conn,$Conn)>=1    || Get_Allow_Everyone_AccessessRights(4,$database_Conn,$Conn)>=1) {?>     
       
      <div id="ticket_admin" class="CollapsiblePanel">
        <div class="CollapsiblePanelTab" tabindex="0">Tickets System Administration</div>
        <div class="CollapsiblePanelContent">
             <div align="center" class="CPanelTableView">
          <table border="0" cellspacing="10" cellpadding="0">
            <tr>
              <td align="center"><div class="roundedmenubox">
                <div align="center"><a href="tickets_system_user_add_ticket.php"><img src="images/cpanel/submit-ticket.png" alt="Ticket System User Panel" width="56" height="53" border="0" /><br />
                  Submit Ticket</a></div>
              </div></td>
              <td align="center"><div class="roundedmenubox">
                <div align="center"><a href="tickets_system_admin_view_all_tickets.php"><img src="images/cpanel/view-ticket.png" alt="Ticket System User Panel" width="56" height="53" border="0" /><br />
                  View Tickets</a></div>
              </div></td>
              <td width="90" align="center">&nbsp;</td>
              <td width="90" align="center">&nbsp;</td>
              </tr>
          </table>
          </div>
        </div>
      </div>
      <p>&nbsp;  </p>
      <?php  } // end of Group Based Show Area ?>      
       








    <?php if(GetAccessRightsForThisSection($_SESSION['MM_UserGroup'],5,$database_Conn,$Conn)>=1    || Get_Allow_Everyone_AccessessRights(5,$database_Conn,$Conn)>=1) {?>  
	   
<div id="ticket_user" class="CollapsiblePanel">
        <div class="CollapsiblePanelTab" tabindex="0">Tickets System User's Support</div>
        <div class="CollapsiblePanelContent">
        <div align="center" class="CPanelTableView">
          <table border="0" cellspacing="10" cellpadding="0">
            <tr>
              <td width="90" align="center"><div class="roundedmenubox">
                <div align="center"><a href="tickets_system_user_add_ticket.php"><img src="images/cpanel/submit-ticket.png" alt="Ticket System User Panel" width="56" height="53" border="0" /><br />
                  Submit Ticket</a></div>
              </div></td>
              <td width="90" align="center"><div class="roundedmenubox">
                <div align="center"><a href="tickets_system_user_view_all_tickets.php"><img src="images/cpanel/view-tickets.png" alt="Ticket System User Panel" width="56" height="53" border="0" /><br />
                  View Tickets</a></div>
              </div></td>
              <td width="90" align="center"><div class="roundedmenubox"></div></td>
              <td width="90" align="center"><div class="roundedmenubox"></div></td>
              </tr>
          </table>
          </div>
        </div>
      </div>
      <p>&nbsp;</p>  
      <?php  } // end of Group Based Show Area ?>      
      






    <?php if(GetAccessRightsForThisSection($_SESSION['MM_UserGroup'],6,$database_Conn,$Conn)>=1    || Get_Allow_Everyone_AccessessRights(6,$database_Conn,$Conn)>=1) {?>  
       
<div id="financial_mgmt_expenses" class="CollapsiblePanel">
  <div class="CollapsiblePanelTab" tabindex="0">Financial Management (Expenses and Employee Record)</div>
        <div class="CollapsiblePanelContent">
         <div align="center" class="CPanelTableView">
            <table border="0" cellspacing="10" cellpadding="0">
              <tr>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="financial_expenses_details.php"><img src="images/cpanel/add-new-expense.png" alt="Ticket System User Panel" width="56" height="53" border="0" /><br />
                    Expenses</a></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="financial_expenses_accounts_heads.php"><img src="images/cpanel/add-new-exp-account.png" alt="Ticket System User Panel" width="56" height="53" border="0" /><br />
                    
                    Expenses Head/Category</a></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="financial_expenses_details.php"><img src="images/cpanel/view-expenses.png" alt="Ticket System User Panel" width="56" height="53" border="0" /><br />
                    View<br />
                    Expenses</a></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="financial_expenses_details_report.php"><img src="images/cpanel/view-specific-date-expenses-report.png" alt="Ticket System User Panel" width="56" height="53" border="0" /><br />
                    Expenses Report</a></div>
                </div></td>
              </tr>
              <tr>
                <td align="center"><div class="roundedmenubox">
                  <div align="center"><a href="financial_bank_statement.php"><img src="images/cpanel/add-new-expense.png" alt="Ticket System User Panel" width="56" height="53" border="0" /><br />
                    Banks</a></div>
                </div></td>
                <td align="center"><div class="roundedmenubox">
                  <div align="center"><a href="financial_bank_deposits.php"><img src="images/cpanel/view-expenses.png" alt="Ticket System User Panel" width="56" height="53" border="0" /><br />
                    Bank Deposits</a></div>
                </div></td>
                <td align="center"><div class="roundedmenubox">
                  <div align="center"><a href="financial_bank_withdrawls.php"><img src="images/cpanel/view-expenses.png" alt="Ticket System User Panel" width="56" height="53" border="0" /><br />
                    Bank Withdrawls</a></div>
                </div></td>
                <td align="center"><div class="roundedmenubox">
                  <div align="center"><a href="financial_bank_statement.php"><img src="images/cpanel/view-expenses.png" alt="Ticket System User Panel" width="56" height="53" border="0" /><br />
                    Bank Statement</a></div>
                </div></td>
              </tr>
            </table>
          </div>
        </div>
    </div>
    <p>&nbsp;</p>
       <?php  } // end of Group Based Show Area ?>    

  
  
  
  
      
       
    <?php if(GetAccessRightsForThisSection($_SESSION['MM_UserGroup'],7,$database_Conn,$Conn)>=1    || Get_Allow_Everyone_AccessessRights(7,$database_Conn,$Conn)>=1) {?>  
<div id="file_sharing" class="CollapsiblePanel">
        <div class="CollapsiblePanelTab" tabindex="0">File Sharing</div>
        <div class="CollapsiblePanelContent">
           <div align="center" class="CPanelTableView">
            <table border="0" cellspacing="10" cellpadding="0">
              <tr>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="file_sharing_add_new_folder.php"><img src="images/cpanel/add-new-folder.png" alt="Ticket System User Panel" width="56" height="53" border="0" /><br />
                    Add New<br />
                    Folder</a></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="file_sharing_upload_files.php"><img src="images/cpanel/upload-file.png" alt="Ticket System User Panel" width="56" height="53" border="0" /><br />
                    Upload File</a></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="file_sharing_view_shared_files.php"><img src="images/cpanel/view-file.png" alt="Ticket System User Panel" width="56" height="53" border="0" /><br />
                    View Files</a></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="file_sharing_view_public_shared_files.php"><img src="images/cpanel/view-file.png" alt="Ticket System User Panel" width="56" height="53" border="0" /><br />
                    View Public Files</a></div>
                </div></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <p>&nbsp;</p>      
       
       <?php  } // end of Group Based Show Area ?>
       







    <?php if(GetAccessRightsForThisSection($_SESSION['MM_UserGroup'],8,$database_Conn,$Conn)>=1    || Get_Allow_Everyone_AccessessRights(8,$database_Conn,$Conn)>=1) {?>  
  
      <div id="extra_tools" class="CollapsiblePanel">
        <div class="CollapsiblePanelTab" tabindex="0">Extra Tools</div>
        <div class="CollapsiblePanelContent">
           <div align="center" class="CPanelTableView">
            <table border="0" cellspacing="10" cellpadding="0">
              <tr>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="picture_gallery.php"><img src="images/cpanel/upload-pictures.png" alt="Ticket System User Panel" width="56" height="53" border="0" /><br />
                    Upload<br />
                    Pictures</a></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="picture_gallery_view.php"><img src="images/cpanel/view-gallery.png" alt="Ticket System User Panel" width="56" height="53" border="0" /><br />
                    View<br />
                    Gallery</a></div>
                </div></td>
                <td width="90" align="center"><div align="center"></div></td>
                <td width="90" align="center"><div class="roundedmenubox"></div></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    <p>&nbsp;</p>       
       <?php  } // end of Group Based Show Area ?>
  
  
  <?php if(GetAccessRightsForThisSection($_SESSION['MM_UserGroup'],24,$database_Conn,$Conn)>=1    || Get_Allow_Everyone_AccessessRights(8,$database_Conn,$Conn)>=1) {?>  
  
      <div id="Job_Employer_Panel" class="CollapsiblePanel">
        <div class="CollapsiblePanelTab" tabindex="0">Jobs Admin (Employer Panel)</div>
        <div class="CollapsiblePanelContent">
           <div align="center" class="CPanelTableView">
            <table border="0" cellspacing="10" cellpadding="0">
              <tr>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="job_details.php"><img src="images/cpanel/add-employee.png" alt="Announce New Job" width="56" height="53" border="0" /><br />
                     Publish Jobs</a></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="job_admin_resume_search.php"><img src="images/cpanel/view-gallery.png" alt="Ticket System User Panel" width="56" height="53" border="0" /><br />
                    View<br />
                    Resumes</a></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="job_admin_resume_search.php"><img src="images/cpanel/view-file.png" alt="Ticket System User Panel" width="56" height="53" border="0" /><br />
                    Short List<br />
                    Candidates</a></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="job_admin_resume_search.php"><img src="images/cpanel/view-tickets.png" alt="Ticket System User Panel" width="56" height="53" border="0" /><br />
                    Hire a<br />
                    Candidates</a></div>
                </div></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    <p>&nbsp;</p>       
       <?php  } // end of Group Based Show Area ?>
  
  
  
  
  
  <?php if(GetAccessRightsForThisSection($_SESSION['MM_UserGroup'],25,$database_Conn,$Conn)>=1    || Get_Allow_Everyone_AccessessRights(8,$database_Conn,$Conn)>=1) {?>  
  
      <div id="Job_Seeker_Panel" class="CollapsiblePanel">
        <div class="CollapsiblePanelTab" tabindex="0">Job Seeker Panel</div>
        <div class="CollapsiblePanelContent">
           <div align="center" class="CPanelTableView">
            <table border="0" cellspacing="10" cellpadding="0">
              <tr>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="job_seeker_search.php"><img src="images/cpanel/add-employee.png" alt="Announce New Job" width="56" height="53" border="0" /><br />
                     Search Jobs</a></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="job_seeker_update_resume.php"><img src="images/cpanel/upload-pictures.png" alt="Ticket System User Panel" width="56" height="53" border="0" /><br />
                    Update<br />
                    Resume</a></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox">
                  <div align="center"><a href="job_seeker_my_jobs_list.php"><img src="images/cpanel/view-gallery.png" alt="Ticket System User Panel" width="56" height="53" border="0" /><br />
                    My Jobs List</a></div>
                </div></td>
                <td width="90" align="center"><div class="roundedmenubox"></div></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    <p>&nbsp;</p>       
       <?php  } // end of Group Based Show Area ?>
  
                              
    
                              
    </div>
  </div>
</div>
<script type="text/javascript">
	var CP_Usermanagement = new Spry.Widget.CollapsiblePanel("CP_Usermanagement");
	var CP_WebManagement = new Spry.Widget.CollapsiblePanel("CP_WebManagement");
	var CP_NewsManagement = new Spry.Widget.CollapsiblePanel("CP_NewsManagement");
	var ticket_admin = new Spry.Widget.CollapsiblePanel("ticket_admin");
	var ticket_user = new Spry.Widget.CollapsiblePanel("ticket_user");	
	var financial_mgmt_expenses = new Spry.Widget.CollapsiblePanel("financial_mgmt_expenses");		
	var file_sharing = new Spry.Widget.CollapsiblePanel("file_sharing");	
	var extra_tools = new Spry.Widget.CollapsiblePanel("extra_tools");	
	var Job_Employer_Panel = new Spry.Widget.CollapsiblePanel("Job_Employer_Panel");	
	var Job_Seeker_Panel = new Spry.Widget.CollapsiblePanel("Job_Seeker_Panel");
	
	
</script>
