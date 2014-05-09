<?
defined('SITE_FOLDER') ? null : define('SITE_FOLDER', "cookbook"/*change to relevante*/);

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

defined('SITE_ROOT') ? null : define('SITE_ROOT', $_SERVER['SERVER_NAME'].DS.SITE_FOLDER.DS);

defined('DIR_ROOT') ? null : define('DIR_ROOT', $_SERVER['DOCUMENT_ROOT'].SITE_FOLDER.DS);

defined('Prefix') ? null : define('Prefix', "");

defined('SITE_NAME') ? null : define('SITE_NAME', "MYCMS");

$host = "localhost";
$user = "root";
$password = "";
$dbname = "cookbook";

$conn = mysql_connect($host, $user, $password);
$db = mysql_select_db($dbname, $conn);


?>