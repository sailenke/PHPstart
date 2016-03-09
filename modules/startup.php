<?php
function startup() {
    setlocale(LC_ALL, 'ru_RU.UTF-8'); // Языковая настройка
    mb_internal_encoding('UTF-8');
    session_start();
    return getDbConnect();
}

function getDbConnect() {
    static $link;
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    if ($link === null) {
        $link = mysqli_connect($hostname, $username, $password) or die("No connect with database"); // подключаемся к БД
        mysqli_query($link, 'SET NAMES utf8');
        mysqli_set_charset($link, 'utf8');
        $db_selected = mysqli_select_db($link, 'db_nblog');
        if(!$db_selected) {
            mysqli_query($link, 'CREATE DATABASE db_nblog ');
            mysqli_query($link, 'ALTER DATABASE `db_nblog` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci'); // обновление базы в нужной кодировке
            $db_selected = mysqli_select_db($link, 'db_nblog');
            CreateDbRepo::articles($link);
            CreateDbRepo::images($link);
            CreateDbRepo::users($link);
            CreateDbRepo::sessions($link);
        }
        return $link;
    }
}
function sql_escape($link, $param) {
    return mysqli_escape_string($link, $param); // экранирование переменных
}