<html>
    
    <h1>2 – Hello PHP:</h1>
<hr>    
    <h3>1.	Can you produce this output using single quote strings?</h3>
    <p>\ at the end of the line?   >>>			Hello World\ </p>
    <p>No you couldn’t you must to put ‘Hello World\\’</p>
    <p>\’ at any point in the line?   >>>			Hello \’ world</p>
    <p>Yes you could you must to put ‘Hello \\\’ world’</p>
    <hr>
    <h3>2.	Why do I need to put double slash in “c:\\xampp”? What happens if I do not put them?</h3>
    <p>\xa is a special character that puts in hexadecimal the letter before \x that in this case is 10 that in ASCII is the line break </p>
   <hr>
    <h3>3.	What can a variable store?  Show the four different scalar types using var_dump.</h3>
    <p>A PHP variable can store a integer, float, boolean, string, array, object, callable, iterable, resource or NULL.</p>
    <xmp>
        $variable = 5; -> int(5)
        $variable = true; -> bool(true)
        $variable = 3.2; -> float(3.2)
        $variable = “papi”; -> string(4) "papi"
    </xmp>
   <hr>
    <h3>4.	What is the difference between $variable = 1 and $variable == 1? </h3>
    <p>$variable = 1 assigns the value 1 to the variable $variable but if you put $variable == 1 php will compare $variable with 1 and return true or false but not assign.</p>
   <hr>
    <h3>5.	Underscore is allowed in variable names ($current_user), whereas hyphens are not ($current-user). Why? (make a guess) </h3> 
    <p>Because ‘-‘ is used for minus operator</p>
    <hr>
    <h3>6.	Are variable names case-sensitive?</h3>
    <p>Yes</p>
    <hr>
    <h3>7.	Can you use spaces in variable names?</h3>
    <p>No</p>
    <hr>
    <h3>8.	How do you explicitly convert one variable type to another (say, a string to a number)?</h3>
    <p>The type of a variable is assigned at runtime, this can make change the type during the lifetime of a variable as when we assign a different value (type). Or you can make a casting</p>
    <xmp>
        $variable = “string”;
        $variable = 5;
        ///// casting
        $variable = 5;
        var_dump((string)$variable);
    </xmp> 
    <hr>
    <h3>9.	What is the difference between ++$j and $j++?</h3>
    <p>++$j increase $j by one and then returns $j. $j++ returns $j and then increase $j by one</p>
    <hr>
    <h3>10.	Are the operators && and and interchangeable?</h3>
    <p>Yes because are the same</p>
    <hr>
    <h3>11.	Can you redefine a constant?</h3>
    <p>No, you cannot redefine a constant except with runkit_constant_redefine.</p>
    <hr>
    <h3>12.	When would you use the === (identity) operator?</h3>
    <p>If you need to check if $a is equal in value and type as $b</p>
    <hr>
    <h3>13.	Why is a for loop more powerful than a while loop?</h3>
    <p>Because the for loop have thre parameters that controle the loop, not as the while loop that it only has one</p>
    <hr>
    <h3>14.	What happens when there is an overflow in an integer value? To check it, create a loop that increases an “integer variable” and overflows it. Use var_dump so we can see the moment where the overflow occurs. (If you iterate from 0 it will take too much time, use the constants in PHP, slide 23, to iterate only “around” the overflow).</h3>
    <p>The max integer is 9223372036854775807, if PHP encounters a number beyond the bounds of the integer type, it will be interpreted as a float instead. The integer overflowed 9.2233720368548E+18.</p>
    <hr>
    <h3>15.	Create a script that prints a multiplication table (from 1 to 10) for a given number.</h3>
    <xmp>
    $variable = 3;
    for($i = 0; $i<=10; $i++)
    {
       echo $variable." by ".$i." is ".$i*$variable."<br>"
    }</xmp>
    <hr>
    <h3>16.	Modify (copy it first) the script so you can print the multiplication table of a given number but between the indexes you want (instead of 1 to 10).</h3>
<xmp>
    $variable = 3;
    $number1 = 5;
    $number2 = 15;
    for($number1; $number1<=$number2; $number1++)
    {
        echo $variable." by ".$number1." is ".$number1*$variable."<br>";
    }</xmp>
?>
</p>
    <hr>
    <h3>17.	Modify (copy it first) again the script so it work also for negative indexes (-10,10). </h3>
    <xmp>
    $variable = 3;
    $number1 = -10;
    $number2 = 10;
    for($number1; $number1<=$number2; $number1++)
    {
        echo $variable." by ".$number1." is ".$number1*$variable."<br>";
    }</xmp>
</p> 
    <hr>
    <h3>18.	Tables in HTML are really easy (https://www.w3schools.com/html/html_tables.asp) Can you create a loop to print the ASCII table (for each element print the integer value and the resulting char)?</h3>
                <table border="1">
            <tr>
            <?php
                for($i = 0; $i<144; $i++)
                {
                    if($i%16==0 && $i!=0)
                    {
                        echo '</tr>';
                        echo '<tr>';
                    }
                    echo '<td>'.($i).': '.chr($i).'</td>';
                }
            ?>
        </table>
    <xmp>        
        <table border="1">
            <tr>
            <php
                for($i = 0; $i<144; $i++)
                {
                    if($i%16==0 && $i!=0)
                    {
                        echo '</tr>';
                        echo '<tr>';
                    }
                    echo '<td>'.($i).': '.chr($i).'</td>';
                }
            ?>
        </table></xmp>
    
    <hr>
    <h3>19.	Create a loop from 0 to x that prints even numbers (I am #, an even number) and numbers that are multiple of 3 ( I am #, multiple of 3). If both conditions happen at the same time only one line should be produced (I am #, an even number multiple of 3).</h3>
<xmp>
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
    }</xmp>
<hr>
</html>