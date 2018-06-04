<?php
require_once 'conf.php';
$connect = mysqli_connect($localhost, $name, $password, $db);

if (!isset($_COOKIE['name'], $_COOKIE['password'])) {
    if (isset($_POST['name'], $_POST['password'])) {

        $userName = $_POST['name'];
        $userPassword = md5($_POST['password']);

        $query = "SELECT * FROM users 
                  WHERE name= '$userName' and password= '$userPassword' ";

        $result = mysqli_query($connect, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            setcookie('name', $row['name']);
            setcookie('age', $row['age']);
            setcookie('password', $row['password']);
            header('Location: /index.php');
        } else {

            if (isset($_POST['button'])) {
                echo '<div style="color: red; text-align: center">Пользователя с таким именем и паролем нет</div><br>';
            }
        }
    }
}

?>

<html>
<head>

</head>

<body>

<div class="box" style="display: flex; justify-content: center">
    <div>
        <?php
            if (isset($_COOKIE['name'])) { ?>
                <a href="/logout.php">Выйти</a>
            <?php } else { ?>

        <form action="/index.php" method="post">
            Ваше имя: <input type="text" name="name"> <br><br>
            Ваш пароль: <input type="text" name="password"> <br><br>
            <input type="submit" name="button" value="Войти">
            <a href="/signup.php">Зарегистрироваться</a>
        </form>

        <?php } ?>

        <div class="data-base" style="border: 1px solid black; padding: 10px">

            <?php

            $choice = isset($_COOKIE['name']) ? '/modify.php' : '/signup.php';

            $query ='SELECT * FROM users';
            require_once 'connectDB.php';

            while ($row = mysqli_fetch_assoc($result)) {
                echo  '<a href=" ' . $choice .' ">' .
                    $row['id'] . ' ' .
                    $row['name'] . ' ' .
                    $row['age'] . ' ' .
                    '</a><br>';
            }
            mysqli_close($connect);
            ?>

        </div>
    </div>
</div>


</body>
</html>