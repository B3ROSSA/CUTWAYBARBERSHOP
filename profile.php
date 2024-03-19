<?php
include "./vendor/components/header.php";
if (!isset($_SESSION['user'])) {
    header("location: authorization.php");
}
$userInfoQuery = $link->query("SELECT * FROM `users` WHERE `id` = '{$_SESSION['user']['id']}'");
$userInfo = $userInfoQuery->fetch_assoc();

?>
<main class="profile__content">
    <div class="wrapper">
        <section class="profile__block">
            <h2>Личный кабинет</h2>
            <hr>
            <?php
            if ($userInfo['isAdmin'] == 1):
                ?>
                <p style="margin-top: 30px;">
                    <a class="admin__nav-link" href="./vendor/admin/index.php">Админ-панель</a>
                </p>
                <?php
            endif;
            ?>
            <div class="profile__info__block">
                <h3>
                    <div class="user__header">
                        <img src="./assets/img/icons/profile__icon.svg" alt="">
                        <?= $userInfo['name'] ?>
                        <?= $userInfo['surname'] ?>
                    </div>
                    <div class="logout"><a class="logout__btn" href="./vendor/user/logout.php">Выход</a></div>
                </h3>

                <div class="profile__info">
                    <div class="profile__info__headers">
                        <p>Логин:
                            <?= $userInfo['login'] ?><br>
                        <form class="profile__change" action="./vendor/user/changeLogin.php" method="post">
                            <input type="text" placeholder="Изменить логин" name="changeLogin" pattern="[A-Za-z0-9]{5,}"
                                title="Логин должен содержать не менее 5 латинских символов!">

                            <?php
                            if (isset($_SESSION['error']['changeLogin'])) {
                                ?>
                                <p class="error"><img src="./assets/img/icons/error.svg" alt="">
                                    <?= $_SESSION['error']['changeLogin'] ?>
                                </p>
                                <?php
                            }
                            ?>


                            <button name="changeLogin_Btn">Изменить</button>
                        </form>
                        </p>
                        <p>Email:
                            <?= $userInfo['email'] ?><br>
                        <form class="profile__change" action="./vendor/user/changeEmail.php" method="post">
                            <input type="email" placeholder="Изменить Email" name="changeEmail">

                            <?php
                            if (isset($_SESSION['error']['changeEmail'])) {
                                ?>
                                <p class="error"><img src="./assets/img/icons/error.svg" alt="">
                                    <?= $_SESSION['error']['changeEmail'] ?>
                                </p>
                                <?php
                            }
                            ?>

                            <button name="changeEmail_Btn">Изменить</button>
                        </form>
                        </p>
                        <p>Телефон:
                            <?= $userInfo['phone'] ?><br>
                        <form class="profile__change" action="./vendor/user/changePhone.php" method="post">
                            <input type="text" placeholder="Изменить номер" name="changePhone" id="phone">
                            <?php
                            if (isset($_SESSION['error']['changePhone'])) {
                                ?>
                                <p class="error"><img src="./assets/img/icons/error.svg" alt="">
                                    <?= $_SESSION['error']['changePhone'] ?>
                                </p>
                                <?php
                            }
                            ?>
                            <button name="changePhone_Btn">Изменить</button>
                        </form>
                        </p>
                        <p>Изменить пароль<br>
                        <form class="profile__change" action="./vendor/user/changePassword.php" method="post">
                            <input type="password" placeholder="Старый пароль" name="oldPass" pattern="[A-Za-z0-9]{6,}"
                                title="Пароль должен содержать не менее 6 латинских символов!">
                            <input type="text" placeholder="Новый пароль" name="newPass" style="margin-left: 5px;"
                                pattern="[A-Za-z0-9]{6,}"
                                title="Пароль должен содержать не менее 6 латинских символов!">
                            <button name="changePassword_Btn">Изменить</button>
                            <?php
                            if (isset($_SESSION['error']['changePass'])) {
                                ?>
                                <p class="error" style="margin-top: 20px;"><img src="./assets/img/icons/error.svg" alt="">
                                    <?= $_SESSION['error']['changePass'] ?>
                                </p>
                                <?php
                            }
                            ?>

                            <?php
                            if (isset($_SESSION['error']['changePassEmpty'])) {
                                ?>
                                <p class="error" style="margin-top: 20px;"><img src="./assets/img/icons/error.svg" alt="">
                                    <?= $_SESSION['error']['changePassEmpty'] ?>
                                </p>
                                <?php
                            }
                            ?>

                            <?php
                            if (isset($_SESSION['error']['changePassSame'])) {
                                ?>
                                <p class="error" style="margin-top: 20px;"><img src="./assets/img/icons/error.svg" alt="">
                                    <?= $_SESSION['error']['changePassSame'] ?>
                                </p>
                                <?php
                            }
                            ?>
                        </form>
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

<?php
include "./vendor/components/footer.php";
unset($_SESSION['error']);
unset($_SESSION['success']);
?>