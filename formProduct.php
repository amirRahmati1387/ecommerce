<?php

$key = Category :: select() -> get();?>
<form action = "getProduct" method = "POST">
    <input type = "text" name = "name" placeholder = "name">
    <input type = "text" name = "price" placeholder = "price">    
    <select name = "category">
        <?php
            while($result = $key -> fetch_assoc()){?>
                <option value = "<?=$result['id'];?>"><?=$result['title'];?></option>
            <?php   
            }?>
    </select>
    <input type = "text" name = "description" placeholder = "description">
    <button>Send</button>
</form>