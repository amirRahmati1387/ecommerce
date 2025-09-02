<?php

$table = User :: limit($_POST['start'] , $_POST['end']);
for($i = 0 ; $i < count($table) ; $i++){?>
    <div>
        <div><?=$table[$i]['name'];?></div>
        <div><?=$table[$i]['family'];?></div>
        <div><?=$table[$i]['phonNumber'];?></div>
    </div>
    <a href = "http://localhost/ecommerce/deleteUser/<?=$table[$i]['id'];?>">Delete</a>
    <a href = "http://localhost/ecommerce/editeUser/<?=$table[$i]['id'];?>">Update</a>
    <a href = "http://localhost/ecommerce/singleUser/<?=$table[$i]['id'];?>">Single</a>
<?php
}