<a href="index.php">Главная</a> | <a href="editor.php">Консоль редактора</a>
<hr>
<?php if($error):?>
    <span class="error">Заполните все поля!</span>
<?php endif;?>
<form method="POST" enctype="multipart/form-data">
    Название<sup style="color:red;">*</sup>: <br>
    <input type="text" name="title" value="<?php echo $title ?>">
    <br><br>
    Содержание: <br>
    <textarea name="content"><?php echo $content?></textarea>
    <br>
    <button type="submit">Добавить</button>
</form>
<a href="editor.php"><button>Отмена</button></a>