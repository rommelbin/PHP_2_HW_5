<?php if($isAuth): ?>
Добро пожаловать, <?=$username?>.  <a href="/auth/logout/">Выйти</a>
<?php else: ?>
<form action="/auth/login" method="post">
    <input type="text" name="login" placeholder="Ваше имя">
    <br>
    <input type="password" name="password" placeholder="Ваш пароль">
    <br>
    <input type="checkbox" value="save" name="save"> Save?
    <input type="submit">
</form>
<a href="/reg/regPage">Зарегистрироваться</a>
<?php endif;?>