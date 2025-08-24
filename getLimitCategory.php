<?php

$start = $_POST['start'];
$end = $_POST['end'];
$table = Category :: limit($start , $end) -> get();
while($result = $table -> fetch_assoc()){?>
    <div>
        <div><?=$result['title'];?></div>
        <div><?=$result['description'];?></div>
    </div>
    <a href = "http://localhost/ecommerce/deleteCategory/<?=$result['id'];?>">Delete</a>
    <a href = "http://localhost/ecommerce/editeCategory/<?=$result['id'];?>">Update</a>
    <a href = "http://localhost/ecommerce/singleCategory/<?=$result['id'];?>">Single</a>
<?php
}