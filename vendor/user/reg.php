<?php 
    include "../components/core.php";
    if(isset($_POST['btn__reg'])){
        if(!empty($_POST['login']) && $_POST['surname'] && $_POST['name'] && $_POST['email'] && $_POST['phone'] && $_POST['password']){
            $users = $link -> query("SELECT * FROM `users` WHERE `login` = '{$_POST['login']}' OR `email` = '{$_POST['email']}'");
            if($users -> num_rows > 0){
                $_SESSION['error']['reg'] = "Пользователь с таким логином или эл.почтой уже существует!";
                header('location:'.$_SERVER['HTTP_REFERER']);
            }
            else{
                $password = md5($_POST['password']);
                $link -> query("INSERT INTO `users` (`login`, `surname`, `name`, `email`, `phone`, `password`) 
                VALUES ('{$_POST['login']}', '{$_POST['surname']}', '{$_POST['name']}', '{$_POST['email']}', '{$_POST['phone']}', '$password')");
                $_SESSION['success']['reg'] = "Вы успешно зарегистрировались!";
                header('location: ../../authorization.php');
            }
        }
        else{
            $_SESSION['error']['emptyInputs'] = "Заполните все поля!";
            header('Location:'.$_SERVER['HTTP_REFERER']);
        }
    }
?>