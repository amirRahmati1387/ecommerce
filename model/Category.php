<?php

class Category extends facade{
    public $tableName = "category";
    public $relatedTo = ['product'=>['id', 'category']];
}