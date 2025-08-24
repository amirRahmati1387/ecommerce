<?php

$table = Product :: select() -> get();

while($row = $table -> fetch_assoc()){
    if($row[$_POST['serch']] == $_POST['name']){?>
        <div>
            <div><?= $row['name'];?></div>
            <div><?= $row['price'];?></div>
            <div><?= $row['category'];?></div>
            <div><?= $row['description'];?></div>
        </div>
    <?php    
    }
}