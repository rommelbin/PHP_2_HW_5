Hello world! 23.03.2012
<?php foreach($news as $key => $val): ?>
<h2><?=$val['title']?></h2>
<h4><?=$val['text']?></h4>
<h5><?=$val['id']?> </h5>
<?php endforeach;?>