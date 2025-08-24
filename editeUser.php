<?php

$result = User :: find() -> where("id", $GLOBALS["roterKey"][3]) -> get() -> fetch_assoc();?>
<form action = "http://localhost/ecommerce/getediteUser" method = "POST">
    <input type = "hidden" name = "id" value = "<?=$result['id'];?>">
    <input type = "text" name = "name" value = "<?=$result['name'];?>">
    <input type = "text" name = "family" value = "<?=$result['family'];?>">
    <input type = "text" name = "phonNumber" value = "<?=$result['phonNumber'];?>">
    <button>Update</button>
</form>