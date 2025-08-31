<?php

$result = Product :: find($GLOBALS["roterKey"][3]);?>
<div>
    <div><?=$result[0]['name']?></div>
    <div><?=$result[0]['price']?></div>
    <div><?=$result[0]['category']?></div>
    <div><?=$result[0]['description']?></div>
    <div><?=$result[0]['point']?></div>
</div>