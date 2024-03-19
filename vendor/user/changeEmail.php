<?php
    include '../components/core.php';
    if(isset($_POST['changeEmail_Btn'])){
        if(!empty($_POST['changeEmail'])){
            $changeEmail = $link -> query("UPDATE `users` SET `email`='{$_POST['changeEmail']}' 
            WHERE `id` = '{$_SESSION['user']['id']}'");
        }
        else{
            $_SESSION['error']['changeEmail'] = "Заполните поле!";
        }
    }
    header("Location:".$_SERVER['HTTP_REFERER']);
?>