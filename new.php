<?php
require_once('modules/startup.php');
require('modules/classes.php');
require('modules/repository.php');

$link = startup();
$getTitle = "Новая статья";

$title = '';
$content = '';
$error = false;

if(!empty($_POST) && isset($_POST['title']) && isset($_POST['content'])) {
    $new_article = ArticleRepo::add($link, $_POST['title'], $_POST['content']);
    if($new_article) {
        die(header('Location: editor.php'));
    }
    $title = $_POST['title'];
    $content = $_POST['content'];
    $error = true;
}

header('Content-type: text/html; charset=utf-8');
include('views/header.php');
include('views/v_new.php');
include('views/footer.php');