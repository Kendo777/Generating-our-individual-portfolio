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
