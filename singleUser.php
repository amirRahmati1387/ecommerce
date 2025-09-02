<?php

$result = User :: find($GLOBALS["roterKey"][3]);
for($i = 0 ; $i < count($result) ; $i++){?>
    <div>
        <div><?=$result[$i]['name'];?></div>
        <div><?=$result[$i]['family'];?></div>
        <div><?=$result[$i]['phonNumber'];?></div>
    </div>
<?php
}