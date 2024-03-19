<?php
include "./admin_header.php";
if (!isset($_SESSION['user'])) {
    header('location: ../../index.php');
} elseif ($_SESSION['user']['isAdmin'] != 1) {
    header('location: ../../index.php');
}

if (isset($_POST['deleteService'])) {
    $deleteService = $link->query("DELETE FROM `pricelist` WHERE `id` = '{$_POST['service_id']}'");
}

if (isset($_POST['addService'])) {
    if (!empty($_POST['service_name']) && !empty($_POST['service_cost'])) {
        $link->query("INSERT INTO `pricelist` (`service_name`, `service_cost`) VALUES ('{$_POST['service_name']}', '{$_POST['service_cost']}')");
    } else {
        $_SESSION['error']['addService'] = "Заполните все поля!";
    }
}

$adminPricelist = $link->query("SELECT * FROM `pricelist`");
?>
<main class="profile__content">
    <div class="wrapper">
        <section class="profile__block admin__block">
            <h2>Прайс-лист</h2>
            <hr>
            <div class="admin__form">
                <h3>Добавление услуги в прайс-лист</h3>
                <form class="admin__add__form" action="#" method="post">
                    <input type="text" placeholder="Наименование услуги" name="service_name">
                    <input type="text" placeholder="Цена услуги в рублях" name="service_cost"
                        title="Указывается в цифрах">
                    <button class="adminBtn" name="addService">Добавить</button>
                    <?php
                    if (isset($_SESSION['error'])) {
                        foreach ($_SESSION['error'] as $key => $value) { ?>
                            <p class="error"><img src="../../assets/img/icons/error.svg" alt="error">
                                <?= $value ?>
                            </p>
                            <?php
                        }
                    }
                    ?>

                    <?php
                    if (isset($_SESSION['success'])) {
                        foreach ($_SESSION['success'] as $key => $value) { ?>
                            <p class="success"><img src="../../assets/img/icons/success.svg" alt="">
                                <?= $value ?>
                            </p>
                            <?php
                        }
                        unset($_SESSION['success']);
                    }
                    ?>
                </form>
            </div>
            <div class="profile__info__block admin__nav">
                <div class="mobile-table">
                    <table class="admin__table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Наименование услуги</th>
                                <th>Цена услуги</th>
                                <th>Изменить/Удалить</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($adminPricelist as $key => $value):
                                ?>
                                <tr>
                                    <td>
                                        <?= $value['id'] ?>
                                    </td>
                                    <td>
                                        <?= $value['service_name'] ?>
                                    </td>
                                    <td>
                                        <?= $value['service_cost'] ?> р.
                                    </td>
                                    <td>
                                        <div class="table_btns">
                                            <form action="./change_pricelist.php" method="get">
                                                <input type="hidden" name="service_id" value="<?= $value['id'] ?>">
                                                <button class="adminBtn" name="changeService">Изменить</button>
                                            </form>
                                            <form action="#" method="post">
                                                <input type="hidden" name="service_id" value="<?= $value['id'] ?>">
                                                <button class="adminBtn" name="deleteService">Удалить</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="logout admin_logout">
                <a class="logout__btn" href="./index.php">В меню</a>
                <a class="logout__btn" href="../../profile.php">Выход</a>
            </div>
        </section>
    </div>
</main>

<?php
include "./admin_footer.php";
unset($_SESSION['error']);
?>