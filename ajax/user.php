<?
include_once '../class/User.php';

if(isset($_POST)) {
	$action = $_POST['action'];
	if($action=='login'){
		$arr = array();
		parse_str($_POST['formData'],$formData);
		$arr['id']= $user->login($formData['name'],$formData['pass']);
		if($arr['id']!=false){
			$arr['status']=true;
		}
		else{
			$arr['status']=false;
		}
		echo json_encode($arr);
		die();
	}
	if($action=='register'){
		$arr = array();
		parse_str($_POST['formData'],$formData);
		if($user->isAvailable($formData['name'])){
			$arr['id'] = $user->addUser($formData['name'],$formData['pass']);
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