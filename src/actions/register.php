<?php

require_once __DIR__ . '/../helpers.php';

$name = $_POST['name'] ?? null;
$email = $_POST['email'] ?? null;
$password = $_POST['password'] ?? null;
$passwordConfirmation = $_POST['password_confirmation'] ?? null;
$avatar = $_FILES['avatar'] ?? null;

$_SESSION['validation'] = [];

//Валидация
if (empty($name))
{
    addValidationError('name', 'Неверное имя');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL))
{
    addValidationError('email', 'Указана неправильная почта');
}

if (empty($password))
{
    addValidationError('password', 'Пустой пароль');
}

if ($password !== $passwordConfirmation)
{
    addValidationError('password', 'Пароли не совпадают');
} else {
    $password = password_hash($password, PASSWORD_DEFAULT);
}

if (!empty($avatar))
{
    $types = ['image/jpeg', 'image/png'];

    if (!in_array($avatar['type'], $types))
    {
        addValidationError('avatar', 'Тип файла не поддерживается');
    }

    if (($avatar['size'] / 1000000) >= 1)
    {
        addValidationError('avatar', 'Изображение должно весить не более 1 мб');
    }

}

//Если массив с ошибками валидации НЕ пустой - редирект обратно на форму регистрации

if (!empty($_SESSION['validation'])){
    //оставляем уже введённые значения в полях формы
    addOldValue('name', $name);
    addOldValue('email', $email);
    redirect('/../register.php');
}

if (!empty($avatar))
{
    $pathFile = uploadFile($avatar, 'avatar_');
}

$link = connectDB();
$query = "INSERT INTO users (name, pass, email, avatar_path) VALUES ('$name', '$password', '$email', '$pathFile')";
mysqli_query($link, $query) or die(mysqli_error($link));

redirect('/index.php');