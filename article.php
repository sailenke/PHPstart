<?php
require_once('modules/startup.php');
require('modules/classes.php');
require('modules/repository.php');

$link = startup();
$id = $_GET['id'];

$article_get = ArticleRepo::load($link, $id);
$article_title = $article_get->getTitle();
$article_content = $article_get->getContent();
$getTitle = $article_title;
$img_get = array();
if (isset($_POST['edit'])) {
    header("location: edit.php?id=".$_GET['id']);
}
if (isset($_POST['delete'])) {
    if (ArticleRepo::delete($link, $id)) {
        header("location: editor.php");
    }
}
if (is_dir("img_p")) {
    $img_get = ImageRepo::loadAll($link, $id);
}

header('Content-type: text/html; charset=utf-8');
include('views/header.php');
include('views/v_article.php');
include('views/footer.php');