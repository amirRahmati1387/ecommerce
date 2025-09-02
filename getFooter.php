<?php

$table = Footer :: all();
if(count($table) == 1){
    Footer :: update($_POST);
}
if(count($table) == 0){
    Footer :: create($_POST);
}