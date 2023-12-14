<?php

require_once __DIR__ . '/src/helpers.php';

checkAuth()

?>
<!DOCTYPE html>
<html lang="ru" data-theme="light">

<?php include_once __DIR__ . '/components/head.php' ?>

<body>

<form class="card" action="src/actions/delProfile.php" method="POST">
    <h2>Удаление аккаунта</h2>

    <?php if (hasMessage('error')): ?>
        <div class="notice error"><?= getMessage('error') ?></div>
        <!--<div class="notice success">Какое-то сообщение</div>-->
    <?php endif; ?>

    <label for="password">
        Введите пароль
        <input
            type="password"
            id="password"
            name="password"
            placeholder="********"
            <?php checkError('password'); ?>
        >
        <?php if (hasValidationError('password')): ?>
            <small><?php getErrorMessage('password'); ?></small>
        <?php endif; ?>
    </label>

    <button
        type="submit"
        id="submit"
    >Удалить аккаунт</button>
</form>

<!--<p>У меня еще нет <a href="/register.php">аккаунта</a></p>
-->
<?php include_once __DIR__ . '/components/scripts.php' ?>

</body>
</html>