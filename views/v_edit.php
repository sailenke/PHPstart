<a href="index.php">Главная</a> | <a href="editor.php">Консоль редактора</a>
<hr>
<h2>Статья <?php echo $title?></h2>
<a href="editor.php"><button>Назад</button></a><br>
<?php if ($error): ?>
    <?php foreach($error_message as $msg):?>
        <span class="error"><?php echo $msg?></span><br>
    <?php endforeach;?>
<?php endif; ?>
<form method="POST" enctype="multipart/form-data">
    Название: <br>
    <input type="text" name="titleNew" value="<?php echo $title ?>">
    <br><br>
    Содержание: <br>
    <textarea name="contentNew"><?php echo $content?></textarea>
    <br>
    <input type="file" name="image"><br><br>
    <button type="submit">OK</button>
</form>