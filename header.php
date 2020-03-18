<?php
//Запускаем сессию
session_start();
?>


<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HomePage</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i"
          rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link href="assets/css/all.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            "use strict";
            //================ Проверка email ==================

            //регулярное выражение для проверки email
            var pattern = /^[a-z0-9][a-z0-9\._-]*[a-z0-9]*@([a-z0-9]+([a-z0-9-]*[a-z0-9]+)*\.)+[a-z]+/i;

            $('input[name=email]').blur(function () {

                if ($(this).val() != '') {

                    // Проверяем, если введенный email соответствует регулярному выражению
                    if ($(this).val().search(pattern) == 0) {

                        $.ajax({

                            // Название файла, в котором будем проверять email на существование в базе данных
                            url: "check_email.php",

                            // Указывываем каким методом будут переданы данные
                            type: "POST",

                            // Указывываем в формате JSON какие данные нужно передать
                            data: {
                                email: $(this).val()
                            },

                            // Тип содержимого которого мы ожидаем получить от сервера.
                            dataType: "html",

                            // Функция которая будет выполнятся перед отправкой данных
                            beforeSend: function () {

                                $('#valid_email_message').text('Проверяется...');
                            },

                            // Функция которая будет выполнятся после того как все данные будут успешно получены.
                            success: function (data) {

                                //Полученный ответ помещаем внутри тега span
                                $('#valid_email_message').html(data);
                            }
                        });

                        //Активируем кнопку отправки
                        $('input[type=submit]').attr('disabled', false);
                    } else {
                        //Выводим сообщение об ошибке
                        $('#valid_email_message').html('<span class="mesage_error">Не правильный Email</span>');

                        // Дезактивируем кнопку отправки
                        $('input[type=submit]').attr('disabled', true);
                    }

                } else {
                    $('#valid_email_message').html('<span class="mesage_error">Введите Ваш email</span>');
                }
            });

            //================ Проверка длины пароля ==================
            var password = $('input[name=password]');

            password.blur(function () {
                if (password.val() != '') {

                    //Если длина введенного пароля меньше шести символов, то выводим сообщение об ошибке
                    if (password.val().length < 6) {
                        //Выводим сообщение об ошибке
                        $('#valid_password_message').text('Минимальная длина пароля 6 символов');

                        // Дезактивируем кнопку отправки
                        $('input[type=submit]').attr('disabled', true);

                    } else {
                        // Убираем сообщение об ошибке
                        $('#valid_password_message').text('');

                        //Активируем кнопку отправки
                        $('input[type=submit]').attr('disabled', false);
                    }
                } else {
                    $('#valid_password_message').text('Введите пароль');
                }
            });
        });
    </script>

    <link rel="stylesheet" href="assets/fontawesome-free-5.12.1-web/css/all.min.css">


</head>

<body>

<!-- NAVIGATION BAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="index.php">SHOPPING</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="contact%20us.php">CONTACT US<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="about%20us.php">ABOUT US<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">HOME<span class="sr-only">(current)</span></a>
                </li>

                <?php
                //Проверяем авторизован ли пользователь
                if (!isset($_SESSION['email']) && !isset($_SESSION['password'])) {
                    // если нет, то выводим блок с ссылками на страницу регистрации и авторизации
                    ?>

                    <li class="nav-item active">
                        <a class="nav-link" href="form_auth.php">LOGIN</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="form_register.php">REGISTER</a>
                    </li>

                    <?php
                } else {
                    //Если пользователь авторизован, то выводим ссылку Выход
                    ?>
                    <div id="link_logout">
                        <a href="/logout.php">Выход</a>
                    </div>
                    <?php
                }
                ?>


            </ul>
        </div>

        <!-- <form class="form-inline">
            <input type="search" class="form-control mr-sm-2" placeholder="Search" aria-label="Search">
            <button class="button btn-outline-dark my-2 my-sm-0" type="submit">Search</button>
        </form> -->
    </div>
</nav>
