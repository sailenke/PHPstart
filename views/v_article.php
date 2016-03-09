<a href="index.php">Главная</a> | <a href="editor.php">Консоль редактора</a> | <b><?php echo $article_title?></b>
<hr>
<a href="editor.php"><button name="redir">Назад</button></a><br>
<h4><?php echo $article_title?></h4>
<article><?php echo $article_content?></article>
<form method="POST" enctype="multipart/form-data">
    <button name="edit">Редактировать</button>
    <button name="delete">Удалить статью</button>
</form>
<h4>Фотогалерея</h4>
<div class="photo">
    <?php foreach($img_get as $image):
    $img_name=$image->getName();
    $img_id=$image->getId();
    $article_id=$image->getIdArticle();?>
    <a href="photo.php?img=<?php echo $img_id?>&id=<?php echo $article_id?>"><img src="img_p\<?php echo $img_name?>">
    <?php endforeach;?>
</div>