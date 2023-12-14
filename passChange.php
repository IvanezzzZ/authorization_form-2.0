<?php

require_once __DIR__ . '/src/helpers.php';

checkAuth()

?>
<!DOCTYPE html>
<html lang="ru" data-theme="light">

<?php include_once __DIR__ . '/components/head.php' ?>

<body>

<form class="card" action="src/actions/passChange.php" method="POST">
    <h2>Смена пароля</h2>

    <?php if (hasMessage('error')): ?>
        <div class="notice error"><?= getMessage('error') ?></div>
        <!--<div class="notice success">Какое-то сообщение</div>-->
    <?php endif; ?>

    <label for="password">
        Введите старый пароль
        <input
            type="password"
            id="old_password"
            name="old_password"
            placeholder="********"
            <?php checkError('email'); ?>
        >
        <?php if (hasValidationError('email')): ?>
            <small><?php getErrorMessage('email'); ?></small>
        <?php endif; ?>
    </label>

    <label for="password">
        Введите новый пароль
        <input
            type="password"
            id="new_password"
            name="new_password"
            placeholder="********"
            <?php checkError('password'); ?>
        >
        <?php if (hasValidationError('password')): ?>
            <small><?php getErrorMessage('password'); ?></small>
        <?php endif; ?>
    </label>

    <label for="password">
        Подтвердите новый пароль
        <input
            type="password"
            id="new_password_confirm"
            name="new_password_confirm"
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
    >Сменить пароль</button>
</form>

<!--<p>У меня еще нет <a href="/register.php">аккаунта</a></p>
-->
<?php include_once __DIR__ . '/components/scripts.php' ?>

</body>
</html>