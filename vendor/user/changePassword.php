<?php
    include '../components/core.php';
    if(isset($_POST['changePassword_Btn'])){
        if(empty($_POST['oldPass']) || empty($_POST['newPass'])){
            $_SESSION['error']['changePassEmpty'] = "Заполните пустые поля!";
            header("Location:".$_SERVER['HTTP_REFERER']);
        }else{
            $oldPass = md5($_POST['oldPass']);
            $newPass = md5($_POST['newPass']);
            if($oldPass == $newPass){
                $_SESSION['error']['changePassSame'] = "Пароли совпадают!";
                header("Location:".$_SERVER['HTTP_REFERER']);
            }else{
                $changePassQuery = $link -> query("SELECT * FROM `users` WHERE `id` = '{$_SESSION['user']['id']}' AND `password` = '$oldPass'");
                if($changePassQuery -> num_rows == 1){
                    $link -> query("UPDATE `users` SET `password`='$newPass' WHERE `id` = '{$_SESSION['user']['id']}'");
                    $_SESSION['success']['changePass'] = "Пароль изменён. Авторизуйтесь!";
                    unset($_SESSION['user']);
                    header("location: ../../authorization.php");
                }
                else{
                $_SESSION['error']['changePass'] = "Неправильный старый пароль!";
                header("Location:".$_SERVER['HTTP_REFERER']);
            }
        }
    }
}
?>