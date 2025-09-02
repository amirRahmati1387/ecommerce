<?php

$result = Footer :: find($GLOBALS["roterKey"][3])?>
<form action = "http://localhost/ecommerce/getediteFooter" method = "POST">
    <input type = "hidden" name = "id" value = "<?=$result[0]['id'];?>">
    <input type = "text" name = "nameDesigner" value = "<?=$result[0]['nameDesigner'];?>">
    <input type = "text" name = "description" value = "<?=$result[0]['description'];?>">
    <input type = "text" name = "phonNumber" value = "<?=$result[0]['phonNumber'];?>">
    <button>Update</button>
</form>