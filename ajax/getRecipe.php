<?
include_once '../class/recipe.php';

if(isset($_POST)) {
	if($_POST['id']>0){
		$id = $_POST['id'];
		$recipe->setRecipe($id);
		$json = array();
		$json['id'] = $recipe->getId();
		$json['name'] = $recipe->getName();
		$json['level'] = $recipe->getLevel();
		$json['desc'] = $recipe->getDesc();
		$json['orders'] = $recipe->getOrders();
		$json['ingredients'] = $recipe->getIngredients();
		echo json_encode($json);
		die();
	}
}
?>