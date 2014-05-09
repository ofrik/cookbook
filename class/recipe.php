<?
require_once 'Database.php';
require_once 'ingredient.php';

class Recipe extends Database {

	private $id;
	private $name;
	private $level;
	//private $rating;
	private $shortDesc;
	private $orders;
	private $ingredients;
	private $comments;
	private $ingredientsArray;

	function __construct(){
		parent::__construct();
		$this->ingredients = new Ingredient();
		//$this->comments = new Comment();
	}
	public function setRecipe($id){
		$query = "select * from recipes where id=$id";
		if($result = mysql_query($query)){
			$result = mysql_fetch_array($result);
			$this->setId($id);
			$this->setName($result['name']);
			$this->setLevel($result['level']);
			$this->setDesc($result['shortDesc']);
			$this->setOrders($result['orders']);
			$this->ingredientsArray = $this->ingredients->getRecipeIngredients($id);
			return 1;
		}
		else{
			echo mysql_error();
			return 0;
		}
	}
	private function addIngredient($id_ingredient,$id_amount){
		$query = "insert into recipe_ingredient_amount(id_recipe,id_ingredient,id_amount) values(".$this->getId().",$id_ingredient,$id_amount)";
		if(mysql_query($query)){
			return 1;
		}
		else{
			echo mysql_error();
			return 0;
		}
	}
	public function getRecipies($limit=NULL){
		if($limit!=NULL){
			$limit = "LIMIT $limit";
		}
		else{
			$limit="";
		}
		$query = "select * from recipes $limit";
		return mysql_query($query);
	}
	public function getUserFavRecipe($userid){
		$query = "select * from user_fav join recipes on user_fav.recipe_id=recipes.id where user_id='$userid'";
		$results = mysql_query($query);
		$arr = array();
		while($row = mysql_fetch_assoc($results)){
			$arr[] = $row;
		}
		return $arr;
	}
	public function addToFav($recipe_id,$userid){
		$query = "insert into user_fav (user_id,recipe_id) values($userid,$recipe_id)";
		return mysql_query($query);
	}
	public function removeFromFav($recipe_id,$userid){
		$query = "delete from user_fav where user_id='$userid' and recipe_id='$recipe_id'";
		return mysql_query($query);;
	}
	
	public function searchRecipe($str,$moreLimits=""){
		if($moreLimits!=""){
			$moreLimits = "AND ($moreLimits)";
		}
		$query = "select * from recipes where (name like '%$str%' or shortDesc like '%$str%' or orders like '%$str%') $moreLimits";
		return mysql_query($query);
	}
	public function removeIngredient($id){
		$query = "delete from recipe_ingredient_amount where id_recipe='".$this->getId()."' and id_ingredient='$id'";
		if(mysql_query($query)){
			return 1;
		}
		else{
			return 0;
		}
	}
	public function updateRecipe(){
		$query = "update recipes set name='".$this->getName()."',level='".$this->getLevel()."',shortDesc='".$this->getDesc()."',orders='".$this->getOrders()."' where id='".$this->getId()."'";
		if(mysql_query($query)){
			return 1;
		}
		else{
			return 0;
		}
	}
	public function addRecipe($name,$level,$desc,$orders,$ingredients,$userid){
		$query = "insert into recipes(name,level,shortDesc,orders) values('$name','$level','$desc','$orders')";
		if(mysql_query($query)){
			$this->setId(Database::getLastID());
			$query = "insert into user_recipes (user_id,recipe_id) values('$userid','".$this->getId()."')";
			mysql_query($query);
			$query = "insert into user_fav (user_id,recipe_id) values($userid,".$this->getId().")";
			mysql_query($query);
			if($ingredients!=NULL){
				foreach ($ingredients as $key => $value) {
					if(!$this->addIngredient($key,$value)){
						return 0;
					}
				}
			}
			$this->setRecipe($this->getId());
			return 1;
		}
		else{
			echo mysql_error();
			return 0;
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
	public function getDesc(){
		return $this->shortDesc;
	}
	public function getOrders(){
		return $this->orders;
	}
	public function getIngredients(){
		return $this->ingredientsArray;
	}
	private function setId($id){
		$this->id=$id;
	}
	private function setName($name){
		$this->name=$name;
	}
	private function setLevel($level){
		$this->level=$level;
	}
	private function setDesc($desc){
		$this->shortDesc = $desc;
	}
	private function setOrders($orders){
		$this->orders = $orders;
	}
	private function addRating($rating){

	}
}
$recipe = new Recipe();
?>