<?
require_once 'Database.php';

class User extends Database {
	
	private $id;
	private $username;
	private $pass;
	
	function __construct($id=null){
		parent::__construct();
		
		//echo "in user constructor\n";
			
	}
	
	/**
	 * getUser($id)
	 * get all user info
	 * 
	 * @param string $id to find in the database and retrive
	 * @return resource of the user data or false
	 */
	public function getUser($id){
		if($id==''){
			$id = $this->id;
		}
		$id = (int)$id;
		$query = "SELECT * FROM user WHERE id=$id";
		$result = mysql_query($query);
		if(mysql_num_rows($result)>0){
			$result = mysql_fetch_array($result);
			return $result;
		}
		else {
			return false;
		}
		
	}
	
	public function addUser($username,$password){
		$this->username = User::cleanUp($username);
		$this->pass = md5($password);
		$query = "
		INSERT INTO user (username,password) 
		VALUES ('".$this->username."','".$this->pass."')";
		mysql_query($query);
		$this->id = User::getLastID();
		return $this->id;
	}
	
	public function deleteUser($id){
		$id = (int)$id;
		$query = "DELETE FROM user WHERE id='$id'";
		return mysql_query($query);
	}
	
	public function updateUser($id,$params){
		$id = (int)$id;
		$params = mysql_real_escape_string(User::cleanUp($params,"insert"));
		$query = "insert into user $params where id='$id'";
		return mysql_query($query);
	}
	
	
	public function isAvailable($username){
		$username = User::cleanUp($username);
		$query = "SELECT * FROM user WHERE username='$username'";
		$result = mysql_query($query);
		if(mysql_num_rows($result)>0){
			return false;
		}
		else {
			return true;
		}
		
	}
	
	public function login($username,$password){
		$username = User::cleanUp($username);
		$password = md5($password);
		$query = "SELECT * FROM user WHERE username='$username' and password='$password' ";
		$result = mysql_query($query);
		$id = mysql_fetch_array($result);
		$id = $id['id'];
		if(mysql_num_rows($result)>0){
			return $id;
		}
		else {
			return false;
		}
		
	}
	
	public function getAllUsers(){
		$query = "SELECT * FROM user";
		return mysql_query($query);
		
	}
}
$user = new User();
?>