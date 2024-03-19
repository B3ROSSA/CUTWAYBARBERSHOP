<?php
include "./admin_header.php";
if (!isset($_SESSION['user'])) {
    header('location: ../../index.php');
} elseif ($_SESSION['user']['isAdmin'] != 1) {
    header('location: ../../index.php');
}

if (isset($_POST['addBarber'])) {
    if (!empty($_POST['barber_name']) && !empty($_POST['barber_description']) && !empty($_FILES['barber_img'])) {
        $barberImg = $_FILES['barber_img'];
        if ("image" == substr($barberImg['type'], 0, 5)) {
            $nameImg = uniqid() . "." . substr($barberImg['type'], 6);
            move_uploaded_file($barberImg['tmp_name'], "../../assets/img/barbers/" . $nameImg);
            mysqli_query($link, "INSERT INTO `barbers` (`img_barber`, `name`, `description`) VALUES ('$nameImg', '{$_POST['barber_name']}', '{$_POST['barber_description']}')");
            $_SESSION['success']['addBarber'] = 'Вы успешно добавили барбера!';
        }
    } else {
        $_SESSION['error']['inputs'] = "Заполните все поля!";
    }
}

if (isset($_POST['deleteBarber'])) {
    $barberQuery = $link->query("SELECT * FROM `barbers` WHERE `id` = '{$_POST['barber_id']}'");
    $barberResult = mysqli_fetch_assoc($barberQuery);
    $deleteLink = "../../assets/img/barbers/{$barberResult['img_barber']}";
    unlink($deleteLink);
    $link->query("DELETE FROM `barbers` WHERE `id` = '{$_POST['barber_id']}'");
    $_SESSION['success']['deleteBarber'] = 'Вы успешно удалили барбера!';
}
$adminBarbers = $link->query("SELECT * FROM `barbers`");
?>
<main class="profile__content">
    <div class="wrapper">
        <section class="profile__block admin__block">
            <h2>Барберы</h2>
            <hr>
            <div class="admin__form">
                <h3>Добавление барбера</h3>
                <form class="admin__add__form" action="#" method="post" enctype="multipart/form-data">
                    <input type="file" id="barber_img" name="barber_img" accept="image/jpeg, image/png" />
                    <input type="text" placeholder="Имя барбера" name="barber_name">
                    <textarea name="barber_description" id="barber_description"
                        style="width: 100%; height:150px; padding: 10px;" placeholder="Описание барбера"></textarea>
                    <button class="adminBtn" name="addBarber">Добавить</button>
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
                                <th>Имя барбера</th>
                                <th>Описание барбера</th>
                                <th>Изображение</th>
                                <th>Изменить/Удалить</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($adminBarbers as $key => $value):
                                ?>
                                <tr>
                                    <td>
                                        <?= $value['id'] ?>
                                    </td>
                                    <td>
                                        <?= $value['name'] ?>
                                    </td>
                                    <td style="max-width: 700px;">
                                        <?= $value['description'] ?>
                                    </td>
                                    <td>
                                        <img style="max-width: 150px;"
                                            src="../../assets/img/barbers/<?= $value['img_barber'] ?>" alt="barber">
                                    </td>
                                    <td>
                                        <div class="table_btns">
                                            <form action="./change_barber.php" method="get">
                                                <input type="hidden" name="barber_id" value="<?= $value['id'] ?>">
                                                <button class="adminBtn" name="changebarber">Изменить</button>
                                            </form>
                                            <form action="#" method="post">
                                                <input type="hidden" name="barber_id" value="<?= $value['id'] ?>">
                                                <button class="adminBtn" name="deleteBarber">Удалить</button>
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