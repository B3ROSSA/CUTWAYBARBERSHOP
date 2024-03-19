<?php
include "./vendor/components/header.php";
if (isset($_SESSION['user'])) {
    header('location:' . $_SERVER['HTTP_REFERER']);
} else {
    if (isset($_POST['btn__restore'])) {
        if (!empty($_POST['email'])) {
            $checkUser = $link->query("SELECT * FROM `users` WHERE `email` = '{$_POST['email']}'");
            if ($checkUser->num_rows != 0) {
                $userInfo = $checkUser->fetch_assoc();
                $_SESSION['restore_code'] = rand(1000, 9999);
                $_SESSION['restore_email'] = $_POST['email'];
                $_SESSION['oldPass'] = $userInfo['password'];

                //Отправка почты
                require_once('./vendor/components/Exception.php');
                require_once('./vendor/components/PHPMailer.php');
                require_once('./vendor/components/SMTP.php');
                $mail = new PHPMailer\PHPMailer\PHPMailer();
                $mail->isSMTP();
                $mail->Host = 'ssl://smtp.mail.ru';
                $mail->SMTPAuth = true;
                $mail->Username = 'cutway@list.ru';
                $mail->Password = 'ictcZmidHxmngnFMPrRt';
                $mail->SMTPSecure = 'ssl';
                $mail->Port = '465';
                $mail->SMTPOptions = ['ssl' => ['verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true,]];
                $mail->From = 'cutway@list.ru';
                $mail->FromName = 'CutWay - Барбершоп';
                $mail->Subject = 'Восстановление пароля от личного кабинета CutWay';
                $mail->Body = $_SESSION['restore_code'] . ' - Ваш код для восстановления пароля';
                $mail->CharSet = 'UTF-8';
                $mail->isHTML(false);
                $mail->AddAddress("{$_POST['email']}");
                $mail->SMTPDebug = 0;
                if ($mail->send()) {
                    header("location:" . $_SERVER['HTTP_REFERER']);
                }
            } else {
                $_SESSION['error']['restore_email'] = "Пользователь с такой почтой не найден!";
                header('location:' . $_SERVER['HTTP_REFERER']);
            }
        } else {
            $_SESSION['error']['emptyInputs'] = "Заполните поле!";
            header('location:' . $_SERVER['HTTP_REFERER']);
        }
    }

    if (isset($_POST['btn__restore__code'])) {
        if (!empty($_POST['restore_code'])) {
            if ($_POST['restore_code'] == $_SESSION['restore_code']) {
                $_SESSION['restore_code_true'] = true;
                header('location:' . $_SERVER['HTTP_REFERER']);
            } else {
                $_SESSION['error']['wrong_code'] = "Неверный код!";
                header('location:' . $_SERVER['HTTP_REFERER']);
            }
        } else {
            $_SESSION['error']['emptyInputs'] = "Заполните поле!";
            header('location:' . $_SERVER['HTTP_REFERER']);
        }
    }

    if (isset($_POST['btn__restore__pass'])) {
        if (!empty($_POST['pass1']) && !empty($_POST['pass2'])) {
            if ($_POST['pass1'] == $_POST['pass2']) {
                $newPass = md5($_POST['pass2']);
                if ($_SESSION['oldPass'] != $newPass) {
                    $rewriteOldPass = $link->query("UPDATE `users` SET `password` = '$newPass' WHERE `email` = '{$_SESSION['restore_email']}'");
                    unset($_SESSION['restore_email']);
                    unset($_SESSION['restore_code']);
                    unset($_SESSION['restore_code_true']);
                    unset($_SESSION['oldPass']);
                    $_SESSION['success']['restorePassword'] = "Пароль восстановлен. Авторизуйтесь!";
                    header("location: ./authorization.php");
                } else {
                    $_SESSION['error']['noSamePass'] = "Новый пароль совпадает со старым!";
                    header('location:' . $_SESSION['HTTP_REFERER']);
                }
            } else {
                $_SESSION['error']['noSamePass'] = "Введённые пароли не совпадают!";
                header('location:' . $_SESSION['HTTP_REFERER']);
            }
        } else {
            $_SESSION['error']['emptyInputs'] = "Заполните поле!";
            header('location:' . $_SESSION['HTTP_REFERER']);
        }
    }
}
?>
<main class="form__content">
    <div class="wrapper">
        <section class="auth">
            <h2 style="font-size: 26px;">Восстановление пароля</h2>
            <hr>
            <form class="form__auth" action="#" method="post">

                <?php
                if (isset($_SESSION['error'])) {
                    foreach ($_SESSION['error'] as $key => $value) { ?>
                        <p class="error"><img src="./assets/img/icons/error.svg" alt="">
                            <?= $value ?>
                        </p>
                        <?php
                    }
                }
                ?>

                <?php
                if (isset($_SESSION['success'])) {
                    foreach ($_SESSION['success'] as $key => $value) { ?>
                        <p class="success"><img src="./assets/img/icons/success.svg" alt="">
                            <?= $value ?>
                        </p>
                        <?php
                    }
                }
                ?>

                <?php
                if (!isset($_SESSION['restore_code'])) {
                    ?>

                    <p>
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email">
                    </p>

                    <p>
                        <button name="btn__restore">Отправить код на почту</button>
                    </p>

                    <?php
                } elseif (!isset($_SESSION['restore_code_true'])) {
                    ?>
                    <p>
                        <label for="restore_code">Введите код, отправленный на почту
                            <?= $_SESSION['restore_email'] ?>
                        </label>
                        <input type="text" name="restore_code" id="restore_code" max="4">
                    </p>

                    <p>
                        <button name="btn__restore__code">Подтвердить</button>
                    </p>
                    <?php
                }
                ?>


                <?php
                if (isset($_SESSION['restore_code_true'])) {
                    ?>
                    <p>
                        <label for="pass1">Новый пароль</label>
                        <input type="password" name="pass1" id="pass1">
                    </p>

                    <p>
                        <label for="pass2">Повторите пароль</label>
                        <input type="password" name="pass2" id="pass2">
                    </p>

                    <p>
                        <button name="btn__restore__pass">Изменить пароль</button>
                    </p>

                    <?php
                }
                ?>
            </form>

            <p class="form__warning">Вспомнили пароль? → <a href="./authorization.php">Вернуться назад</a></p>
        </section>
    </div>
</main>

<?php
unset($_SESSION['error']);
include "./vendor/components/footer.php";
?>