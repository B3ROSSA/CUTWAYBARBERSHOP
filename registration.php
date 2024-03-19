<?php
include "./vendor/components/header.php";
?>
<main class="form__content">
    <div class="wrapper">
        <section class="auth">
            <h2>Регистрация</h2>
            <hr>
            <form class="form__auth" action="./vendor/user/reg.php" method="post">

                <?php 
                    if(isset($_SESSION['error'])){
                        foreach($_SESSION['error'] as $key => $value){?>
                <p class="error"><img src="./assets/img/icons/error.svg" alt=""><?=$value?></p>
                <?php
                        }
                    }
                ?>

                <p>
                    <label for="login">Логин</label>
                    <input type="text" name="login" id="login" pattern="[A-Za-z0-9]{5,}" title="Логин должен содержать не менее 5 латинских символов!">
                </p>


                <p>
                    <label for="name">Имя</label>
                    <input type="text" name="name" id="name" pattern="[а-яА-Я\s\-]+">
                </p>
                
                <p>
                    <label for="surname">Фамилия</label>
                    <input type="text" name="surname" id="surname" pattern="[а-яА-Я\s\-]+">
                </p>

                <p>
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email">
                </p>

                <p>
                    <label for="phone">Телефон</label>
                    <input type="text" name="phone" id="phone">
                </p>

                <p>
                    <label for="login">Пароль</label>
                    <input type="password" name="password" id="password" pattern="[A-Za-z0-9]{6,}" title="Пароль должен содержать не менее 6 латинских символов!">
                </p>

                <p>
                    <button name="btn__reg">Зарегистрироваться</button>
                </p>

            </form>

            <p class="form__warning">Уже зарегистрированы? → <a href="./authorization.php">Войти</a></p>
        </section>
    </div>
</main>

<?php
include "./vendor/components/footer.php";
unset($_SESSION['error']);
?>