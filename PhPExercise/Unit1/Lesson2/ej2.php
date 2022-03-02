<?php

$variable = 10;
    for($i=0;$i<=$variable;$i++)
    {
        if($i%2==0 && $i%3==0)
        {
            echo "I am ".$i.", an even number multiple of 3 <br>";
            
        }
        else if($i%2==0)
        {
            echo "I am ".$i.", an even number <br>";
            
        }
        else if($i%3==0)
        {
            echo "I am ".$i.", multiple of 3 <br>";
        }
    }


?>