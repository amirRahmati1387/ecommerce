<?php

$table = Footer :: all();
for($i = 0 ; $i < count($table) ; $i++){?>
    <div>
        <div><?=$table[$i]['id'];?></div>
        <div><?=$table[$i]['nameDesigner'];?></div>
        <div><?=$table[$i]['description'];?></div>
        <div><?=$table[$i]['phonNumber'];?></div>
    </div>
    <a href = "http://localhost/ecommerce/deleteFooter/<?=$table[$i]['id'];?>">Delete</a>
    <a href = "http://localhost/ecommerce/editeFooter/<?=$table[$i]['id'];?>">Update</a>
    <a href = "http://localhost/ecommerce/singleFooter/<?=$table[$i]['id'];?>">Single</a>
<?php    
}