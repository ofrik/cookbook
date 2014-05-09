<?
require_once 'Database.php';

class Amount extends Database {

	private $id;
	private $name;

	function __construct(){
		parent::__construct();

	}
	public function addAmount($name){
		$query = "insert into amounts(name) values('$name')";
		if(mysql_query($query)){
			return 1;
		}
		else{
			return 0;
		}
	}
	public function getAmounts(){
		$query = "select * from amounts";
		$arr = array();
		$results = mysql_query($query);
		while($row = mysql_fetch_assoc($results)){
			$arr[] = $row;
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