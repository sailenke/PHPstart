<?php
require_once('modules/startup.php');
require('modules/classes.php');
require('modules/repository.php');

$link = startup();
$getTitle = "Консоль редактора";

$articles=ArticleRepo::loadAll($link);

header('Content-type: text/html; charset=utf-8');
include('views/header.php');
include('views/v_editor.php');
include('views/footer.php');