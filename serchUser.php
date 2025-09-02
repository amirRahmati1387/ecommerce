<?php

$row = User :: all();

for($i = 0 ; $i < count($row) ; $i++){
    if($row[$i][$_POST['serch']] == $_POST['name']){?>
        <div>
            <div><?= $row[$i]['name'];?></div>
            <div><?= $row[$i]['family'];?></div>
            <div><?= $row[$i]['phonNumber'];?></div>
        </div>
    <?php
    echo "</br>"; 
    }
}