<?php
include "./admin_header.php";
if (!isset($_SESSION['user'])) {
    header('location: ../../index.php');
} elseif ($_SESSION['user']['isAdmin'] != 1) {
    header('location: ../../index.php');
}
?>
<main class="profile__content">
    <div class="wrapper">
        <section class="profile__block">
            <h2>Админ-панель</h2>
            <hr>
            <div class="profile__info__block admin__nav">
                <h3 class="admin__nav__h3">
                    <div class="profile__info">
                        <div class="profile__info__headers">
                            <p><a class="admin__nav-link" href="./admin_pricelist.php">Прайс-лист</a></p>
                            <p><a class="admin__nav-link" href="./admin_gallery.php">Галерея</a></p>
                            <p><a class="admin__nav-link" href="./admin_stocks.php">Акции</a></p>
                            <p><a class="admin__nav-link" href="./admin_barbers.php">Барберы</a></p>
                        </div>
                    </div>
                </h3>
            </div>
            <div class="logout admin_logout"><a class="logout__btn" href="../../profile.php">Выход</a></div>
        </section>
    </div>
</main>

<?php
include "./admin_footer.php";
unset($_SESSION['error']);
unset($_SESSION['success']);
?>