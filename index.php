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
<!-- login start -->	
<div data-role="page" id="login">
  <div data-role="header">
    <h1>התחבר</h1>
  </div>

  <div data-role="main" class="ui-content">
  		<form>
  			<label for="name">שם משתמש:</label>
  			<input type="text" name="name" id="name" value="" placeholder="שם משתמש" data-theme="a">
  			<label for="pass">סיסמה:</label>
  			<input type="password" name="pass" id="pass" value="" placeholder="סיסמה" data-theme="a">
  			<button type="submit" id="logbtn" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-check ui-btn-inline">התחבר</button>
  			<a href="#register" class="ui-btn ui-corner-all ui-btn-inline" style="float:left;">הרשם</a>
  		</form>
  		
  </div>

  <div data-role="footer">
   
  </div>
</div>
<!-- login end -->

<!-- register start -->	
<div data-role="page" id="register">
  <div data-role="header">
  	<a href="#login" class="ui-btn ui-corner-all ui-shadow ui-icon-back ui-btn-icon-left">אחורה</a>
    <h1>הרשם</h1>
  </div>
  <div data-role="main" class="ui-content">
  		<form>
  			<label for="name">שם משתמש:</label>
  			<input type="text" name="name" id="name" value="" placeholder="שם משתמש" data-theme="a">
  			<label for="pass">סיסמה:</label>
  			<input type="password" name="pass" id="pass" value="" placeholder="סיסמה" data-theme="a">
  			<label for="pass2">אימות סיסמה:</label>
  			<input type="password" name="pass2" id="pass2" value="" placeholder="אימות סיסמה" data-theme="a">
  			<button type="submit" id="regbtn" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-check">הרשם</button>
  		</form>
  </div>

  <div data-role="footer">
   
  </div>
</div>
<!-- register end -->

<!-- main page -->
<div data-role="page" id="mainpage">
  <div data-role="header">
    <h1>ספר המתכונים</h1>
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
  	<a href="#mainpage" class="ui-btn ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left">תפריט</a>
    <h1>הוסף מתכון חדש</h1>
    <a href="#search" class="ui-btn ui-corner-all ui-shadow ui-icon-search ui-btn-icon-left">חפש</a>
  </div>

  <div data-role="main" class="ui-content">
   		<form method="post" name="" action="">
		  	<label for="name">שם המתכון:</label>
		 	<input type="text" name="name" id="name" placeholder="שם המתכון..." data-clear-btn="true" >
		 	<label for="level">רמת קושי:</label>
  			<input type="range" name="level" id="level" value="5" min="0" max="10" data-hightlight="true">
  			<label for="desc">תיאור קצר:</label>
			<textarea name="desc" id="desc" placeholder="תיאור קצר..."></textarea>
			<label for="desc">מרכיבים:</label>
			<input type="button" id="addIng" data-inline="true" value="add ingredient" />
			<div id="ingredients-cont" data-role="fieldcontain">
			</div>
			<label for="orders">אופן הכנה:</label>
			<textarea name="orders" id="orders" placeholder="אופן הכנה..."></textarea>
			<input type="button" data-theme="b" name="submit" id="submit" value="הוסף">
		</form>
		<div data-role="popup" id="addIngredient" data-theme="a" class="ui-corner-all">
			<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
		    <form method="post" action=""> 
		        <div style="padding:10px 20px;">
		            <h3>הוסף רכיב חדש</h3>
		            <label for="un" class="ui-hidden-accessible">שם הרכיב:</label>
		            <input type="text" name="ingName" id="ingName" value="" placeholder="שם הרכיב" data-theme="a">
		            <button type="submit" id="ingsub" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-check">הוסף</button>
		        </div>
		    </form>
		</div>
		<div data-role="popup" id="addAmount" data-theme="a" class="ui-corner-all">
			<a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
		    <form method="post" action="">
		        <div style="padding:10px 20px;">
		            <h3>הוסף כמות חדשה</h3>
		            <label for="un" class="ui-hidden-accessible">שם הכמות:</label>
		            <input type="text" name="amountName" id="amountName" value="" placeholder="שם הכמות" data-theme="a">
		            <button type="submit" id="amsub" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-check">הוסף</button>
		        </div>
		    </form>
		</div>
  </div>

  <div data-role="footer">
   
  </div>
</div> 


<!-- search -->
<div data-role="page" id="search">
  <div data-role="header">
    <a href="#mainpage" class="ui-btn ui-corner-all ui-shadow ui-icon-home ui-btn-right ui-btn-icon-left">תפריט</a>
    <h1>חפש מתכונים</h1>
  </div>

  <div data-role="main" class="ui-content">
	<div class="ui-field-contain">
		<label for="searchInput">חפש מתכון:</label>
		<input type="search" name="search" id="searchInput" onkeyup="getResults(this.value)" placeholder="חפש מתכון...">
	</div>
	<ul data-role="listview" id='searchResults'> 

	</ul>	
  </div>

  <div data-role="footer">
   
  </div>
</div> 

<!-- end search -->

<!-- my recipes -->
<div data-role="page" id="myrecipes">
  <div data-role="header">
  	<a href="#mainpage" class="ui-btn ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left">תפריט</a>
    <h1>המתכונים המועדפים שלי</h1>
    <a href="#search" class="ui-btn ui-corner-all ui-shadow ui-icon-search ui-btn-icon-left">חפש</a>
  </div>
  <div data-role="main" class="ui-content">
    	<ul data-role="listview" id='myFavRecipes'> 
			
		</ul>	
  </div>

  <div data-role="footer">
  </div>
</div> 
<!-- end my recipes -->

<!-- my recipes -->
<div data-role="page" id="recipe" data-id="">
  <div data-role="header">
  	<a href="#mainpage" class="ui-btn ui-corner-all ui-shadow ui-icon-home ui-btn-icon-left">תפריט</a>
    <h1 id="name"></h1>
    <a href="#search" class="ui-btn ui-corner-all ui-shadow ui-icon-search ui-btn-icon-left">חפש</a>
  </div>
  <div data-role="main" class="ui-content">
  		<a href="#" class="fav ui-btn ui-icon-star ui-btn-icon-notext ui-corner-all ui-btn-inline" data-theme="c" >unfav</a>
    	<p id="description"></p>
    	<ul id="ing" style="list-style:disc">
    	</ul>
    	<p id="orders"></p>
  </div>

  <div data-role="footer">
  </div>
</div> 
<!-- end my recipes -->

</body>
</html>

