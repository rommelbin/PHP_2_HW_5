<?php foreach ($catalog as $key => $val): ?>

<h1><?=$val['name']?></h1>
<h2><?=$val['price']?></h2>
<h4><?=$val['description']?></h4>
<h3><?=$val['manufacturer']?></h3>
    <a href="/product/card/?id=<?=$val['id']?>">Перейти</a>
<?php endforeach;?>

<a href="/product/catalog/?page=0">1</a>
<a href="/product/catalog/?page=1">2</a>
<a href="/product/catalog/?page=2">3</a>
<a href="/product/catalog/?page=3">4</a>
