<?php

require_once __DIR__ . '/src/helpers.php';

checkAuth();

$user = currentUser();

?>

<!DOCTYPE html>
<html lang="ru" data-theme="light">

<?php include_once __DIR__ . '/components/head.php' ?>

<body>

<div class="card home">
    <img
        class="avatar"
        src="<?php echo $user['avatar_path'] ?>"
        alt="<?php echo $user['name'] ?>"
    >
    <h1>Привет, <?php echo $user['name'] ?>!</h1>
    <form action="passChange.php" method="post">
        <button role="button">Сменить пароль</button>
    </form>
    <form action="delProfile.php" method="post">
        <button role="button">Удалить аккаунт</button>
    </form>
    <form action="/src/actions/logout.php" method="post">
        <button role="button">Выйти из аккаунта</button>
    </form>
</div>

<?php include_once __DIR__ . '/components/scripts.php' ?>

</body>
</html>