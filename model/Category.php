<?php

class Category extends model{
    public static $tableName = "category";
    public static $relatedTo = ['product'=>['id', 'category']];
}