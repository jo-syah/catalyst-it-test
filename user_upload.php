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
    		//modify the input to have capital letter at the front and lowercase for the rest
    		$result[0] = ucfirst(strtolower($result[0]));
    		$result[1] = ucfirst(strtolower($result[1])); 
    		$result[2] = strtolower($result[2]); //all lowercase for email

        	$line_of_text[] = $result;
    	}
    }
    fclose($file);
    return $line_of_text;
}

//test array result
$csv_input = read_csv("users.csv");
print_r($csv_input);
?>