<?php

require_once __DIR__ . '/../helpers.php';

//маил - поиск юзера в БД - сверить пароли - емли всё ок авторизация
$email = $_POST['email'] ?? null;
$password = $_POST['password'] ?? null;

if (empty($email) or !filter_var($email, FILTER_VALIDATE_EMAIL)){
    addOldValue('email', $email);
    addValidationError('email', 'Неверный формат электронной почты');
    setMessage('error', 'Ошибка авторизации');
    redirect('/');
}

$user = findUser($email);

if (!$user)
{
    setMessage('error', "Пользователь $email не найден");
    redirect('/');
}

if (!password_verify($password, $user['pass']))
{
    setMessage('error', 'Неверный пароль');
    redirect('/');
}

$_SESSION['user']['id'] = $user['id'];

redirect('/home.php');
