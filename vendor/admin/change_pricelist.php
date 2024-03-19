<?php
include "./admin_header.php";
if (!isset($_SESSION['user'])) {
    header('location: ../../index.php');
} elseif ($_SESSION['user']['isAdmin'] != 1) {
    header('location: ../../index.php');
}
$serviceId = $_GET['service_id'];
$changeServiceQuery = $link->query("SELECT * FROM `pricelist` WHERE `id` = '$serviceId'");
$changeService = mysqli_fetch_assoc($changeServiceQuery);

if (isset($_POST['addService'])) {
    if (!empty($_POST['service_name']) && !empty($_POST['service_cost'])) {
        $link->query("UPDATE `pricelist` SET `service_name`='{$_POST['service_name']}', `service_cost`='{$_POST['service_cost']}' WHERE `id` = '$serviceId'");
        $_SESSION['success']['serviceChange'] = "Вы успешно изменили услугу!";
        header('location: ./admin_pricelist.php');
    } else {
        $_SESSION['error']['input'] = "Заполните все поля!";
    }
}
?>
<main class="profile__content">
    <div class="wrapper">
        <section class="profile__block admin__block">
            <h2>Изменение услуги</h2>
            <hr>
            <div class="admin__form">
                <form class="admin__add__form changePage" action="#" method="post">
                    <p>
                        <label for="service_name">Наименование услуги</label>
                        <input type="text" placeholder="Наименование услуги" name="service_name"
                            value="<?= $changeService['service_name'] ?>" id="service_name">
                    </p>
                    <p>
                        <label for="service_name">Цена услуги в рублях</label>
                        <input type="text" placeholder="Цена услуги в рублях" name="service_cost"
                            title="Указывается в цифрах" value="<?= $changeService['service_cost'] ?>"
                            id="service_cost">
                    </p>
                    <?php
                    if (isset($_SESSION['error'])) {
                        foreach ($_SESSION['error'] as $key => $value) { ?>
                            <p class="error"><img src="../../assets/img/icons/error.svg" alt="error">
                                <?= $value ?>
                            </p>
                            <?php
                        }
                        unset($_SESSION['error']);
                    }
                    ?>
                    <p class="changePageBtn"><button class="adminBtn" name="addService">Применить изменения</button></p>
                </form>
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