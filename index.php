<?php
session_start();

//Проверка, зареганы мы или нет
include "settings/rootway.php";
if($_SESSION['user'] != NULL){
    header(rootway() . 'map.php');
    exit();
}

//Подключение к Базе данных
include "settings/db.php";
$connection = connect();

$err = 0; //Сбор ошибок при анализе формы

//Если нажата кнопка регистрации, очищаем и записываем в базу данных
    if(isset($_POST['reg'])){

        //Зачистка от инбекций
        $login = mysqli_real_escape_string($connection, $_POST['login']);
        $password = mysqli_real_escape_string($connection, $_POST['password']);

        if($login != "" AND $password != ""){
            $login_old = $login;
           $login = preg_replace('/[^0-9a-zA-Z]/', "", $login);
            if($login_old == $login){
                $query = mysqli_query($connection, "SELECT * FROM `users` WHERE `login` = '$login'");
                if(!($query_clear = mysqli_fetch_assoc($query))){
                    $password = password_hash($password, PASSWORD_BCRYPT); //Хеширование пароля
                    mysqli_query($connection, "INSERT INTO `users` (`login`, `password`) VALUES ('$login', '$password')");

                    //Вход в созданный аккаунт
                    $_SESSION['user'] = $login;
                    header(rootway() . 'map.php');
                    exit();
                }else{
                    $err = 3; //Логин уже занят
                }
            }else{
                $err = 2; //Присутствуют недопустимые символы
            }
        }else{
            $err = 1; //Есть незаполненные поля
        }
    }



    // Если нажата кновка входа, чекаем форму и входим
    if(isset($_POST['in'])){

        //Зачистка от инбекций
        $login = mysqli_real_escape_string($connection, $_POST['login']);
        $password = mysqli_real_escape_string($connection, $_POST['password']);

        if($login != "" AND $password != ""){
            $query = mysqli_query($connection, "SELECT * FROM `users` WHERE `login` = '$login'");
            if(($query_clear = mysqli_fetch_assoc($query))){
                if(password_verify($password, $query_clear['password'])){
                  //Вход в аккаунт
                $_SESSION['user'] = $login;
                header(rootway() . 'map.php');
                exit();
                }else{
                    $err = 4; //Неверен логин или пароль
                }
                
            }else{
                $err = 4; //Неверен логин или пароль
            }
        }else{
            $err = 1; //Есть незаполненные поля
        }
    }
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
        <h1>Timeline</h1>
        <br>
        <?php
        // Вывод ошибки при заполнении формы
            if($err == 1){
                echo '<p class="red">Запоните все поля!</p>';
            }
            if($err == 2){
                echo '<p class="red">Недопустимые символы!</p>';
            }
            if($err == 3){
                echo '<p class="red">Логин занят!</p>';
            }
            if($err == 4){
                echo '<p class="red">Неверен логин или пароль!</p>';
            }
        ?>
        <br>

        <!-- Форма регистрации -->
        <div class="form">
            <h3>Регистрация</h3>
            <form action="" method="POST">
                <br>
                <input placeholder="Логин" type="text" value="<?php echo $login; ?>" name="login"><br><br>
                <input placeholder="Пароль" type="password" name="password"><br><br>
                <input class="btn" name="reg" type="submit" value="Регистрация">
            </form>
        </div>
        <!-- Форма входа -->
        <div class="form">
            <h3>Вход</h3>
            <form action="" method="POST">
                <br>
                <input placeholder="Логин" type="text" value="<?php echo $login; ?>" name="login"><br><br>
                <input placeholder="Пароль" type="password" name="password"><br><br>
                <input class="btn" name="in" type="submit" value="Войти">
            </form>
        </div>
   </div>
</body>
</html>