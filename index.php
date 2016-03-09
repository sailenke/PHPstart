<?php
require_once('modules/startup.php');

$getTitle = "Добро пожаловать!";

header('Content-type: text/html; charset=utf-8');
include('views/header.php');
include('views/v_index.php');
include('views/footer.php');