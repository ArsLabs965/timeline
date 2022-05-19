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

$query = mysqli_query($connection, "SELECT * FROM `users` WHERE `login` = '$_SESSION[user]'");
    if(($user = mysqli_fetch_assoc($query))){

    }

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Exo+2:ital,wght@1,300&family=IBM+Plex+Serif&family=PT+Sans:ital@1&family=Rowdies&family=Rubik&family=Source+Sans+Pro:wght@300&family=Ubuntu+Condensed&family=Ubuntu:wght@500&display=swap" rel="stylesheet">
    <title>Timeline</title>
</head>
<body>
    <div onclick="go_next()" class="btn_go">
        <img src="img/bo.gif" width="100px" alt="">
    </div>
    <div class="header">
    <div class="left">
        <?php
            if($user['admin']){
        ?>
        <a href="admin.php">Админ панель</a>
        <?php
            }
        ?>
    </div>
    <div class="right">
        <a href="out.php">Выйти(<?php echo $_SESSION['user']; ?>)</a>
    </div>
    </div>
    <div class="center">
        <br> <br> <br>
    <div id="map"></div>
    </div>
    <script src="js/jquery.js"></script>
    <script>
        var stage = <?php echo $user['stage']; ?>;
    </script>
    <script src="js/load.js"></script>
    <script>
        var can = 1;
        function go_next(){
            if(can){
                can = 0;
            $('.btn_go').html("<h1>Бросаем...</h1>");
            $.ajax({
        method: "GET",
        url: "ajax/rnd.php",
        dataType: "text",
        data: {},
        success: function(data){  
          
            $('.btn_go').html(data);
            setTimeout(goto_r, 1000);
      }
  }); 
}
        }

        function goto_r(){
            document.location.reload();
        }   
    </script>
</body>
</html>