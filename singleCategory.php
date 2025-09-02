<?php

$result = Category :: find($GLOBALS["roterKey"][3]);
for($i = 0 ; $i < count($result) ; $i++){?>
    <div>
        <div><?=$result[$i]['id'];?></div>
        <div><?=$result[$i]['title'];?></div>
        <div><?=$result[$i]['description'];?></div>
    </div>
<?php
}