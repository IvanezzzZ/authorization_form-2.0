<?php

require_once '../helpers.php';

checkAuth();

$user = currentUser();
$id = $user['id'];

$password = $_POST['password'];

if (!password_verify($password, $user['pass']))
{
    setMessage('error', 'Неверный пароль');
    redirect('/delProfile.php');
}

$link = connectDB();
$query = "DELETE FROM users WHERE id='$id'";
mysqli_query($link, $query) or die(mysqli_error($link));

logout();