<?php

Category :: update($_POST) -> where("id", $_POST['id']) -> get();