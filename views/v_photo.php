<a href="article.php?id=<?php echo $_GET['id'] ?>"><button>Назад</button></a>
<div class="photo-detail">
    <img src="img/<?php echo $name?>">
</div>
<p>Число просмотров: <?php echo $click?></p>
<form method="POST" enctype="multipart/form-data">
    <button type="submit" name="del">Удалить</button>
</form>