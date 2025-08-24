<?php

$result = Product :: find() -> where("id", $GLOBALS["roterKey"][3]) -> get() -> fetch_assoc();?>
<div>
    <div><?=$result['name']?></div>
    <div><?=$result['price']?></div>
    <div><?=$result['category']?></div>
    <div><?=$result['description']?></div>
</div>