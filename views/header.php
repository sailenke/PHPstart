<!DOCTYPE html>
<html>
<head>
    <title>Мини-блог</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="views/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1><?php echo $getTitle;?></h1>
            <?php /*if(isset($_SESSION['login'])): ?>
                <p>Привет, <?php $username ?>!</p>
            <?php endif */?>
        </header>
        <div class="content">