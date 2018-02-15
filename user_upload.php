<?php 

//read csv file and turn that into array
function read_csv($csv_file){
    $file = fopen($csv_file, 'r');
    $a = 0;
    while (!feof($file) ) {
    	$result = fgetcsv($file);
    	$line_of_text[] = $result;
    }
    fclose($file);
    return $line_of_text;
}

//test array result
$csv_input = read_csv("users.csv");
print_r($csv_input);
?>