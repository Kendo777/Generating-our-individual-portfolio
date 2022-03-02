<?php
function sizeAndDepthOfArray(array $array, $level = 1)
	{
		$totalSize = 0;
		$possibleDeepest = 1;

		foreach($array as $value)
		{
			if (is_array($value))
			{
				$currentResults = sizeAndDepthOfArray($value, $level + 1);
				$totalSize += $currentResults[0];
				$possibleDeepest = $currentResults[1];
			}
			else
			{
				++$totalSize;
			}
		}

		$deepestLevel = max($possibleDeepest, $level);

		return array($totalSize, $deepestLevel);
	}

	$cars = array (
  array("Volvo",22,18),
  array("BMW",15,13),
  array("Saab",5,2),
  array("Land Rover",17,15)
);
	$size = sizeAndDepthOfArray($cars);
	var_dump($size);
	echo "<br><br>Size: ".$size[0]."Depth: ".$size[1];
?>