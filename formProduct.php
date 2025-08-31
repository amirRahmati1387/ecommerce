<?php

$key = Category :: all();?>
<form action = "getProduct" method = "POST">
    <input type = "text" name = "name" placeholder = "name">
    <input type = "text" name = "price" placeholder = "price">    
    <select name = "category">
        <?php
            for($i = 0 ; $i < count($key) ; $i++){?>
                <option value = "<?=$key[$i]['id'];?>"><?=$key[$i]['title'];?></option>
            <?php   
            }?>
    </select>
    <input type = "text" name = "description" placeholder = "description">
    <button>Send</button>
</form>