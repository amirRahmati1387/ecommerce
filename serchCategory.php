<?php

$table = Category :: all();

for($i = 0 ; $i < count($table) ; $i++){
    if($table[$i][$_POST['serch']] == $_POST['name']){?>
        <div>
            <div><?= $table[$i]['title'];?></div>
            <div><?= $table[$i]['description'];?></div>
        </div>
    <?php    
    }
}