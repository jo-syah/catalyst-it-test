<?php 

//read csv file and turn that into array
function read_csv($csv_file){
    $file = fopen($csv_file, 'r');
    $a = 0;
    while (!feof($file) ) {
    	$result = fgetcsv($file);

    	//removing empty csv input
    	if(array(null) !== $result && "" != $result)
    	{
    		
    		$result[0] = name_rule($result[0]);
    		$result[1] = name_rule($result[1]);
			$result[2] = email_rule($result[2]);
			
			//filter invalid email address
			if (!filter_var($result[2], FILTER_VALIDATE_EMAIL)) {
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
	$servername = "localhost";
	$username = "root";
	$password = "Johan123";
	$database = "catalyst_it";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $database);

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
	    PRIMARY KEY (Email)
	);";

	if(connect_db()->multi_query($query)) {
		print_r("Success creating table: Users");
	} else {
		print_r("Error creating table: " . connect_db()->error);
	}
}

//test db connect
if(connect_db()->connect_error){
	die("Connection failed: " . $conn->connect_error);
}
else
{
	//test create table users
	create_table_users();
	//test csv array result
	//$csv_input = read_csv("users.csv");
	//print_r($csv_input);
}


?>