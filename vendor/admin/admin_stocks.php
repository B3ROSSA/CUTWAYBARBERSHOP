<?php
include "./admin_header.php";
if (!isset($_SESSION['user'])) {
    header('location: ../../index.php');
} elseif ($_SESSION['user']['isAdmin'] != 1) {
    header('location: ../../index.php');
}

if (isset($_POST['addStock'])) {
    if (!empty($_POST['stock_name']) && !empty($_POST['stock_description']) && !empty($_FILES['stock_img'])) {
        $stockImg = $_FILES['stock_img'];
        if ("image" == substr($stockImg['type'], 0, 5)) {
            $nameImg = uniqid() . "." . substr($stockImg['type'], 6);
            move_uploaded_file($stockImg['tmp_name'], "../../assets/img/stocks/" . $nameImg);
            mysqli_query($link, "INSERT INTO `stocks` (`img_stock`, `title`, `body`) VALUES ('$nameImg', '{$_POST['stock_name']}', '{$_POST['stock_description']}')");
            $_SESSION['success']['addStock'] = 'Вы успешно добавили акцию!';
        }else{
            $_SESSION['error']['addStockImg'] = 'Выберите изображение!';
        }
    } else {
        $_SESSION['error']['inputs'] = "Заполните все поля!";
    }
}

if (isset($_POST['deleteStock'])) {
    $stockQuery = $link->query("SELECT * FROM `stocks` WHERE `id` = '{$_POST['stock_id']}'");
    $stockResult = mysqli_fetch_assoc($stockQuery);
    $deleteLink = "../../assets/img/stocks/{$stockResult['img_stock']}";
    unlink($deleteLink);
    $link->query("DELETE FROM `stocks` WHERE `id` = '{$_POST['stock_id']}'");
    $_SESSION['success']['deleteStock'] = 'Вы успешно удалили акцию!';
}
$adminStocks = $link->query("SELECT * FROM `stocks`");
?>
<main class="profile__content">
    <div class="wrapper">
        <section class="profile__block admin__block">
            <h2>Акции</h2>
            <hr>
            <div class="admin__form">
                <h3>Добавление акции</h3>
                <form class="admin__add__form" action="#" method="post" enctype="multipart/form-data">
                    <input type="file" id="stock_img" name="stock_img" accept="image/jpeg, image/png" />
                    <input type="text" placeholder="Наименование акции" name="stock_name">
                    <textarea name="stock_description" id="stock_description"
                        style="width: 100%; height:150px; padding: 10px;" placeholder="Описание акции"></textarea>
                    <button class="adminBtn" name="addStock">Добавить</button>
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
                                <th>Наименование акции</th>
                                <th>Описание акции</th>
                                <th>Изображение</th>
                                <th>Изменить/Удалить</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($adminStocks as $key => $value):
                                ?>
                                <tr>
                                    <td>
                                        <?= $value['id'] ?>
                                    </td>
                                    <td>
                                        <?= $value['title'] ?>
                                    </td>
                                    <td style="max-width: 700px;">
                                        <?= $value['body'] ?>
                                    </td>
                                    <td>
                                        <img style="max-width: 150px;"
                                            src="../../assets/img/stocks/<?= $value['img_stock'] ?>" alt="stock">
                                    </td>
                                    <td>
                                        <div class="table_btns">
                                            <form action="./change_stock.php" method="get">
                                                <input type="hidden" name="stock_id" value="<?= $value['id'] ?>">
                                                <button class="adminBtn" name="changeStock">Изменить</button>
                                            </form>
                                            <form action="#" method="post">
                                                <input type="hidden" name="stock_id" value="<?= $value['id'] ?>">
                                                <button class="adminBtn" name="deleteStock">Удалить</button>
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