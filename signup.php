<?php
$data = $_POST;
if ( isset($data) && isset($_POST['button'])) {

    $errors = array();

    if ( trim( $data['name'] ) == '' ) {
        $errors[] = 'Введите имя';
    } if ( trim( $data['age'] ) == '') {
        $errors[] = 'Введите возраст';
    } if ( trim( $data['password'] ) == '' ) {
        $errors[] = 'Введите пароль';
    } if ( empty($errors) ) {

        $userName = $data['name'];
        $userAge = $data['age'];

        $userPassword = md5($data['password']);

        require_once 'conf.php';
        $connect = mysqli_connect($localhost, $name, $password, $db);

        $query = "SELECT * FROM users WHERE name= '$userName '";

        $result = mysqli_query($connect, $query);

        if (mysqli_num_rows($result) == 0) {
            $query ="INSERT INTO `users`(`name`, `age`, `password`)
                 VALUES ('$userName', '$userAge', '$userPassword')";

            require_once 'connectDB.php';
            mysqli_close($connect);
            header('Location: /index.php');
        }else {

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
        <?php if ( isset($errors) ) {?>
            <span style="color: red">
                <?= array_shift($errors) ?>
            </span>
        <?php }?>

        <form action="/signup.php" method="post">
            Ваше имя: <input type="text" name="name" value='<?= @$data['name']; ?>'> <br><br>
            Ваше возрвст: <input type="number" name="age" value='<?= @$data['age']; ?>'> <br><br>
            Ваш пароль: <input type="text" name="password" value='<?= @$data['password']; ?>'> <br><br>
            <input type="submit" name="button" value="Зарегистрироваться">
        </form>
    </div>
</div>

</body>
</html>


