<?php
include "settings/db.php";
$connection = connect();
    if(isset($_POST['reg'])){
        $login = mysqli_real_escape_string($connection, $_POST['login']);
        $password = mysqli_real_escape_string($connection, $_POST['password']);
        $query = mysqli_query($connection, "SELECT * FROM `users` WHERE `login` = '$login'");
        if(!($ac = mysqli_fetch_assoc($query))){
            mysqli_query($connection, "INSERT INTO `users` (`login`, `password`) VALUES ('$login', '$password')");
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
        <div class="form">
            <h3>Регистрация</h3>
            <form action="" method="POST">
                <br>
                <input type="text" value="<?php echo $_POST['login']; ?>" name="login"><br><br>
                <input type="password" name="password"><br><br>
                <input class="btn" name="reg" type="submit" value="Регистрация">
            </form>
        </div>
   </div>
</body>
</html>