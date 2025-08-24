<?php

$start = $_POST['start'];
$end = $_POST['end'];
$table = User :: limit($start , $end) -> get();
while($result = $table -> fetch_assoc()){?>
    <div>
        <div><?=$result['name'];?></div>
        <div><?=$result['family'];?></div>
        <div><?=$result['phonNumber'];?></div>
    </div>
    <a href = "http://localhost/ecommerce/deleteUser/<?=$result['id'];?>">Delete</a>
    <a href = "http://localhost/ecommerce/editeUser/<?=$result['id'];?>">Update</a>
    <a href = "http://localhost/ecommerce/singleUser/<?=$result['id'];?>">Single</a>
<?php
}