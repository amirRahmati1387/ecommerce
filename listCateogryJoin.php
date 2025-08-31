<?php


$crud = Category :: select('category.*') -> whidQuery('product' , ['pro_count' => ['category' , 'id']] , $_POST['join']);


for($i = 0 ; $i < count($crud) ; $i++){?>
    <div>
        <div><?php echo $crud[$i]['id']?></div>
        <div><?php echo $crud[$i]['title']?></div>
        <div><?php echo $crud[$i]['description']?></div>
        <div><?php echo $crud[$i]['pro_count']?></div>
        <a href = "http://localhost/ecommerce/deleteCategory/<?=$crud[$i]['id'];?>">Delete</a>
    <a href = "http://localhost/ecommerce/editeCategory/<?=$crud[$i]['id'];?>">Update</a>
    <a href = "http://localhost/ecommerce/singleCategory/<?=$crud[$i]['id'];?>">Single</a>
    </div>
 

<?php
}
?>