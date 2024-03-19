<?php
include "./admin_header.php";
if (!isset($_SESSION['user'])) {
    header('location: ../../index.php');
} elseif ($_SESSION['user']['isAdmin'] != 1) {
    header('location: ../../index.php');
}
$barberId = $_GET['barber_id'];
$changeBarberQuery = $link->query("SELECT * FROM `barbers` WHERE `id` = '$barberId'");
$changeBarber = mysqli_fetch_assoc($changeBarberQuery);

if (isset($_POST['changeBarber'])) {
    if ($_FILES['barber_img']['name'] != "" && !empty($_POST['barber_name']) && !empty($_POST['barber_description'])) {
        $deleteOldImgQuery = $link->query("SELECT `img_barber` FROM `barbers` WHERE `id` = '$barberId'");
        $deleteOldImg = mysqli_fetch_assoc($deleteOldImgQuery);
        $deleteOldImgLink = "../../assets/img/barbers/{$deleteOldImg['img_barber']}";
        unlink($deleteOldImgLink);
        $barberNewImg = $_FILES['barber_img'];
        if ("image" == substr($barberNewImg['type'], 0, 5)) {
            $nameImg = uniqid() . "." . substr($barberNewImg['type'], 6);
            move_uploaded_file($barberNewImg['tmp_name'], "../../assets/img/barbers/" . $nameImg);
            $link->query("UPDATE `barbers` SET `img_barber` = '{$nameImg}', `name` = '{$_POST['barber_name']}', `description` = '{$_POST['barber_description']}' WHERE `id` = '$barberId'");
            $_SESSION['success']['changeBarber'] = 'Вы успешно изменили барбера!';
            header('location: ./admin_barbers.php');
        }
    } elseif ($_FILES['barber_img']['name'] == "" && !empty($_POST['barber_name']) && !empty($_POST['barber_description'])) {
        $link->query("UPDATE `barbers` SET `name` = '{$_POST['barber_name']}', `description` = '{$_POST['barber_description']}' WHERE `id` = '$barberId'");
        $_SESSION['success']['changeBarber'] = 'Вы успешно изменили барбера!';
        header('location: ./admin_barbers.php');
    } else {
        $_SESSION['error']['input'] = "Заполните все поля!";
    }
}
?>
<main class="profile__content">
    <div class="wrapper">
        <section class="profile__block admin__block">
            <h2>Изменение барбера</h2>
            <hr>
            <div class="admin__form">
                <form class="admin__add__form changePage" action="#" method="post" enctype="multipart/form-data">
                    <p>
                        <label for="barber_name">Имя барбера</label>
                        <input type="text" placeholder="Имя барбера" name="barber_name"
                            value="<?= $changeBarber['name'] ?>" id="barber_name">
                    </p>
                    <p>
                        <label for="barber_description">Описание барбера</label>
                        <textarea style="padding: 10px; min-height: 150px" name="barber_description"
                            id="barber_description"><?= $changeBarber['description'] ?></textarea>
                    </p>
                    <p>
                        <label for="">Старое изображение</label>
                        <img style="max-width: 200px;" src="../../assets/img/barbers/<?= $changeBarber['img_barber'] ?>"
                            alt="">
                    </p>
                    <p>
                        <label for="barber_img">Выбрать новое изображение</label>
                        <input type="file" id="barber_img" name="barber_img" accept="image/jpeg, image/png" />
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
                    <p class="changePageBtn"><button class="adminBtn" name="changeBarber">Применить изменения</button>
                    </p>
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