<?php
require_once('modules/startup.php');
require('modules/classes.php');
require('modules/repository.php');

$link = startup();
$getTitle="Редактирование статьи";

$titleNew = '';
$contentNew = '';
$change = false;
$error = false;
$error_message = [];

$arr = ArticleRepo::load($link, $_GET['id']);
$title = $arr->getTitle();
$content = $arr->getContent();

if(!empty($_POST) && isset($_POST['titleNew']) && isset($_POST['contentNew'])) {
    $titleNew = trim($_POST['titleNew']);
    $contentNew = trim($_POST['contentNew']);
    if(isset($_FILES['image'])) {
        if ($_FILES['image']['name'] != '') {
            $arrtype = array('image/jpeg', 'image/gif', 'image/png');
            if (in_array($_FILES['image']['type'], $arrtype) && $_FILES['image']['size'] < 1000000) {
                if (!is_dir("img")) {
                    mkdir("img");
                }
                if (ImageUpload::upload($link, $_FILES['image'])) {
                    $name = $_FILES['image']['name'];
                    $name = " '$name' ";
                    $add = ImageRepo::add($link, $name, $_GET['id']);
                    $change = true;
                }
            } else {
                $error = true;
                $error_message[] = 'Файл должен быть формата .jpg, .png или .gif и размером меньше 1Mb';
            }
        }
    }
    if(!empty($titleNew) && !empty($contentNew)) {
        if(ArticleRepo::edit($link, $_GET['id'], $_POST['titleNew'], $_POST['contentNew'])) {
            $title = $titleNew;
            $content = $contentNew;
            $change = true;
        }
    } else {
        $error = true;
        $error_message[] = "Заполните все поля!";
    }
}

if($change && !$error) {
    header("location: article.php?id=".$_GET['id']);
}

header('Content-type: text/html; charset=utf-8');
include('views/header.php');
include('views/v_edit.php');
include('views/footer.php');