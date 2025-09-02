<?php


$table = Category :: select() -> countQuery(['product_count'=>['product']] , 'left') -> orderBy("product_count " , $_POST['sort']);

for($i = 0 ; $i < count($table) ; $i++){?>
    <div>
        <div><?=$table[$i]['title'];?></div>
        <div><?=$table[$i]['description'];?></div>
        <div><?=$table[$i]['product_count'];?></div>
    </div>
    <a href = "http://localhost/ecommerce/deleteCategory/<?=$table[$i]['id'];?>">Delete</a>
    <a href = "http://localhost/ecommerce/editeCategory/<?=$table[$i]['id'];?>">Update</a>
    <a href = "http://localhost/ecommerce/singleCategory/<?=$table[$i]['id'];?>">Single</a>
<?php
}

?>