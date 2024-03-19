<?php
include "./admin_header.php";
if (!isset($_SESSION['user'])) {
    header('location: ../../index.php');
} elseif ($_SESSION['user']['isAdmin'] != 1) {
    header('location: ../../index.php');
}
$stockId = $_GET['stock_id'];
$changeStockQuery = $link->query("SELECT * FROM `stocks` WHERE `id` = '$stockId'");
$changeStock = mysqli_fetch_assoc($changeStockQuery);

if (isset($_POST['changeStock'])) {
    if ($_FILES['stock_img']['name'] != "" && !empty($_POST['stock_name']) && !empty($_POST['stock_description'])) {
        $deleteOldImgQuery = $link->query("SELECT `img_stock` FROM `stocks` WHERE `id` = '$stockId'");
        $deleteOldImg = mysqli_fetch_assoc($deleteOldImgQuery);
        $deleteOldImgLink = "../../assets/img/stocks/{$deleteOldImg['img_stock']}";
        unlink($deleteOldImgLink);
        $stockNewImg = $_FILES['stock_img'];
        if ("image" == substr($stockNewImg['type'], 0, 5)) {
            $nameImg = uniqid() . "." . substr($stockNewImg['type'], 6);
            move_uploaded_file($stockNewImg['tmp_name'], "../../assets/img/stocks/" . $nameImg);
            $link->query("UPDATE `stocks` SET `img_stock` = '{$nameImg}', `title` = '{$_POST['stock_name']}', `body` = '{$_POST['stock_description']}' WHERE `id` = '$stockId'");
            $_SESSION['success']['changeStock'] = 'Вы успешно изменили акцию!';
            header('location: ./admin_stocks.php');
        }
    } elseif ($_FILES['stock_img']['name'] == "" && !empty($_POST['stock_name']) && !empty($_POST['stock_description'])) {
        $link->query("UPDATE `stocks` SET `title` = '{$_POST['stock_name']}', `body` = '{$_POST['stock_description']}' WHERE `id` = '$stockId'");
        $_SESSION['success']['changeStock'] = 'Вы успешно изменили акцию!';
        header('location: ./admin_stocks.php');
    } else {
        $_SESSION['error']['input'] = "Заполните все поля!";
    }
}
?>
<main class="profile__content">
    <div class="wrapper">
        <section class="profile__block admin__block">
            <h2>Изменение акции</h2>
            <hr>
            <div class="admin__form">
                <form class="admin__add__form changePage" action="#" method="post" enctype="multipart/form-data">
                    <p>
                        <label for="stock_name">Наименование акции</label>
                        <input type="text" placeholder="Наименование услуги" name="stock_name"
                            value="<?= $changeStock['title'] ?>" id="stock_name">
                    </p>
                    <p>
                        <label for="stock_description">Описание акции</label>
                        <textarea style="padding: 10px; min-height: 150px" name="stock_description"
                            id="stock_description"><?= $changeStock['body'] ?></textarea>
                    </p>
                    <p>
                        <label for="">Старое изображение</label>
                        <img style="max-width: 200px;" src="../../assets/img/stocks/<?= $changeStock['img_stock'] ?>"
                            alt="">
                    </p>
                    <p>
                        <label for="stock_img">Выбрать новое изображение</label>
                        <input type="file" id="stock_img" name="stock_img" accept="image/jpeg, image/png" />
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
                    <p class="changePageBtn"><button class="adminBtn" name="changeStock">Применить изменения</button>
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