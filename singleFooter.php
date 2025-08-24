<?php

$result = Footer :: find() -> where("id", $GLOBALS["roterKey"][3]) -> get() -> fetch_assoc();?>
<div>
    <div><?=$result['nameDesigner']?></div>
    <div><?=$result['description']?></div>
    <div><?=$result['phonNumber']?></div>
</div>