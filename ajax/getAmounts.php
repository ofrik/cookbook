<?
include_once '../class/amount.php';

if(isset($_POST)) {
	$action = $_POST['action'];
	if($action=='getAmounts'){
		$amount = new Amount();
		$amounts = $amount->getAmounts();
		echo json_encode($amounts);
		die();
	}
	if($action=='addAmount'){
		$name = $_POST['name'];
		$amount = new Amount();
		echo $amount->addAmount($name);
		die();
	}
}
?>