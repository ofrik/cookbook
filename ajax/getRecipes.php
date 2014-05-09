<?
include_once '../class/recipe.php';

if(isset($_POST)) {
	$action = $_POST['action'];
	if($action=="search"){
		if(!empty($_POST['search'])){
			$str = $_POST['str'];
			$recipes = $recipe->searchRecipe($str);
			$json = array();
			while($row = mysql_fetch_assoc($recipes)){
				$json[] = $row;
			}
			echo json_encode($json);
			die();
		}
	}
	if($action=="get_user_fav"){
		$userid = $_POST['userid'];
		$recipes = $recipe->getUserFavRecipe($userid);
		echo json_encode($recipes);
		die();
	}
	if($action=="user_unfav"){
		$userid = $_POST['userid'];
		$recipe_id = $_POST['recipe_id'];
		$arr = array();
		if($recipe->removeFromFav($recipe_id,$userid)){
			$arr['status']=true;
		}
		else{
			$arr['status']=false;
		}
		echo json_encode($arr);
		die();
	}
	if($action=="user_fav"){
		$userid = $_POST['userid'];
		$recipe_id = $_POST['recipe_id'];
		$arr = array();
		if($recipe->addToFav($recipe_id,$userid)){
			$arr['status']=true;
		}
		else{
			$arr['status']=false;
		}
		echo json_encode($arr);
		die();
	}
}
?>