<?php

require_once 'conf.php';

$connect = mysqli_connect($localhost, $name, $password, $db);

if (!$connect) {
    die('Ошибка соединения: ' . mysqli_error());
}

$result = mysqli_query($connect, $query);
