<?php
require_once __DIR__ . '/src/helpers.php';

checkGuest();

?>
<!DOCTYPE html>
<html lang="ru" data-theme="light">

<?php include_once __DIR__ . '/components/head.php' ?>

<body>

<form class="card" action="src/actions/register.php" method="POST" enctype="multipart/form-data">
    <h2>Регистрация</h2>

    <label for="name">
        Имя
        <input
            type="text"
            id="name"
            name="name"
            placeholder="Иванов Иван"
            value="<?php echo showOldValue('name'); ?>"
            <?php checkError('name'); ?>
        >
        <?php if (hasValidationError('name')): ?>
        <small><?php getErrorMessage('name'); ?></small>
        <?php endif; ?>
    </label>

    <label for="email">
        E-mail
        <input
            type="text"
            id="email"
            name="email"
            placeholder="ivan@areaweb.su"
            value="<?php echo showOldValue('email'); ?>"
            <?php checkError('email'); ?>
        >
        <?php if (hasValidationError('email')): ?>
            <small><?php getErrorMessage('email'); ?></small>
        <?php endif; ?>
    </label>

    <label for="avatar">Изображение профиля
        <input
            type="file"
            id="avatar"
            name="avatar"
            <?php checkError('avatar'); ?>
        >
        <?php if (hasValidationError('avatar')): ?>
            <small><?php getErrorMessage('avatar'); ?></small>
        <?php endif; ?>
    </label>

    <div class="grid">
        <label for="password">
            Пароль
            <input
                type="password"
                id="password"
                name="password"
                placeholder="******"
                <?php checkError('password'); ?>
            >
            <?php if (hasValidationError('password')): ?>
                <small><?php getErrorMessage('password'); ?></small>
            <?php endif; ?>
        </label>

        <label for="password_confirmation">
            Подтверждение
            <input
                type="password"
                id="password_confirmation"
                name="password_confirmation"
                placeholder="******"
            >
        </label>
    </div>

    <fieldset>
        <label for="terms">
            <input
                type="checkbox"
                id="terms"
                name="terms"
            >
            Я принимаю все условия пользования
        </label>
    </fieldset>

    <button
        type="submit"
        id="submit"
        disabled
    >Продолжить</button>
</form>

<p>У меня уже есть <a href="/index.php">аккаунт</a></p>

<?php include_once __DIR__ . '/components/scripts.php' ?>

</body>
</html>
