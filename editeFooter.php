<?php

$result = Footer :: find() -> where("id", $GLOBALS["roterKey"][3]) -> get() -> fetch_assoc();?>
<form action = "http://localhost/ecommerce/getediteFooter" method = "POST">
    <input type = "hidden" name = "id" value = "<?=$result['id'];?>">
    <input type = "text" name = "nameDesigner" value = "<?=$result['nameDesigner'];?>">
    <input type = "text" name = "description" value = "<?=$result['description'];?>">
    <input type = "text" name = "phonNumber" value = "<?=$result['phonNumber'];?>">
    <button>Update</button>
</form>