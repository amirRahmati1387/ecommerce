<?php

$key = $_SERVER['REQUEST_URI'];

class roter{
    public $uri;
    public $uriArray;
    public function __construct($uri){
       $this -> uri = $uri;
    }
    public function uriArray(){
        return $this -> uriArray = explode("/", $this -> uri);
    }
}