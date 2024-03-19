<?php
include "./vendor/components/header.php";
?>
<main class="form__content">
    <div class="wrapper">
        <section class="auth">
            <h2>Авторизация</h2>
            <hr>
            <form class="form__auth" action="./vendor/user/auth.php" method="post">

            
            <?php 
                    if(isset($_SESSION['error'])){
                        foreach($_SESSION['error'] as $key => $value){?>
                <p class="error"><img src="./assets/img/icons/error.svg" alt=""><?=$value?></p>
                <?php
                        }
                        unset($_SESSION['error']);
                    }
                ?>

                <?php 
                    if(isset($_SESSION['success'])){
                        foreach($_SESSION['success'] as $key => $value){?>
                <p class="success"><img src="./assets/img/icons/success.svg" alt=""><?=$value?></p>
                <?php
                        }
                        unset($_SESSION['success']);
                    }
                ?>

                
                <p>
                    <label for="login">Логин</label>
                    <input type="text" name="login" id="login" pattern="[A-Za-z0-9]{5,}" title="Логин должен содержать не менее 5 латинских символов!">
                </p>

                <p>
                    <label for="password">Пароль</label>
                    <input type="password" name="password" id="password" pattern="[A-Za-z0-9]{6,}" title="Пароль должен содержать не менее 6 латинских символов!">
                </p>
                
                <a class="forgot__password" href="./restore_password.php">Забыли пароль?</a>
                
                <p>
                    <button name="btn__login">Авторизоваться</button>
                </p>

            </form>

            <p class="form__warning">Нет аккаунта? → <a href="./registration.php">Зарегистрироваться</a></p>
        </section>
    </div>
</main>

<?php
include "./vendor/components/footer.php";
?>