<?php

class mainDB{
    public $serverName = "localhost";
    public $userName = "root";
    public $password = "";
    public $DBname = "ecommerce";
    public $connection;
    public $tableName; 
    public function __construct(){
        $this -> connection = new mysqli($this-> serverName , $this->  userName , $this->  password , $this->  DBname);
    }
}