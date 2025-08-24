<?php

$result = User :: find() -> where("id", $GLOBALS["roterKey"][3]) -> get() -> fetch_assoc();?>
<div>
    <div><?=$result['name'];?></div>
    <div><?=$result['family'];?></div>
    <div><?=$result['phonNumber'];?></div>
</div>