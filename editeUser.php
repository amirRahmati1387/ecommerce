<?php

$result = User :: find($GLOBALS["roterKey"][3]);?>
<form action = "http://localhost/ecommerce/getediteUser" method = "POST">
    <input type = "hidden" name = "id" value = "<?=$result[0]['id'];?>">
    <input type = "text" name = "name" value = "<?=$result[0]['name'];?>">
    <input type = "text" name = "family" value = "<?=$result[0]['family'];?>">
    <input type = "text" name = "phonNumber" value = "<?=$result[0]['phonNumber'];?>">
    <button>Update</button>
</form>