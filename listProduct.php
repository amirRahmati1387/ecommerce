<form action = "http://localhost/ecommerce/getLimitProduct/page/1" method = "POST">
    <input type = "int" name = "start" placeholder = "start">
    <input type = "int" name = "end" placeholder = "end">
    <button>ok</button>
</form>

<?php
echo"______________________________________________";
echo"</br>";
echo"</br>";
?>

<form action = "http://localhost/ecommerce/listProduct/page/1/" method = "POST">
    <select name = "fild">
        <option value = "price">price</option>
    </select>
    <select name = "sort">
        <option value = "asc">asc</option>
        <option value = "desc">desc</option>
    </select>
    <button>send</button>
</form>

<?php
echo"______________________________________________";
echo"</br>";
echo"</br>";
?>

<form action = "http://localhost/ecommerce/serchProduct" method = "POST">
    <select name = "serch"><option value = "name">name</option></select>
    <input type = "text" name = "name">
    <button>send</button>
</form>

<?php
echo"______________________________________________";
echo"</br>";
echo"</br>";

if($_POST){
    $price= $_POST['fild'];
    $sort = $_POST['sort'];
}else if(count($GLOBALS["roterKey"]) > 5){
    $price = $GLOBALS["roterKey"][5];
    $sort = $GLOBALS["roterKey"][6];
}

if(count($GLOBALS["roterKey"]) > 5){
    // $table = Product :: select() -> where(" price " , 100 , " > " ) -> sort($price , $sort);
    // $join = Product :: select() -> join("Category") -> sort($price , $sort);
    // $test = Product :: category('category' , ['id' ,  'name' ,'price', 'category' , 'description']) -> sort($price , $sort);
    // $test = Product :: category('category' , ['*']) -> sort($price , $sort);
    $test = Product :: select(["product.id" , "product.name" , "product.price" , "product.category" , "product.description"]) -> case("pro_POINT") -> sort($price , $sort);

    $count = count($test);
    $page = 5;
    $key = $GLOBALS["roterKey"][4];
    $offset = ($key - 1) * 5;
    $limit = $offset + $page;
    
    // $test = Product :: select() -> subQuery(["category_title" => ["category" , "title"]]) -> get();
    for($i = $offset ; $i < $limit; $i++){
        // $row = $test -> fetch_assoc();
        if($count > $i){?>
        <div>
            <div><?= $test[$i]['id'];?></div>
            <div><?= $test[$i]['name'];?></div>
            <div><?= $test[$i]['price'];?></div>
            <div><?= $test[$i]['category'];?></div>
            <div><?= $test[$i]['description'];?></div>
            <div><?= $test[$i]['pro_POINT'];?></div>
        </div>
        <a href = "http://localhost/ecommerce/deleteProduct/<?=$test[$i]["id"];?>">Delete</a>
        <a href = "http://localhost/ecommerce/editProduct/<?=$test[$i]["id"];?>">Update</a>
        <a href = "http://localhost/ecommerce/singleProduct/<?=$test[$i]["id"];?>">Single</a>
        <?php
        }
    }

    echo"</br>";
    echo"______________________________________________";
    echo"</br>";
    echo"______________________________________________";
    echo"</br>";

    $count = ceil($count / 5);
    for($i = 1 ; $i <= $count ; $i++){?>
        <a href = "http://localhost/ecommerce/listProduct/page/<?php echo $i ?>/<?php echo $price?>/<?php echo $sort?>"><?php echo $i?></a>
    <?php
    }
}else{
    echo"<h1>Pleas enter [asc / desc]</h1>";
}