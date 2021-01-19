<?php require_once("news_feed_loader_ar.php"); ?>
<script type="text/javascript">
$(function () {
    $('#js-news').ticker({
        speed: 0.08,           // The speed of the reveal
        ajaxFeed: false,       // Populate jQuery News Ticker via a feed
        feedUrl: false,        // The URL of the feed
	                       // MUST BE ON THE SAME DOMAIN AS THE TICKER
        feedType: 'xml',       // Currently only XML
        htmlFeed: true,        // Populate jQuery News Ticker via HTML
        debugMode: true,       // Show some helpful errors in the console or as alerts
  	                       // SHOULD BE SET TO FALSE FOR PRODUCTION SITES!
        controls: false,        // Whether or not to show the jQuery News Ticker controls
        titleText: '',   // To remove the title set this to an empty String
        displayType: 'fade', // Animation type - current options are 'reveal' or 'fade'
        direction: 'rtl',       // Ticker direction - current options are 'ltr' or 'rtl'
        pauseOnItems: 3000,    // The pause on a news item before being replaced
        fadeInSpeed: 800,      // Speed of fade in animation
        fadeOutSpeed: 500      // Speed of fade out animation
	});
});
</script>