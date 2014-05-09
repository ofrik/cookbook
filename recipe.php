<?
require_once "class/recipe.php";
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="UTF-8" />
<link rel="stylesheet" href="css/themes/default/rtl.jquery.mobile-1.4.0.css">
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" charset="utf-8"/>
<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="js/rtl.jquery.mobile-1.4.0.js"></script>
<script src="js/js.js" type="text/javascript" charset="utf-8"></script>
</head>
<body>


<!-- my recipes -->
<div data-role="page" id="recipe">
  <div data-role="header">
    <a href="index.php#search" class="ui-btn ui-corner-all ui-shadow ui-icon-search ui-btn-icon-left">חפש</a>
    <h1></h1>
    <a href="index.php#mainpage" class="ui-btn ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left">תפריט</a>
  </div>
  <div data-role="main" class="ui-content">
    	<p id="descrition"></p>
    	<p id="orders"></p>
  </div>

  <div data-role="footer">
   
  </div>
</div> 
<!-- end my recipes -->


<!-- end search -->

</body>
</html>

