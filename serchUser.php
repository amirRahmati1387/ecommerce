<?php

$table = User :: select() -> get();

while($row = $table -> fetch_assoc()){
    if($row[$_POST['serch']] == $_POST['name']){?>
        <div>
            <div><?= $row['name'];?></div>
            <div><?= $row['family'];?></div>
            <div><?= $row['phonNumber'];?></div>
        </div>
    <?php
    echo "</br>"; 
    }
}