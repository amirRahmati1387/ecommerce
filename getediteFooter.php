<?php

$id = $_POST['id'];
Footer :: update($_POST) -> where("id", $id) -> get();