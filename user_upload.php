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

//modified the input to have capital letter at the front and lowercase for the rest
//removed any unwanted character from names, only a-z and A-Z.
function name_rule($input){
	return preg_replace("/[^a-zA-Z]+/", "", ucfirst(strtolower($input)));
}

//all string lowercased & remove any whitespace
function email_rule($input){
	return str_replace(' ', '', strtolower($input));
}

//test array result
$csv_input = read_csv("users.csv");
print_r($csv_input);
?>