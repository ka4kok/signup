<?php
$data = $_POST;
if ( isset($data) && isset($_POST['button'])) {

    $userName = $data['name'];
    $userAge = $data['age'];
    $userPassword = $data['password'];
    $varName = $_COOKIE['name'];
    $varAge = $_COOKIE['age'];
    $varPassword = $_COOKIE['password'];

    require_once 'conf.php';
    $connect = mysqli_connect($localhost, $name, $password, $db);
    $query = "UPDATE `users` 
              SET name='$userName', age='$userAge'
              WHERE name='$varName'
              ";

    $result = mysqli_query($connect, $query);

    if ($result) {
        echo 'Изменения прошли успешно';
    } else {
        echo 'Ошибка изменений';
    }

    mysqli_close($connect);


}

?>


<html>
<head>

</head>

<body>

<div class="box" style="display: flex; justify-content: center">
    <div>

        <form action="/modify.php" method="post">
            Ваше имя: <input type="text" name="name" value='<?= $_COOKIE['name']; ?>'> <br><br>
            Ваше возрвст: <input type="number" name="age" value='<?= $_COOKIE['age']; ?>'> <br><br>
            Ваш пароль: <input type="text" name="password" value='<?= $_COOKIE['password']; ?>'> <br><br>
            <input type="submit" name="button" value="Изменить значение">
            <a href="/logout.php">Выйти</a>
        </form>

    </div>
</div>


</body>
