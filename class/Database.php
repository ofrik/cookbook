<?
abstract class Database {
	
	private $connection;
	private $host;
	private $user;
	private $password;
	private $dbname;
	
	function __construct(){
		//echo "in database cunstructor \n";
		include dirname(__FILE__)."/config.php";
		
		$this->host = $host;
		$this->user = $user;
		$this->password = $password;
		$this->dbname = $dbname;
		
		$this->connect();
	}
	/**
	 * cunnect to the database or output error
	 */
	private function connect(){
		$this -> connection = mysql_connect($this -> host, $this -> user, $this -> password);
		if (!$this -> connection) {
			die('Could not connect: ' . mysql_error());
		} else {
			mysql_set_charset("utf8");
			$db = mysql_select_db($this -> dbname, $this -> connection);
			if (!$db) {
				  $query = "CREATE DATABASE $this->dbname DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
				
				  if (mysql_query($query)) {
				      //echo "Database $this->dbname created successfully\n";
					  $db = mysql_select_db($this -> dbname, $this -> connection);
				  } else {
				      echo 'Error creating database: ' . mysql_error() . "\n";
				  }
			}
		}
	}
	
	/**
	 * disconnect from the database
	 */
	private function disconnect() {
		mysql_close($this -> $connection);
		unset($this -> connection);
	}
	
	/**
	 * cleanUp($input,$restriction="",$allowTags="")
	 * clean up a string to be suitable and without injections
	 * 
	 * tags: can use letters in hebrew or english digits "," "-"
	 * data: change the special html chars to html entities
	 * default: letters digits "-" "_" "?" "!" "@" "." "\n" "\r" ":"
	 * 
	 * @param string $input the user input for the query use
	 * @param string $restriction the type of chars that can enter
	 * @param string $allowTags not in use now
	 * @return a clean query to enter the database
	 */
	static protected function cleanUp($input,$restriction="",$allowTags=""){
		switch ($restriction) {
			case 'tag':// for html tags (SEO)
				$input = trim(preg_replace("/[^A-Za-z-0-9א-ת,\-]/", '', $input));
				break;
			case 'data': //data just change to signs
				$input = trim(htmlspecialchars($input));
				break;
			case 'insert':
				$input = trim(preg_replace("/[^A-Za-zא-ת0-9\-_= ,()]/", "", $input));
			default:
				$input = trim(preg_replace("/[^A-Za-z-0-9א-ת\-_\?!@.\\n \\r:]/", '', $input));
				break;
		}
		return $input;
	}
	/**
	 * @return the id of the last insert query
	 */
	public function getLastID() {
		return mysql_insert_id();
	}
	
	/**
	 * Delete($table,$where)
	 * delete query tamplate
	 * 
	 * @param string $table the table for the query
	 * @param string $where the condition for the delete
	 * @return true on succsess or false on error
	 * 
	 */
	protected function Delete($table,$where){
		$query = "delete from $table where $where";
		return mysql_query($query);
	}
	/**
	 * Insert($table,$to,$values)
	 * insert query tamplate
	 * $to and $values need to be Coordinated
	 * 
	 * @param string $table the table for the query
	 * @param string $into the variebles that you want to enter to
	 * @param string $values the value you want to enter to the variables 
	 * @param string $onDuplicateKey case of duplicate keys default ""
	 * @return true on succsess or false on error
	 */
	protected function Insert($table,$into,$values,$onDuplicateKey=""){
		if($onDuplicateKey!='')
			$onDuplicateKey = "ON DUPLICATE KEY $onDuplicateKey";
		$query = "insert into $table ($into) values (".$values.") $onDuplicateKey";
		return mysql_query($query);
	}
	/**
	 * Select($cols="*",$from,$where="1=1",$limit="",$groupby="",$orderby="",$desc="",$having="")
	 * select query tamplate
	 * 
	 * @param string $cols which variables you want to get, default all
	 * @param string $from which tables you want to get the info from
	 * @param string $limit if you want to limit the results, default no limit
	 * @param string $groupby on which variables to group the results
	 * @param string $orderby on which variable to sort the results
	 * @param boolean $desc true if you want to order to be descnding
	 * @param string $having how to sort after aggregate operation
	 * @return the query results or error
	 */
	protected function Select($cols="*",$from,$where="1=1",$limit="",$groupby="",$orderby="",$desc="",$having=""){
		if($limit!='')
			$limit = "LIMIT $limit";
		if($groupby!='')
			$groupby = "GROUP BY $groupby ";
		if($orderby!='')
			$orderby = "ORDER BY $orderby";
		if($desc&&$orderby!='')
			$orderby = "$orderby DESC";
		if($having!='')
			$having = "HAVING $having";
		$query = "SELECT $cols from $from $where $groupby $orderby $having $limit";
		return mysql_query($query);		
	}
	
}
?>