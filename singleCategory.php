<?php

$result = Category :: find() -> where("id", $GLOBALS["roterKey"][3]) -> get() -> fetch_assoc();?>
<div>
    <div><?=$result['id'];?></div>
    <div><?=$result['title'];?></div>
    <div><?=$result['description'];?></div>
</div>