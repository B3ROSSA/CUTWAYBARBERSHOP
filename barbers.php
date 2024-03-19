<?php
include './vendor/components/header.php';
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
            <h2>Наша команда барберов
                <hr>
            </h2>
            <div class="breadcrumbs">
                <ul>
                    <li><a href="./index.php">Главная</a></li>
                    <li>></li>
                    <li>Наши барберы</li>
                </ul>
            </div>
            <?php
            $barbers = $link->query("SELECT * FROM `barbers`");
            ?>
            <div class="barbers__list">
                <?php
                foreach ($barbers as $key => $value):
                    ?>
                    <div class="barber">
                        <input type="hidden" value="<?= $value['id'] ?>" name="barberId">
                        <div class="barber__img">
                            <img src="./assets/img/barbers/<?= $value['img_barber'] ?>" alt="">
                        </div>
                        <div class="barber__about__block">
                            <h2>
                                <?= $value['name'] ?>
                            </h2>
                            <div class="barber__about__text">
                                <p>
                                    <?= $value['description'] ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="line__dashed"></div>
                    <?php
                endforeach;
                ?>
            </div>

        </section>
    </div>
</main>


<?php
include './vendor/components/footer.php';
?>