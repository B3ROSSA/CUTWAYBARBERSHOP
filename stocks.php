<?php
include "./vendor/components/header.php";
?>

<div class="fixed__buttons">
    <a href="#" class="booking__btn">
        <img class="booking__circle" src="./assets/img/icons/booking__icon__circle.svg" alt="">
    </a>
    <a class="back-to-top"></a>
</div>

<main class="stocks__content">
    <div class="wrapper">
        <section class="section__stocks">
            <h2>Акции
                <hr>
            </h2>
            <div class="breadcrumbs">
                <ul>
                    <li><a href="./index.php">Главная</a></li>
                    <li>></li>
                    <li>Акции</li>
                </ul>
            </div>
            <?php
            $stocks = $link->query("SELECT * FROM `stocks`");
            foreach ($stocks as $key => $value):
                ?>
                <article class="stock">
                    <input type="hidden" value="<?= $value['id'] ?>">
                    <div class="stock__img"><img src="./assets/img/stocks/<?= $value['img_stock'] ?>" alt=""></div>
                    <div class="stock__about__block">
                        <h2>
                            <?= $value['title'] ?>
                        </h2>
                        <div class="stock__about__text">
                            <?= $value['body'] ?>
                        </div>
                    </div>
                </article>
                <?php
            endforeach;
            ?>
        </section>
    </div>
</main>

<?php
include "./vendor/components/footer.php";
?>