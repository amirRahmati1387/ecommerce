<?php

class loadFile{
    public function loadFile($className){
        $addres = $className.".php";
        if(!file_exists($addres)){
            $addres = "404.php";
        }
        include($addres);
    }
}