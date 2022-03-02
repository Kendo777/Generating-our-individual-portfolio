   
            <?php
            echo '<table border="1">
            <tr>';
                for($i = 0; $i<144; $i++)
                {
                    if($i%16==0 && $i!=0)
                    {
                        echo '</tr>';
                        echo '<tr>';
                    }
                    echo '<td>'.($i).': '.chr($i).'</td>';
                }
            echo '</table>'
            ?>
        