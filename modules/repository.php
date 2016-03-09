<?php
class CreateDbRepo
{
    public static function articles($link)
    {
        mysqli_query($link, 'SET NAMES utf8');
        mysqli_set_charset($link, 'utf8');
        $result = mysqli_query($link, "CREATE TABLE `articles`(`id` INT NOT NULL AUTO_INCREMENT, `title` VARCHAR(250), `content` TEXT, PRIMARY KEY(`id`))");
        return $result;
    }
    public static function images($link)
    {
        $result = mysqli_query($link, "CREATE TABLE `images`(`id` INT NOT NULL AUTO_INCREMENT, `name` VARCHAR(50), `click` INT, `id_article` INT, PRIMARY KEY(`id`), FOREIGN KEY (`id_article`) REFERENCES  `articles`(`id`) ON DELETE CASCADE)");
        return $result;
    }
    public static function users($link)
    {
        mysqli_query($link, 'SET NAMES utf8');
        mysqli_set_charset($link, 'utf8');
        $result = mysqli_query($link, "CREATE TABLE `users`(`id` INT NOT NULL AUTO_INCREMENT, `login` VARCHAR(50), `password` TEXT, `role` INT, PRIMARY KEY(`id`))");
        return $result;
    }
    public static function sessions($link)
    {
        $result = mysqli_query($link, "CREATE TABLE `sessions`(`id` INT NOT NULL AUTO_INCREMENT, `id_user` INT, `sid` VARCHAR(10), `time_start` DATETIME, `time_last` DATETIME, PRIMARY KEY(`id`))");
        return $result;
    }
}
class ArticleRepo
{
    public static function loadAll($link)
    {
        $sql = "SELECT `id`,`title`,`content`, SUBSTRING(`content`, 1, 50) as intro FROM `articles` ORDER BY id DESC";
        $result = mysqli_query($link, $sql);
        $articles = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $title = $row['title'];
            $content = $row['content'];
            $intro = $row['intro'];
            $article = new Article($id, $title, $content, $intro);
            $articles[] = $article;
        }
        return $articles;
    }
    public static function load($link, $id)
    {
        $sql = "SELECT * FROM `articles` WHERE `id` = $id";
        $result = mysqli_query($link, $sql);
        $article = '';
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $title = $row['title'];
            $content = $row['content'];
            $article = new Article($id, $title, $content, 0);
        }
        return $article;
    }
    public static function add($link, $title, $content)
    {
        $title = trim($title);
        $content = trim($content);
        if ($title == '') {
            return false;
        }
        $sql = "INSERT INTO `articles` (`title`, `content`) VALUES ('%s', '%s')";
        $query = sprintf($sql, sql_escape($link, $title), sql_escape($link, $content));
        $result = mysqli_query($link, $query);
        return $result;
    }
    public static function edit($link, $id, $title, $content)
    {
        $id = (int)$id;
        $sql = "UPDATE `articles` SET `title` = '%s', `content` = '%s' WHERE `id` = $id";
        $query = sprintf($sql, sql_escape($link, $title), sql_escape($link, $content));
        $result = mysqli_query($link, $query);
        return $result;
    }
    public static function delete($link, $id)
    {
        $sql = "DELETE FROM `articles` WHERE `id` = $id";
        $result = mysqli_query($link, $sql);
        return $result;
    }
}
class ImageRepo
{
    public static function loadAll($link, $id_article)
    {
        $sql = "SELECT * FROM `images` WHERE `id_article`=$id_article ORDER BY `click` DESC";
        $result = mysqli_query($link, $sql);
        $images = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $name = $row['name'];
            $click = $row['click'];
            $id_article = $row['id_article'];
            $image = new Image($id, $name, $click, $id_article);
            $images[] = $image;
        }
        return $images;
    }
    public static function load($link, $id)
    {
        $sql = "SELECT * FROM `images` WHERE `id` = $id"; //выбор имени файла из базы
        $result = mysqli_query($link, $sql);
        $image = '';
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $name = $row['name'];
            $click = $row['click'];
            $id_article = $row['id_article'];
            $image = new Image($id, $name, $click, $id_article);
        }
        return $image;
    }
    public static function add($link, $img_name, $id_article)
    {
        $sql = "INSERT INTO `images`(`name`, `click`, `id_article`) VALUES ($img_name, 0, $id_article)";
        $result = mysqli_query($link, $sql);
        return $result;
    }
    public static function delete($link, $id)
    {
        $sql = "DELETE FROM `images` WHERE `id` = $id";
        $result = mysqli_query($link, $sql);
        return $result;
    }
    public static function update($link, $id)
    {
        $sql = "UPDATE `images` SET `click` = `click` + 1 WHERE `id`=$id";
        $result = mysqli_query($link, $sql);
        return $result;
    }
}
class ImageUpload
{
    public static function upload($link, $file)
    {
        if (copy($file['tmp_name'], 'img/' . $file['name'])) {
            ImageUpload::resize($file);
            return true;
        } else {
            return $error_message = 'Ошибка загрузки файла';
        }
    }

    public static function resize($file)
    {
        $filename = $file['name'];
        list($width, $height) = getimagesize('img/' . $filename); //получаем размеры исходного изображения
        $newwidth = $width * 0.3; //уменьшаем на 70%
        $newheight = $height * 0.3;
        $thumb = imagecreatetruecolor($newwidth, $newheight); //создаем пустышку с уменьшенными размерами
        switch ($file['type']) {
            case 'image/jpeg':
                $source = imagecreatefromjpeg('img/' . $filename); //создает объект из картинки формата .jpg
                break;
            case 'image/gif':
                $source = imagecreatefromgif('img/' . $filename); //.gif
                break;
            case 'image/png':
                $source = imagecreatefrompng('img/' . $filename); //.png
                break;
        }
        imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height); //накладывает изображение на пустышку с определенными размерами
        if (!is_dir("img_p")) {
            mkdir("img_p"); // создает папку для превьюшек, если её не было
        }
        imagejpeg($thumb, 'img_p/' . $filename, 75);
    }
}
class UserRepo
{
    public static function add($link, $login, $password)
    {
        $login = trim($login);
        $password = trim($password);
        if ($login == '') {
            return false;
        }
        $sql = "INSERT INTO `users` (`login`, `password`) VALUES ('%s', '%s')";
        $query = sprintf($sql, sql_escape($link, $login), sql_escape($link, $password));
        $result = mysqli_query($link, $query);
        return $result;
    }
}