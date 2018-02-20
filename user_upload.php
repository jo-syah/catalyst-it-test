<?php 

class Main {
	//mysql connection detail
	//change the detail accordingly
	private $host = "localhost";
	private $username = "root";
	private $password = "Johan123";
	private $database = "catalyst_it";

	//read csv file and turn that into array
	function read_csv($csv_file){
	    $file = fopen($csv_file, 'r');
	    $a = 0;
	    while (!feof($file) ) {
	    	$result = fgetcsv($file);

	    	//removing empty csv input
	    	if(array(null) !== $result && "" != $result)
	    	{
	    		
	    		$result[0] = $this->name_rule($result[0]);
	    		$result[1] = $this->name_rule($result[1]);
				$result[2] = $this->email_rule($result[2]);
				
				//filter invalid email address
				if(!filter_var($result[2], FILTER_VALIDATE_EMAIL)) {
	  				print_r("Wrong email format: " . $result[2] . "\n");
				}
				else
				{
	        		$line_of_text[] = $result;
	        	}
	    	}
	    }
	    fclose($file);
	    return $line_of_text;
	}

	//db connection
	function connect_db(){
		// Create connection
		$conn = mysqli_connect($this->host, $this->username, $this->password, $this->database);
		return $conn;
	}

	//modified the input to have capital letter at the front and lowercase for the rest
	//removed any unwanted character from names, only a-z and A-Z.
	function name_rule($input){
		return preg_replace("/[^a-zA-Z]+/", "", ucfirst(strtolower($input)));
	}

	//all string lowercased & remove any whitespace
	function email_rule($input){
		return str_replace(' ', '', strtolower($input));
	}

	//create table users
	function create_table_users(){
		$query = "DROP TABLE IF EXISTS Users;";
		$query .= "CREATE TABLE Users (
		    Name varchar(255) NOT NULL,
		    Surname varchar(255) NOT NULL,
			Email varchar(255) NOT NULL,
		    UNIQUE (Email)
		);";

		if($this->connect_db()->multi_query($query)) {
			print_r("Success creating table: Users");
		} else {
			print_r("Error creating table: " . $this->connect_db()->error);
		}
	}

	public function get_mysql_host(){
		return $this->host;
	}

	public function get_mysql_username(){
		return $this->username;
	}

	public function get_mysql_password(){
		return $this->password;
	}
}

$run = new Main();
//$run->create_table_users();
$csv = $run->read_csv("users.csv");
//print_r($csv);
?>