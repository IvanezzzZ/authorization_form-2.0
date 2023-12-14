<?php

require_once '../helpers.php';

checkAuth();

$user = currentUser();
$id = $user['id'];

$oldPass = $_POST['old_password'];
$newPass = $_POST['new_password'];
$newPassConfirm = $_POST['new_password_confirm'];

if (!password_verify($oldPass, $user['pass']))
{
    setMessage('error', 'Неверно введён текущий пароль');
    redirect('/passChange.php');
}

if (strlen($newPass) < 6)
{
    setMessage('error', 'Новый пароль слишком короткий');
    redirect('/passChange.php');
}

if ($newPass !== $newPassConfirm)
{
    setMessage('error', 'Пароли не совпадают');
    redirect('/passChange.php');
} else {
    $newPass = password_hash($newPass, PASSWORD_DEFAULT);
}

$link = connectDB();
$query = "UPDATE users SET pass='$newPass' WHERE id='$id'";
mysqli_query($link, $query) or die(mysqli_error($link));

logout();