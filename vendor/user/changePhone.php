<?php
    include '../components/core.php';
    if(isset($_POST['changePhone_Btn'])){
        if(!empty($_POST['changePhone'])){
            $changePhone = $link -> query("UPDATE `users` SET `phone`='{$_POST['changePhone']}' 
            WHERE `id` = '{$_SESSION['user']['id']}'");
        }
        else{
            $_SESSION['error']['changePhone'] = "Заполните поле!";
        }
    }
    header("Location:".$_SERVER['HTTP_REFERER']);
?>