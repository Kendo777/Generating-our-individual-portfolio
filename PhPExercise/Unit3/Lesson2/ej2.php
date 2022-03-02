<?php

       function stringIntArrayInversor(array $array)
	{
		$finalArray = array();

		foreach ($array as $key) 
		{
			if(is_integer($key))
			{
				array_push($finalArray, (string)$key);
			}
			else if(is_string($key))
			{			
				array_push($finalArray, (int)$key);
			}
			else
			{
				echo "Value {$key} is not a string nor an integer.";
			}
		}

		return $finalArray;
	}

	$arrayName = array('php' => "58", 'mola' => 27, 'mucho' => 3);
	$newArray = stringIntArrayInversor($arrayName);
	foreach ($newArray as $value) {
		var_dump($value);
	}
?>