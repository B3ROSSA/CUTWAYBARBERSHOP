<?php
include "./admin_header.php";
if (!isset($_SESSION['user'])) {
    header('location: ../../index.php');
} elseif ($_SESSION['user']['isAdmin'] != 1) {
    header('location: ../../index.php');
}


if (isset($_POST['addImg'])) {
    if ($_FILES['galleryImg']['name'] != "") {
        $galleryImg = $_FILES['galleryImg'];
        if ("image" == substr($galleryImg['type'], 0, 5)) {
            $nameImg = uniqid() . "." . substr($galleryImg['type'], 6);
            if ($_POST['imgType'] == "interior") {
                move_uploaded_file($galleryImg['tmp_name'], "../../assets/img/gallery/interior/" . $nameImg);
                mysqli_query($link, "INSERT INTO `gallery` (`type`, `img_name`) VALUES ('interior', '$nameImg')");
                $_SESSION['success']['addImgGallery'] = "Вы успешно добавили изображению в галерею интерьера!";
            }
            if ($_POST['imgType'] == "haircut") {
                move_uploaded_file($galleryImg['tmp_name'], "../../assets/img/gallery/haircuts/" . $nameImg);
                mysqli_query($link, "INSERT INTO `gallery` (`type`, `img_name`) VALUES ('haircut', '$nameImg')");
                $_SESSION['success']['addImgGallery'] = "Вы успешно добавили изображению в галерею стрижек!";
            }
        }
    } else {
        $_SESSION['error']['chooseImg'] = "Выберите изображение!";
    }
}
if (isset($_POST['deleteImg'])) {
    $imageQuery = $link->query("SELECT * FROM `gallery` WHERE `id` = '{$_POST['imgId']}'");
    $imageResult = mysqli_fetch_assoc($imageQuery);
    if ($imageResult['type'] == 'haircut') {
        $deleteImgLink = "../../assets/img/gallery/haircuts/{$imageResult['img_name']}";
        unlink($deleteImgLink);
        $link->query("DELETE FROM `gallery` WHERE `id` = '{$_POST['imgId']}'");
        $_SESSION['success']['addImgGallery'] = "Вы успешно удалили изображение из галереи стрижек!";
    } elseif ($imageResult['type'] == 'interior') {
        $deleteImgLink = "../../assets/img/gallery/interior/{$imageResult['img_name']}";
        unlink($deleteImgLink);
        $link->query("DELETE FROM `gallery` WHERE `id` = '{$_POST['imgId']}'");
        $_SESSION['success']['addImgGallery'] = "Вы успешно удалили изображение из галереи интерьера!";
    }
}
?>
<main class="profile__content">
    <div class="wrapper">
        <section class="profile__block admin__block">
            <h2>Галерея</h2>
            <hr>
            <div class="admin__form">
                <h3>Добавление изображения в галерею</h3>
                <form class="admin__add__form" action="#" method="post" enctype="multipart/form-data">
                    <input type="file" id="galleryImg" name="galleryImg" accept="image/png, image/jpeg" />
                    <select name="imgType" id="imgType">
                        <option value="interior">Интерьер</option>
                        <option value="haircut">Причёска</option>
                    </select>
                    <button class="adminBtn" name="addImg">Добавить</button>
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
            <div class="change__gallery">
                <p id="gallery__int" class="gallery__active">Интерьер</p>
                <hr>
                <p id="gallery__haircuts">Прически</p>
            </div>

            <?php
            $galleryInterior = $link->query("SELECT * FROM `gallery` WHERE `type` = 'interior'")
                ?>
            <div class="gallery__interior">
                <?php
                foreach ($galleryInterior as $key => $value):
                    ?>
                    <div class="swiper-slide admin__images__form">
                        <form action="#" method="post">
                            <input type="hidden" value="<?= $value['id'] ?>" name="imgId">
                            <img src="../../assets/img/gallery/interior/<?= $value['img_name'] ?>" alt="interior"
                                style="max-width: 1060px; max-height: 640px;">
                            <button class="adminBtn" name="deleteImg">Удалить</button>
                        </form>
                    </div>
                    <br>
                    <?php
                endforeach;
                ?>
            </div>


            <div class="gallery__haircuts">
                <?php
                $galleryHaircuts = $link->query("SELECT * FROM `gallery` WHERE `type` = 'haircut'");
                foreach ($galleryHaircuts as $key => $value):
                    ?>
                    <form action="#" method="post" class="admin__images__form">
                        <input type="hidden" value="<?= $value['id'] ?>" name="imgId">
                        <img src="../../assets/img/gallery/haircuts/<?= $value['img_name'] ?>" alt="haircut">
                        <button class="adminBtn" name="deleteImg">Удалить</button>
                    </form>
                    <?php
                endforeach;
                ?>
            </div>
            <!--<div class="admin__form">
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
            </div>-->
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