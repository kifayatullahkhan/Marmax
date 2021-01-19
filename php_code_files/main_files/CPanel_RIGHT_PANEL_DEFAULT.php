
  <div id="column">
    <div class="subnav">
      <h2>Details</h2>
		<ul>
            <li><a href="change_password.php">Change Your Password</a></li>
        	<li><a href="user_profile.php">Update Your Profile</a>
            </li>
       	  <li><a href="tickets_system_user_add_ticket.php">Submit Support Ticket</a></li>
        </ul>
    </div>
    <div class="holder">
    	<h2>News Feed</h2>
        <marquee direction="up" scrollamount="2">
        <?php require_once("include_code/news_feed_loader.php"); ?>
        </marquee>
    </div>
    <div id="featured">
      <ul>
        <li>
          <h2>Statistics</h2>
          <p class="imgholder">&nbsp;</p>
          <p>&nbsp;</p>
        </li>
      </ul>
    </div>
    <div class="holder">
      <h2>Support</h2>
      <p>if you are havining diffeculty in accessing your System or you may need support from our support engineers please follow the instructions provided on the link below.</p>
      <p> <a href="http://www.zorkif.com/support.php">Click here to get support</a>.</p>
    </div>
  </div>
  