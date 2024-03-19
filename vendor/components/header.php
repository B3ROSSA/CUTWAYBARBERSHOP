<?php
include "./vendor/components/core.php";
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CutWay - Барбершоп</title>
    <link rel="icon" href="./assets/img/favicon.ico">
    <link rel="stylesheet" href="./assets/styles/swiper-bundle.min.css" />
    <link rel="stylesheet" href="./assets/styles/style.css">
</head>
<script src="./assets/scripts/SmoothScroll.js"></script>

<body>
    <header>
        <div class="header__wrapper">
            <div class="header__nav">

                <!-- Левая навигация -->
                <nav class="header__nav__left">
                    <ul>
                        <li><a class="scrollto" href="./index.php">Главная</a></li>
                        <li><a class="scrollto" href="./index.php#price__list">Прайс-лист</a></li>
                        <li><a class="scrollto" href="./index.php#gallery">Галерея</a></li>
                        <li><a href="./stocks.php">Акции</a></li>
                    </ul>
                </nav>

                <!-- Лого -->
                <div class="logo">
                    <a class="scrollto" href="./index.php"><img src="./assets/img/logo__header.svg" alt="logo"></a>
                </div>

                <!-- Правая навигация -->
                <nav class="header__nav__right">
                    <ul>
                        <li><a class="scrollto" href="./index.php#about__info">О нас</a></li>
                        <li><a href="./barbers.php">Наши барберы</a></li>
                        <li><a class="scrollto" href="./index.php#contacts">Контакты</a></li>
                        <?php
                        if (!isset($_SESSION['user'])) {
                            ?>
                            <li class="header__login"><a href="./authorization.php">Войти</a><img
                                    src="./assets/img/login.svg" alt="login"></li>
                            <?php
                        } else {
                            ?>
                            <li class="header__login"><a href="./profile.php">
                                    <?= $_SESSION['user']['login'] ?>
                                </a><img src="./assets/img/login.svg" alt="login"></li>
                            <?php
                            if ($_SESSION['user']['isAdmin'] == 1) { ?>
                                <li class="header__login"><a href="./vendor/admin/index.php">Админ-панель</a>
                                    <?php
                            }
                        }
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <hr>