<?php


$crud = Category :: select(['category.*']) -> whidQuery('product' , ['pro_count' => ['category' , 'id']] , $_POST['join']) -> get();

while($row = $crud -> fetch_assoc()){?>
    <div>
        <div><?php echo $row['id']?></div>
        <div><?php echo $row['title']?></div>
        <div><?php echo $row['description']?></div>
        <div><?php echo $row['pro_count']?></div>
        <a href = "http://localhost/ecommerce/deleteCategory/<?=$row['id'];?>">Delete</a>
    <a href = "http://localhost/ecommerce/editeCategory/<?=$row['id'];?>">Update</a>
    <a href = "http://localhost/ecommerce/singleCategory/<?=$row['id'];?>">Single</a>
    </div>
 

<?php
}
?>