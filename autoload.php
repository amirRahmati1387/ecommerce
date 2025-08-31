<?php

class autoload{
    public function autoload($className){
        $addres = "model/".$className . ".php";
        if($className == "loadFile" || $className == "factory" || $className == "facade"){
            $addres = $className .".php";
        }
        include($addres);
    }
}
$autoload = new autoload;
spl_autoload_register([$autoload , "autoload"]);