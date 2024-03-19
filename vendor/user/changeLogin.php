<?php
    include '../components/core.php';
    if(isset($_POST['changeLogin_Btn'])){
        if(!empty($_POST['changeLogin'])){
            $changeLogin = $link -> query("UPDATE `users` SET `login`='{$_POST['changeLogin']}' 
            WHERE `id` = '{$_SESSION['user']['id']}'");
            $_SESSION['success']['changeLogin'] = "Логин изменён. Авторизуйтесь!";
            unset($_SESSION['user']);
            header("location: ../../authorization.php");
        }
        else{
            $_SESSION['error']['changeLogin'] = "Заполните поле!";
            header("Location:".$_SERVER['HTTP_REFERER']);
        }
    }
?>