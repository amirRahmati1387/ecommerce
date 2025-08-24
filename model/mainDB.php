<?php

class mainDB{
    public static $serverName = "localhost";
    public static $userName = "root";
    public static $password = "";
    public static $DBname = "ecommerce";
    public static $connection;
    public static $tableName; 
    public function __construct(){
        self :: $connection = new mysqli(self :: $serverName , self :: $userName , self :: $password , self :: $DBname);
    }
}