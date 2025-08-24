<?php

class Product extends model{
    public static $tableName = "product";
    public static $relatedTo = ["product" => ["category" , "id"]];
    public $case = [
        "WHEN 1 " => ["THEN بد"],
        "WHEN 2 " => ["THEN خوب"],
        "WHEN 3 " => ["THEN عالی"],
        "WHEN 4 " => ["THEN لجند"]
    ];
    public static function category($className_category ,array $filds){
        $className_product = static :: class;
        $className_product = factory :: factory($className_product);
        $className_product -> belongsTo($className_category , $filds);
        return $className_product;
    }
}