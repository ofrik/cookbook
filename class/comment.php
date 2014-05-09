<?
require_once 'Database.php';

class Recipe extends Database {

	private $id;
	private $name;
	private $level;
	//private $rating;
	private $ingredients;
	private $amounts;
	private $comments;

	function __construct(){
		parent::__construct();
		$this->ingredients = new Ingresients();
		$this->amounts = new Amounts();
	}
	public getRecipe($id){
		$query = "select * from recipes join ingredients join amounts where recipes.id='$id'";
		if($result = mysql_query($query)){
			$this->id=$id;
			$this->name = $result['name'];
			$this->level = $result['level'];
		}
		else{
			echo mysql_error();
		}

	}
	public function getId(){
		return $this->id;
	}
	public function getName(){
		return $this->name;
	}
	public function getLevel(){
		return $this->level;
	}
	public function getRating(){
		return $this->rating;
	}
	private function setId($id){
		$this->id=$id;
	}
	private function setName($name){
		$this->name=$name;
	}
	private function SetLevel($level){
		$this->level=$level;
	}
	private function addRating($rating){

	}
}
$recipe = new Recipe();
?>