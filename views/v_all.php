<a href="editor.php"><button>Консоль редактора</button></a>
<h2>Все статьи</h2>
	<?php foreach ($articles as $article):?>
        <h3><?php echo $article->getTitle() ?></h3>
        <p><?php echo $article->getContent(); ?></p>
        <hr>
    <?php endforeach ?>