<?php

$result = Category :: find() -> where("id", $GLOBALS["roterKey"][3]) -> get() -> fetch_assoc();?>
<form action = "http://localhost/ecommerce/getediteCategory" method = "POST">
    <input type = "hidden" name = "id" value = "<?=$result['id'];?>">
    <input type = "text" name = "title" value = "<?=$result['title'];?>">
    <input type = "text" name = "description" value = "<?=$result['description'];?>">
    <button>Update</button>
</form>