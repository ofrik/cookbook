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

<!-- main page -->
<div data-role="page" id="mainpage">
  <div data-role="header">
    <h1>ספר המתכונים</h1>
    <a href="#search" class="ui-btn ui-corner-all ui-shadow ui-icon-search ui-btn-icon-left">חפש</a>
  </div>

  <div data-role="main" class="ui-content">
  		<a href="#search" class="ui-btn ui-corner-all ">חפש מתכונים</a>
  		<a href="#myrecipes" data-transition="flow" class="ui-btn ui-corner-all ">המתכונים שלי</a>
    	<a href="#newrecipe" data-transition="flip" class="ui-btn ui-corner-all ">הוסף מתכון חדש</a>
  </div>

  <div data-role="footer">
   
  </div>
</div>
<!-- end main page -->

<!-- new recipe -->
<div data-role="page" id="newrecipe">
  <div data-role="header">
   <a href="#search" class="ui-btn ui-corner-all ui-shadow ui-icon-search ui-btn-icon-left">חפש</a>
    <h1>הוסף מתכון חדש</h1>
    
    <a href="#mainpage" class="ui-btn ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left">תפריט</a>
  </div>

  <div data-role="main" class="ui-content">
   		<form method="post" name="" action="">
		  	<label for="name">recipe name:</label>
		 	<input type="text" name="name" id="name" placeholder="recipe name..." data-clear-btn="true" >
		 	<label for="level">level:</label>
  			<input type="range" name="level" id="level" value="5" min="0" max="10" data-hightlight="true">
  			<label for="desc">description:</label>
			<textarea name="desc" id="desc"></textarea>
			<label for="orders">orders:</label>
			<textarea name="orders" id="orders"></textarea>
		</form>
  </div>

  <div data-role="footer">
   
  </div>
</div> 
<!-- new new recipe -->

<!-- my recipes -->
<div data-role="page" id="myrecipes">
  <div data-role="header">
    <a href="#search" class="ui-btn ui-corner-all ui-shadow ui-icon-search ui-btn-icon-left">חפש</a>
    <h1>המתכונים שלי</h1>
    
    <a href="#mainpage" class="ui-btn ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left">תפריט</a>
  </div>

  <div data-role="main" class="ui-content">
    <p>I Am Now A Mobile Developer!!</p>
  </div>

  <div data-role="footer">
   
  </div>
</div> 
<!-- end my recipes -->

<!-- search -->
<div data-role="page" id="search">
  <div data-role="header">
    <a href="#mainpage" class="ui-btn ui-corner-all ui-shadow ui-icon-home ui-btn-right ui-btn-icon-left">תפריט</a>
    <h1>חפש מתכונים</h1>
  </div>

  <div data-role="main" class="ui-content">
    <p>I Am Now A Mobile Developer!!</p>
  </div>

  <div data-role="footer">
   
  </div>
</div> 

<!-- end search -->

</body>
</html>

