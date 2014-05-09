<?
include_once '../class/recipe.php';


if(isset($_POST)) {
	$action = $_POST['action'];
	if($action=='newRecipe'){
		parse_str($_POST['formData'],$formData);
		$name = $formData['name'];
		$level = $formData['level'];
		$desc = $formData['desc'];
		$orders = $formData['orders'];
		$userid = $_POST['userid'];
		$ingredients = NULL;
		for($i=0;$i<count($formData['ing']);$i++){
			$ingredients[$formData['ing'][$i]]=$formData['amount'][$i];
		}
		$json = array();
		if($recipe->addRecipe($name,$level,$desc,$orders,$ingredients,$userid)){
			$json['status'] = true;
		}
		else{
			$json['status'] = false;
		}
		echo json_encode($json);
		die();
	}
}
?>