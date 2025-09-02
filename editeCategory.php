<?php

$result = Category :: find($GLOBALS["roterKey"][3]);?>
<form action = "http://localhost/ecommerce/getediteCategory" method = "POST">
    <input type = "hidden" name = "id" value = "<?=$result[0]['id'];?>">
    <input type = "text" name = "title" value = "<?=$result[0]['title'];?>">
    <input type = "text" name = "description" value = "<?=$result[0]['description'];?>">
    <button>Update</button>
</form>