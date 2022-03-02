<html>
    <h3>1.	Can you modify the function addOne($number) to use the pre-increment? And the post increment? Does it work as expected? If not, what is happening?</h3>
    <p>In the pre-increment variable is firsly incremented, and then returned ej: $number=0 echo = 1 return = 1. In the post-increment the variable is firsly returned and then increment it ej: $number=0 echo = 0 return = 1.</p>
    <xmp>function addOnePre($number)
	{
		echo ++$number;
		return $number;
	}
	function addOnePost($number)
	{
		echo $number++;
		return $number;
	}</xmp>
    <hr>
    <h3>2.	Can you create a function to create lists in HTML? It should receive an array with the elements of the list, and an optional parameter to specify the type of list. It will return the string with the resulting HTML. It shouldn’t modify the arrays.</h3>
    <?php
            function listCreator(array $array, $type = "ul")
            {
                $htmlList = "<{$type}>";
                foreach ($array as $value)
                {
                    $htmlList = $htmlList."<li>".$value."</li>";
                }
                $htmlList = $htmlList."";
                return $htmlList;
            }
            $a[0] = "hola";
        $a[1] = "adios";
        $a[2] = 5;
                $result = listCreator($a);
                echo "$result";
    ?>
    <xmp>
function listCreator(array $array, $type = "ul")
	{
		$htmlList = "<{$type}>";
		foreach ($array as $value)
		{
			$htmlList = $htmlList."<li>".$value."</li>";
		}
		$htmlList = $htmlList."";
		return $htmlList;
   }</xmp>
        <hr>
    <h3>3.	Can you create a function to create tables in HTML? It should receive a multidimensional array, with the data to fill the HTML table. It will return the string with the resulting HTML. It shouldn’t modify the strings.</h3>
        <?php
                function createTable(array $array)
            {
                $resultString = "<table border='1px'>";
                foreach ($array as $value)
                {
                    $resultString = $resultString."<tr>";
                    foreach ($value as $multi)
                    {
                        $resultString = $resultString."<td>".$multi."</td>";
                    }
                    $resultString = $resultString."</tr>";
                }
                $resultString = $resultString."</table>";
                return $resultString;
        }
                    $b[0][0] = "hola";
                    $b[0][1] = "adios";
                    $b[0][2] = 5;
                    $b[1][0] = "mola";
                    $b[1][1] = "php";
                    $b[1][2] = 7;
                $result = createTable($b);
                echo "$result";
        ?>
        <xmp>function createTable(array $array)
	{
		$resultString = "<table border='1px'>";
                foreach ($array as $value)
		{
			$resultString = $resultString."<tr>";
            foreach ($value as $multi)
			{
				$resultString = $resultString."<td>".$multi."</td>";
			}
			$resultString = $resultString."</tr>";
		}
	}</xmp>
        <hr>
    <h3>4.	Functions can be recursive? If so, create a function that performs a deep count of the elements in a multidimensional array. (It has to count elements inside arrays)</h3>
        <p>Yes, they can</p>
            <xmp>function fullSizeOfArray(array $array)
	{
		$ArraySize = 0;

		foreach ($array as $value)
		{
			if (is_array($array[$i]))
			{
				$ArraySize += fullSizeOfArray($value);

			}
			else
			{
				++$ArraySize;
			}
		}

		return $ArraySize;
        }</xmp>
                <hr>
    <h3>5.	Modify the function to also calculate the deepest level (regular array is a level 1 array).</h3>
    <xmp>function deepestLevelOfArray(array $array, $level = 1)
	{
		$possibleDeepest = 1;

		foreach ($array as $value) 
		{
			if(is_array($value))
			{
				$possibleDeepest = deepestLevelOfArray($value, $level + 1);
			}
		}

		$deepestLevel = max($possibleDeepest, $level);

		return $deepestLevel;
	}</xmp>
              <hr>  
    <h3>6.	Combine both so you return an array with the two “descriptions” (totalCount,deepestLevel) and the two values.</h3>
                <xmp>function sizeAndDepthOfArray(array $array, $level = 1)
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
	}</xmp>
                    <hr>
    <h3>7.	Can you create a function to build up arrays from two strings? The first string will include comma separated keys for the array. The second string will include comma separated values.</h3>
                    <xmp>function CombineArrays(string $keys, string $values)
	{
		$keysArray = explode(",", $keys);
		$valuesArray = explode(",", $values);
		$finalArray = array();

		for ($i = 0; $i < count($keysArray, 0); $i++)
		{
			$finalArray[(string)$keysArray[$i]] = (int)$valuesArray[$i];
		}

		return $finalArray;
	}</xmp>
                        <hr>
    <h3>8.	Can you create a function that traverses an array and modifies it: When finds a number turn it into a string, when find a string turns it into a number. (Test it with strings containing numbers and with random strings).</h3>
                        <xmp>function stringIntArrayInversor(array $array)
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
	}</xmp>
</html>