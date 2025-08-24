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
$count = $table -> num_rows / 5;
for($i = 1 ; $i -1 < $count; $i++){?>
    <a href = "http://localhost/ecommerce/listUser/page/<?php echo $i?>"><?php echo $i?></a>
<?php
}
echo"</br>";
echo"______________________________________________";
echo"</br>";
echo"______________________________________________";
echo"</br>";
echo"</br>";

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