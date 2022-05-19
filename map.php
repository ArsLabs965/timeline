<?php
session_start();

//Проверка, зареганы мы или нет
include "settings/rootway.php";
if($_SESSION['user'] == NULL){
    header(rootway());
    exit();
}

//Подключение к Базе данных
include "settings/db.php";
$connection = connect();


?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <title>Timeline</title>
</head>
<body>
   <div class="center">
        <h1><?php echo $_SESSION['user']; ?></h1>
        <a href="out.php">Выйти</a>
        <br>
        <br>

        
   </div>
</body>
</html>