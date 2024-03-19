<?php
include './vendor/components/header.php';

$pricelist = $link->query("SELECT * FROM `pricelist`");
?>

<div class="fixed__buttons">
    <a href="#" class="booking__btn">
        <img class="booking__circle" src="./assets/img/icons/booking__icon__circle.svg" alt="">
    </a>
    <a class="back-to-top"></a>
</div>

<main>

    <section class="section__main">
        <div class="wrapper">
            <p class="section__main__text">Первое посещение со скидкой <span class="accent">20</span>%</p>
            <a class="section__main__btn" href="#">Записаться</a>

            <div class="section__main__advantages__block">

                <div class="section__main_advantages">
                    <div class="section__main__advantage">
                        <p class="accent">20.000+</p>
                        <p>Довольных клиентов</p>
                    </div>
                    <div class="section__main__advantage">
                        <div class="advantage__logo">
                            <img src="./assets/img/logo__main.svg" alt="">
                        </div>
                        <p class="accent">11 лет</p>
                        <p>подчёркиваем вашу красоту</p>
                    </div>
                    <div class="section__main__advantage">
                        <p class="accent">30</p>
                        <p>Барберов профессионалов</p>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <div class="wrapper">

        <div class="main__content__block">

            <section class="section__price__list">
                <h2 id="price__list">Прайс-лист</h2>
                <div class="price__list__block">
                    <img class="price__tag" src="./assets/img/price__tag.png" alt="tag">
                    <div class="price__list">
                        <ul>
                            <?php
                            foreach ($pricelist as $key => $value):
                                ?>
                                <li>
                                    <div class="price__text">
                                        <input type="hidden" value="<?= $value['id'] ?>">
                                        <p>
                                            <?= $value['service_name'] ?>
                                        </p>
                                        <p>
                                            <?= $value['service_cost'] ?> р.
                                        </p>
                                    </div>
                                    <hr>
                                </li>
                                <?php
                            endforeach;
                            ?>
                        </ul>
                        <a href="#" class="price__btn">Оформить запись</a>
                    </div>
                    <img src="./assets/img/price__image.png" alt="barbershop">
                </div>
            </section>

            <section class="section__about__info">
                <h2 id="about__info">О нашем барбершопе</h2>

                <div class="about__advantages">
                    <div class="advantage_1">
                        <p>Низкие цены</p>
                    </div>
                    <div class="advantage_2">
                        <p>Лучшие барберы Омска</p>
                    </div>
                    <div class="advantage_3">
                        <p>Легендарное место</p>
                    </div>
                </div>

                <div class="about__text__block">
                    <div class="about__text__logo">
                        <img src="./assets/img/logo__about.svg" alt="">
                    </div>
                    <hr>
                    <div class="about__text">
                        <p>Это не просто барбершоп, это место, где каждый мужчина может получить <span
                                class="accent">идеальную стрижку</span> и <span class="accent">бритьё</span>, а также
                            насладиться атмосферой мужского сообещства.</p>
                        <p>Наши мастера обладают <span class="accent">большим опытом</span> и <span
                                class="accent">профессионализмом</span>, поэтому вы можете быть уверены в качестве наших
                            услуг.</p>
                        <p>мы следим за последними тенденциями в мужской стрижке и бритье, чтобы предложить вам самые
                            <span class="accent">современные</span> и <span class="accent">стильные</span> образы.
                        </p>
                    </div>
                </div>

            </section>

            <section class="section__gallery">
                <h2 id="gallery">Галерея</h2>
                <div class="change__gallery">
                    <p id="gallery__int" class="gallery__active">Интерьер</p>
                    <hr>
                    <p id="gallery__haircuts">Прически</p>
                </div>
                <?php
                $galleryInterior = $link->query("SELECT * FROM `gallery` WHERE `type` = 'interior'")
                    ?>
                <div class="gallery__interior">
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            <?php
                            foreach ($galleryInterior as $key => $value):
                                ?>
                                <div class="swiper-slide">
                                    <input type="hidden" value="<?= $value['id'] ?>" name="interior_img_ID">
                                    <img src="./assets/img/gallery/interior/<?= $value['img_name'] ?>" alt="interior">
                                </div>
                                <?php
                            endforeach;
                            ?>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
                <?php
                $galleryHaircuts = $link->query("SELECT * FROM `gallery` WHERE `type` = 'haircut'")
                    ?>
                <div class="gallery__haircuts">
                    <?php
                    foreach ($galleryHaircuts as $key => $value):
                        ?>
                        <input type="hidden" value="<?= $value['id'] ?>" name="haircut_img_ID">
                        <img src="./assets/img/gallery/haircuts/<?= $value['img_name'] ?>" alt="haircut">
                        <?php
                    endforeach;
                    ?>
                </div>
            </section>

            <section class="section__contacts">
                <h2 id="contacts">Контакты</h2>
                <div class="map">
                    <iframe
                        src="https://yandex.ru/map-widget/v1/?um=constructor%3Adccbaf8ab8508b6470fb535367dfbaece2739d0392ad3972d8efe9e6781b7dd0&amp;source=constructor"
                        width="100%" height="550" frameborder="0"></iframe>
                </div>
                <div class="contacts__block">
                    <div class="contacts">
                        <ul>

                            <li>
                                <img src="./assets/img/icons/email.svg" alt="email">
                                <p>cutway@list.ru</p>
                            </li>

                            <li>
                                <img src="./assets/img/icons/phone.svg" alt="phone">
                                <p><a href="tel:+79136367684">+7 (913) 636-76-84</a></p>
                            </li>

                            <li>
                                <img src="./assets/img/icons/map__marker.svg" alt="phone">
                                <p><a href="https://clck.ru/36q8VD">ул. Карла Либкнехта, 3/12к1</a></p>
                            </li>

                        </ul>
                    </div>
                    <div class="contacts__social">
                        <a href="#"><img src="./assets/img/icons/vk.svg" alt="vkontakte"></a>
                        <a href=""><img src="./assets/img/icons/telegram.svg" alt="telegram"></a>

                    </div>
                </div>
            </section>
        </div>

    </div>

</main>

<?php
include './vendor/components/footer.php';
?>