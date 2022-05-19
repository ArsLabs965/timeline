<?php
session_start();
include "../settings/db.php";
$connection = connect();
$query = mysqli_query($connection, "SELECT * FROM `users` WHERE `login` = '$_SESSION[user]'");
    if(($user = mysqli_fetch_assoc($query))){
        $rnd = rand(1, 6);
        echo "<h1>" . $rnd . "</h1>";
        $rnd += $user['stage'];
        mysqli_query($connection, "UPDATE `users` SET `stage` = '$rnd' WHERE `login` = '$_SESSION[user]'");
    }
 
?>


