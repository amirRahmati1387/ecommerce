<?php

$table = Category :: select() -> get();

while($row = $table -> fetch_assoc()){
    if($row[$_POST['serch']] == $_POST['name']){?>
        <div>
            <div><?= $row['title'];?></div>
            <div><?= $row['description'];?></div>
        </div>
    <?php    
    }
}