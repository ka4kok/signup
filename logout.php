<?php

setcookie('name', $row['name'], -100);
setcookie('password' , $row['password'], -100);
header('Location: /index.php' );

