<?php

session_start();

require_once __DIR__ . '/connect.php';

function redirect($path)
{
    header("Location: $path");
    die();
}

function addValidationError($fieldName, $message)
{
    $_SESSION['validation'][$fieldName] = $message;
}

function checkError($fieldName)
{
    echo ($_SESSION['validation'][$fieldName]) ? 'aria-invalid="true"' : '';
}

function hasValidationError($fieldName)
{
    return isset($_SESSION['validation'][$fieldName]);
}

function getErrorMessage($fieldName)
{
    $message = ($_SESSION['validation'][$fieldName]) ?? '';
    unset($_SESSION['validation'][$fieldName]);
    return $message;
}

function addOldValue($key, $value)
{
    $_SESSION['old'][$key] = $value;
}

function showOldValue($key)
{
    $value = $_SESSION['old'][$key] ?? '';
    unset($_SESSION['old'][$key]);
    return $value;
}

function uploadFile($file, $prefix)
{
    $uploadPath = '../../upload';

    if (!is_dir($uploadPath))
    {
        mkdir($uploadPath);
    }

    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $fileName = "$prefix" . '_' . time() . ".$ext";

    if (!move_uploaded_file($file['tmp_name'], "$uploadPath/$fileName"))
    {
        die('Ошибка при загрузке изображения на сервер');
    }

    return "upload/$fileName";
}

function setMessage($key, $message)
{
    $_SESSION['message'][$key] = $message;
}

function hasMessage($key)
{
    return isset($_SESSION['message'][$key]);
}

function getMessage($key)
{
    $message = $_SESSION['message'][$key] ?? '';
    unset($_SESSION['message'][$key]);
    return $message;
}

function connectDB()
{
    return mysqli_connect(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME);
}

function findUser($email)
{
    $link = connectDB();

    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    return mysqli_fetch_assoc($result);
}

function currentUser()
{
    $link = connectDB();

    if (!isset($_SESSION['user']))
    {
        return false;
    }

    $userID = $_SESSION['user']['id'] ?? null;

    $query = "SELECT * FROM users WHERE id='$userID'";
    $result = mysqli_query($link, $query) or die(mysqli_error($link));
    return mysqli_fetch_assoc($result);
}

function logout()
{
    unset($_SESSION['user']['id']);
    redirect('/');
}

function checkAuth()
{
    if (!isset($_SESSION['user']['id']))
    {
        redirect('/');
    }
}

function checkGuest()
{
    if (isset($_SESSION['user']['id']))
    {
        redirect('/home.php');
    }
}