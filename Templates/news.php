<?php foreach ($lastNews as $news) { ?>
<div style="width: 700px; background-color: #f1f1f1; border-radius: 20px; padding: 10px; margin: 20px">
    <h2><a href="article.php?id=<?=$news->id?>" style="text-decoration: none; color: black"><?=$news->header?></a></h2>
    <div><?=$news->newsBody?></div>
</div>
<?php } ?>
