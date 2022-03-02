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
    