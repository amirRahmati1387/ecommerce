<form action = "http://localhost/ecommerce/getLimitUser" method = "POST">
    <input type = "int" name = "start" placeholder = "offset/limit">
    <input type = "int" name = "end" placeholder = "limit/offset">
    <button>ok</button>
</form>

<?php
echo"______________________________________________";
echo"</br>";
echo"</br>";
?>
<form action = "http://localhost/ecommerce/serchUser" method = "POST">
    <select name = "serch"><option value = "family">name</option></select>
    <input type = "text" name = "name">
    <button>send</button>
</form>
<?php
echo"______________________________________________";
echo"</br>";
echo"</br>";

$table = User :: pagenate();

echo"______________________________________________";
echo"</br>";
echo"</br>";

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

echo"</br>";
echo"______________________________________________";
echo"</br>";
echo"</br>";


$count = ceil(count($table) / 5);
for($i = 1 ; $i <= $count; $i++){?>
    <a href = "http://localhost/ecommerce/listUser/page/<?php echo $i?>"><?php echo $i?></a>
<?php
}