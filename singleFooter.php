<?php

$result = Footer :: find($GLOBALS["roterKey"][3]);
for($i = 0 ; $i < count($result) ; $i++){
?>
    <div>
        <div><?=$result[$i]['nameDesigner']?></div>
        <div><?=$result[$i]['description']?></div>
        <div><?=$result[$i]['phonNumber']?></div>
    </div>
<?php
}