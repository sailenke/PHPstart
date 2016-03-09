<?php
require_once('modules/startup.php');
require('modules/classes.php');
require('modules/repository.php');

$link = startup();
$getTitle = "Список статей";

$articles=ArticleRepo::loadAll($link);

header('Content-type: text/html; charset=utf-8');
include('views/header.php');
include('views/v_all.php');
include('views/footer.php');