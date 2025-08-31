<?php

$start = $_POST['start'];
$end = $_POST['end'];
$result = Category :: limit($start , $end);
for($i = 0 ; $i < count($result) ; $i++){?>
    <div>
        <div><?=$result[$i]['title'];?></div>
        <div><?=$result[$i]['description'];?></div>
    </div>
    <a href = "http://localhost/ecommerce/deleteCategory/<?=$result[$i]['id'];?>">Delete</a>
    <a href = "http://localhost/ecommerce/editeCategory/<?=$result[$i]['id'];?>">Update</a>
    <a href = "http://localhost/ecommerce/singleCategory/<?=$result[$i]['id'];?>">Single</a>
<?php
}