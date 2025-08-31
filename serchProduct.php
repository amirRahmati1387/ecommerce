<?php

$table = Product :: all();
for($i = 0 ; $i < count($table) ; $i++){
    if($table[$i][$_POST['serch']] == $_POST['name']){?>
        <div>
            <div><?= $table[$i]['name'];?></div>
            <div><?= $table[$i]['price'];?></div>
            <div><?= $table[$i]['category'];?></div>
            <div><?= $table[$i]['description'];?></div>
        </div>
    <?php    
    }
}