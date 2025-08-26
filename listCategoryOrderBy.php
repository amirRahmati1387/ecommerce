<?php


$table = Category :: select() -> countQuery(['product_count'=>['product']]) -> orderBy("product_count " , $_POST['sort']) -> get();

while($result = $table -> fetch_assoc()){?>
    <div>
        <div><?=$result['title'];?></div>
        <div><?=$result['description'];?></div>
        <div><?=$result['product_count'];?></div>
    </div>
    <a href = "http://localhost/ecommerce/deleteCategory/<?=$result['id'];?>">Delete</a>
    <a href = "http://localhost/ecommerce/editeCategory/<?=$result['id'];?>">Update</a>
    <a href = "http://localhost/ecommerce/singleCategory/<?=$result['id'];?>">Single</a>
<?php
}

?>