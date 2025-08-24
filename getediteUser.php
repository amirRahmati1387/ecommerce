<?php

$id = $_POST['id'];
User :: update($_POST) -> where("id", $id) -> get();