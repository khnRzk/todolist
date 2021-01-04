<?php 
	

define("HOST", "localhost");
define("USERNAME", "root");
define("PASSWORD", "");
define("DB", "todo");

/**
 * Database Connection
 */
class Database 
{
	public $Con;
	public function __construct()
	{
		$this->Con = mysqli_connect(HOST,USERNAME,PASSWORD,DB);
		if (!$this->Con) {
			echo "Connection Failed".mysqli_connect_error();
		}
	}
}

?>