<div id="SearchMenuBar">
	<div id="SearchBox">
    <form action="index.php" method="get" enctype="application/x-www-form-urlencoded" name="frmSearchBox" id="frmSearchBox">
    <input name="SearchBoxText" id="SearchBoxText" type="text" value="<?php echo trim(isset($_GET['SearchBoxText'])?  $_GET['SearchBoxText'] : "");?>">
	 <?php
 		if(isset($_GET['CONTENT_TYPE']) ){	 
	?>
    <input name="CONTENT_TYPE" type="hidden" value="<?php echo$_GET['CONTENT_TYPE']; ?>">
	<?php
     }
    ?>       
    <input name="BtnSearch" type="submit" value="بحث">
    </form>
  </div>

<div class="MenuButton">
  <a href="#" ButtonName="ChooseCategory"> إختر الفئة</a></div>
</div>
<script type="text/javascript">
$(".MenuButton a").click(function(event) {
	 event.preventDefault();
   $("#DropDownMenu").fadeToggle("slow", "linear");
    $('body,html').animate({
				scrollTop: 150
			}, 800);
});
</script>