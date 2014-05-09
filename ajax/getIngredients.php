<?
include_once '../class/ingredient.php';

if(isset($_POST)) {
	$action = $_POST['action'];
	if($action=='getIngredients'){
		$ingredient = new Ingredient();
		$ingredients = $ingredient->getAllIngredients();
		echo json_encode($ingredients);
		die();
	}
	if($action=='addIngredient'){
		$name = $_POST['name'];
		$ingredient = new Ingredient();
		echo $ingredient->addIngredient($name);
		die();
	}
}
?>