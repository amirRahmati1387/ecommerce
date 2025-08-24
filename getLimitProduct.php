<?php

if(empty($_POST)){
    $start = $GLOBALS["roterKey"][5];
    $end = $GLOBALS["roterKey"][6];
}else{
    $start = $_POST["start"];
    $end = $_POST["end"];
}
$table = Product :: limit($start , $end) -> get();
while($row = $table -> fetch_assoc()){
    $array []= $row;
}

for($i = 0 ; $i < count($array) ; $i++){
    for($j = $i ; $j < count($array) ; $j++){
        if($array[$i]['price'] > $array[$j]['price']){
            $min = $array[$j];
            $array[$j] = $array[$i];
            $array[$i] = $min;
        }
    }
}

$coant = count($array);
$page = 5;
$key = $GLOBALS["roterKey"][4];
$offset = ($key - 1) * 5;
$limit = $offset + $page;
for($i = $offset ; $i < $limit; $i++){
    if($coant > $i){
    $id = $array[$i]['category'];
    $key = Category :: find() -> where("id",$id) -> get() -> fetch_assoc();?>
    <div>
        <div><?= $array[$i]['name'];?></div>
        <div><?= $array[$i]['price'];?></div>
        <div><?= $key['title'];?></div>
        <div><?= $array[$i]['description'];?></div>
    </div>
    <a href = "http://localhost/ecommerce/deleteProduct/<?=$array[$i]["id"];?>">Delete</a>
    <a href = "http://localhost/ecommerce/editProduct/<?=$array[$i]["id"];?>">Update</a>
    <a href = "http://localhost/ecommerce/singleProduct/<?=$array[$i]["id"];?>">Single</a>
    <?php
    }
}
echo "</br>";
echo"____________________________________________";
echo "</br>";
echo"____________________________________________";
echo "</br>";

$count = ceil($coant / 5);
for($i = 1 ; $i <= $count ; $i++){?>
    <a href = "http://localhost/ecommerce/getLimitProduct/page/<?php echo $i ?>/<?php echo $start?>/<?php echo $end?>"><?php echo $i?></a>
<?php
}