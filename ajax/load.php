<?php
session_start();
include "../settings/db.php";
$connection = connect();
$query = mysqli_query($connection, "SELECT * FROM `users` WHERE `login` = '$_SESSION[user]'");
    if(($user = mysqli_fetch_assoc($query))){

    }
    $stage = preg_replace('/[^0-9]/', "", $_GET['stage']);
    for($i = 0; $i < 10; $i++){
        ?>
            <div class="b c_<?php
                if(($stage + $i) % 2 == 0){
                    echo 'green';
                }
                if(($stage + $i) % 2 == 1){
                    echo 'red';
                }
            ?>"><?php echo $stage + $i; ?><br><br><?php
                if($user['stage'] == $stage + $i){
                    echo "😃Вы здесь!";
                }
            ?></div>
        <?php
    }
?>


