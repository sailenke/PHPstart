<a href="index.php">Главная</a> | <b>Консоль редактора</b>
<hr>
<a href="new.php"><button>Новая статья</button></a>
<table>
    <tr>
        <th width="50px">ID статьи</th>
        <th>Заголовок</th>
        <th>Краткое содержание</th>
    </tr>
    <?php foreach ($articles as $article): ?>
        <tr>
            <td><a href="article.php?id=<?php echo $article->getId();?>"><p><?php echo $article->getId();?></p></a></td>
            <td><a href="article.php?id=<?php echo $article->getId();?>"><p><?php echo $article->getTitle();?></p></a></td>
            <td class="intro"><a href="article.php?id=<?php echo $article->getId();?>"><p><?php echo $article->getIntro();?>...<span>подробнее</span></p></a></td>
        </tr>
    <?php endforeach ?>
</table>