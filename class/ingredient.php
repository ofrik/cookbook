<?
require_once 'Database.php';

class Ingredient extends Database {

	private $id;
	private $name;
	private $amount;

	function __construct(){
		parent::__construct();
	}
	public function getIngredient($id){
		$query = "select * ingredients where id='$id'";
		if($result = mysql_query($query)){
			$this->id=$id;
			$this->name = $result['name'];
		}
		else{
			echo mysql_error();
		}

	}
	public function getRecipeIngredients($id){
		$arr = array();
		$query = "select ingredients.name as ing,amounts.name as amount from recipe_ingredient_amount left join amounts on id_amount=amounts.id left join ingredients on id_ingredient=ingredients.id where id_recipe='$id'";
		if($results = mysql_query($query)){
			while($row = mysql_fetch_assoc($results)){
				$arr[]=$row;
			}
		}
		else{
			echo mysql_error();
		}
		return $arr;
	}
	public function addIngredient($name){
		$query = "insert into ingredients(name) values('$name')";
		if(mysql_query($query)){
			return 1;
		}
		else{
			echo mysql_error();
			return 0;
		}
	}
	public function getAllIngredients(){
		$query = "select * from ingredients";
		$results = mysql_query($query);
		$arr = array();
		while($row = mysql_fetch_assoc($results)){
			$arr[]=$row;
		}
		return $arr;
	}
	public function getId(){
		return $this->id;
	}
	public function getName(){
		return $this->name;
	}
	private function setId($id){
		$this->id=$id;
	}
	private function setName($name){
		$this->name=$name;
	}

}
?>