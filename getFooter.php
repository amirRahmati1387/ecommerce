<?php

$table = Footer :: all();
if($table -> num_rows){
    $row = $table->fetch_assoc();
    $id = $row['id'];
    Footer :: update($_POST) -> where("id", $id) -> get();
}
if(!$table -> num_rows){
    Footer :: create($_POST) -> get();
}