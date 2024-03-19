<?php 
    include "../components/core.php";
    if(isset($_POST['btn__login'])){
        $password = md5($_POST['password']);
        $users = $link -> query("SELECT * FROM `users` WHERE `login` = '{$_POST['login']}' AND `password` = '$password'");
        if($users -> num_rows == 0){
            $_SESSION['error']['auth'] = "Неправильный логин или пароль!";
            header('location:'.$_SERVER['HTTP_REFERER']);
        }
        else{
            $user = $users->fetch_assoc();
            $_SESSION['user'] = [
                'id' => $user['id'],
                'login' => $user['login'],
                'surname' => $user['surname'],
                'name' => $user['name'],
                'patronymic' => $user['patronymic'],
                'email' => $user['email'],
                'phone' => $user['phone'],
                'isAdmin' => $user['isAdmin'],
            ];
            $_SESSION['success']['auth'] = "Вы успешно зарегистрировались!";
            header('location: ../../profile.php');
        }
    }
?>