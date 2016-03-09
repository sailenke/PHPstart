<?php
require_once('modules/startup.php');
require('modules/classes.php');
require('modules/repository.php');

$link = startup();
$getTitle = "Фотогалерея";
$id = $_GET['img'];

$update = ImageRepo::update($link, $id);
$image = ImageRepo::load($link, $id);
$name = $image->getName();
$click = $image->getClick();

if(isset($_POST['del'])) {
    ImageRepo::delete($link, $id);
    header('location:article.php?id='.$_GET['id']);
}

header('Content-type: text/html; charset=utf-8');
include('views/header.php');
include('views/v_photo.php');
include('views/footer.php');