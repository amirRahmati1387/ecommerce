<?php

$table = Footer :: select() -> get();
$rows = $table -> fetch_assoc();
echo"</br>";
echo"____________________________________________";
echo"</br>";
echo"____________________________________________";
echo"</br>";
echo"____________________________________________";
echo"</br>";
echo"____________________________________________";
?>
        <div>
            <div><?php if($table -> num_rows == 1){echo $rows['nameDesigner'];}?></div>
            <div><?php if($table -> num_rows == 1){echo $rows['description'];}?></div>
            <div><?php if($table -> num_rows == 1){echo $rows['phonNumber'];}?></div>
        </div>
    </body>
</html>