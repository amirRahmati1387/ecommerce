<?php

$rows = Footer :: all();


echo"</br>";
echo"____________________________________________";
echo"</br>";
echo"____________________________________________";
echo"</br>";
echo"____________________________________________";
echo"</br>";
for($i = 0 ; $i < count($rows) ; $i++){?>
        <div>
            <div><?php if(count($rows) == 1){echo $rows[$i]['nameDesigner'];}?></div>
            <div><?php if(count($rows) == 1){echo $rows[$i]['description'];}?></div>
            <div><?php if(count($rows) == 1){echo $rows[$i]['phonNumber'];}?></div>
        </div>
    </body>
</html>
<?php
}