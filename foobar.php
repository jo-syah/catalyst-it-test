<?php

class Foobar {

	function method_1($number)
	{
		$inc = 0;
		while($inc != $number){
			$inc++;
			$temp_a = false;
			if($inc % (3*5) == 0)
			{
				echo "foobar";
				$temp_a = true;
			}
			else if($inc % 3 == 0)
			{
				echo "foo";
				$temp_a = true;
			}
			else if($inc % 5 == 0)
			{
				echo "bar";
				$temp_a = true;
			}
			if($inc != $number){
				if($temp_a)
					echo ", ";
				else
					echo $inc . ", ";
			}
		}
	}
}

$foobar = new Foobar();
$foobar->method_1(100);
?>