<?php

$result = Product :: find() -> where("id", $GLOBALS["roterKey"][3]) -> get() -> fetch_assoc();
$table = Category :: select() -> get();?>
<form action = "http://localhost/ecommerce/getediteProduct" method = "POST">
    <input name = "id" type = "hidden" value = "<?=$result['id'];?>">
    <input name = "name" type = "text" placeholder = "name" value = "<?=$result['name'];?>">
    <input name = "price" type = "text" placeholder = "price" value = "<?=$result['price'];?>">
    <select name = "category">
        <?php
            while($resulte = $table -> fetch_assoc()){?>
                <option value = "<?=$resulte['id'];?>"><?=$resulte['title'];?></option>
            <?php
            }
            ?>
    </select> 
    <input name = "description" type = "text" placeholder = "description" value = "<?=$result['description'];?>">
    <button>Update</button>
</form>