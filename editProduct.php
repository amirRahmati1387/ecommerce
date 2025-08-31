<?php

$result = Product :: find($GLOBALS["roterKey"][3]);
$key = Category :: all();?>
<form action = "http://localhost/ecommerce/getediteProduct" method = "POST">
    <input name = "id" type = "hidden" value = "<?=$result[0]['id'];?>">
    <input name = "name" type = "text" placeholder = "name" value = "<?=$result[0]['name'];?>">
    <input name = "price" type = "text" placeholder = "price" value = "<?=$result[0]['price'];?>">
    <select name = "category">
        <?php
            for($i = 0 ; $i < count($key) ; $i++){?>
                <option value = "<?=$key[$i]['id'];?>"><?=$key[$i]['title'];?></option>
            <?php
            }
            ?>
    </select> 
    <input name = "description" type = "text" placeholder = "description" value = "<?=$result[0]['description'];?>">
    <input name = "point" type = "text" placeholder = "point" value = "<?=$result[0]['point'];?>">
    <button>Update</button>
</form>