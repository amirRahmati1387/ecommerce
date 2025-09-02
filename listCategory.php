<form action = "http://localhost/ecommerce/getLimitCategory" method = "POST">
    <input type = "int" name = "start" placeholder = "start">
    <input type = "int" name = "end" placeholder = "end">
    <button>ok</button>
</form>

<?php
echo"______________________________________________";
echo"</br>";
echo"</br>";
?>

<form action = "http://localhost/ecommerce/serchCategory" method = "POST">
    <select name = "serch"><option value = "title">title</option></select>
    <input type = "text" name = "name">
    <button>send</button>
</form>

<?php
echo"______________________________________________";
echo"</br>";
echo"</br>";
?>

<form action = "http://localhost/ecommerce/listCateogryJoin" method = "POST">
    <select name = "join">
        <option value = "INNER">با دسته بندی</option>
        <option value = "LEFT">بدون دسته بندی</option>
    </select>
    <button>send</button>
</form>

<?php
echo"______________________________________________";
echo"</br>";
echo"</br>";
?>

<form action = "http://localhost/ecommerce/listCategoryOrderBy/page/1" method = "POST">
    <select name = "sort">
        <option value = "ASC">asc</option>
        <option value = "DESC">desc</option>
    </select>
    <button>send</button>
</form>

<?php
echo"______________________________________________";
echo"</br>";
echo"</br>";

// $table = Category :: select() -> countQuery(['product_count'=>['product']] , 'LIst') -> get();

$table = Category :: select("Category.id" , "Category.title" , "Category.description") -> if("LEFT" , "Product" , "name" , "'بدون محصول'" , " product_count");

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

echo"</br>";
echo"______________________________________________";
echo"</br>";
echo"______________________________________________";
echo"</br>";