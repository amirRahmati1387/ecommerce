<?php

$table = Footer :: select() -> get();
while($result = $table -> fetch_assoc()){?>
    <div>
        <div><?=$result['id'];?></div>
        <div><?=$result['nameDesigner'];?></div>
        <div><?=$result['description'];?></div>
        <div><?=$result['phonNumber'];?></div>
    </div>
    <a href = "http://localhost/ecommerce/deleteFooter/<?=$result['id'];?>">Delete</a>
    <a href = "http://localhost/ecommerce/editeFooter/<?=$result['id'];?>">Update</a>
    <a href = "http://localhost/ecommerce/singleFooter/<?=$result['id'];?>">Single</a>
<?php    
}