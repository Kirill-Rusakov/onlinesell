<?php
session_start();
$botToken = $_SESSION['company_data']['bot_token'];
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Создание бота - предпросмотр</title>
    <link rel="stylesheet" href="css/main.min.css">
    <link rel="apple-touch-icon" sizes="180x180" href="/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/favicons/favicon-16x16.png">
    <link rel="mask-icon" href="/img/favicons/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="/img/favicons/favicon.ico">
    <meta name="msapplication-TileColor" content="#00a300">
    <meta name="msapplication-config" content="/img/favicons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="header__wrapper">
                <h1 class="logo logo--color">Onlinesell</h1>
                <div class="header__components">
                    <select class="select" name="lang" id="lang">
                        <option value="rus">Русский</option>
                        <option value="eng">English</option>
                        <option value="uzb">O`zbek</option>
                    </select>
                    <button type="button" class="header__button">
                        <img src="./img/icons/question.svg" alt="иконка помощи">
                    </button>
                    <a href="index.html" class="header__button">
                        <span>Выйти</span>
                        <img src="./img/icons/exit.svg" alt="иконка выхода">
                    </a>
                </div>
            </div>
        </div>
    </header>
    <main class="main-create">
        <div class="container">
            <div class="main-create__wrapper">
                <ul class="main-create__menu mb-3">
                    <li><div><img src="./img/icons/robot.svg" alt="иконка действия"></div><span>Создание бота</span></li>
                    <li><div><img src="./img/icons/gear.svg" alt="иконка действия"></div><span>Настройка</span></li>
                    <li><div><img src="./img/icons/plus.svg" alt="иконка действия"></div><span>Добавление категории</span></li>
                    <li><div><img src="./img/icons/plus2.svg" alt="иконка действия"></div><span>Добавление продукта</span></li>
                    <li><div><img src="./img/icons/delivery.svg" alt="иконка действия"></div><span>Доставка</span></li>
                    <li class="active"><div><img src="./img/icons/view.svg" alt="иконка действия"></div><span>Предпросмотр</span></li>
                </ul>
                <div class="main-create__token">
                    <form class="form">
                        <img src="./img/mobile-phone.png" alt="смартфон" style="width: 50%; height: 30%; margin: 0 auto; margin-bottom: 6rem;">
                        <div class="form__telegram-block" id="telegram-bot-bg">
                            <input type="text" name="telegram-bot" id="telegram-bot" placeholder="Впишите имя бота">
                            <img src="./img/icons/question.svg" id="telegram-question" alt="вопрос">
                            <img src="./img/where-name.PNG" id="telegram-help" alt="подсказка о боте">
                            <button type="button" class="form__open-telegram" onclick="setWebhook()">
                                <img src="./img/icons/telegram2.svg" alt="иконка телеграм">
                                <span>Open in telegram</span>
                            </button>
                        </div>
                        <div class="form__buttons">
                            <a href="create5.html" class="button">&larr; Назад</a>
                            <a href="main.php" class="button">Далее &rarr;</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script src="./libs/jquery-3.7.1.js"></script>

    <script>
        const botToken = "<?php echo $botToken; ?>";

        function setWebhook() {

            const botName = $('#telegram-bot').val();
            if (!botName) {
                alert("Пожалуйста, впишите имя бота.");
                return;
            }


            $.ajax({
                method: "POST",
                url: `https://api.telegram.org/bot${botToken}/deleteWebhook`,
            })
            .done(function() {
                console.log('Webhook deleted successfully');

                setTimeout(function(){
                    $.ajax({
                        method: "POST",
                        url: `https://api.telegram.org/bot${botToken}/setWebhook?url=https://rusakov-test.ru/php/webhooks/webhooks.php`,
                    })
                    .done(function(response) {
                        console.log('Webhook set:', response);
                        
                        const url = `https://t.me/${$('#telegram-bot').val()}`;

                        window.open(url, '_blank');
                    })
                    .fail(function(error) {
                        console.error('Error during webhook setup:', error);
                    });
                }, 1500)
            })
            .fail(function(error) {
                console.error('Error deleting webhook:', error);
            });
        };

        $('#telegram-question').on('click', function(){
            $('#telegram-help').css('display', 'block');
            setTimeout(function(){
                $('#telegram-help').css('display', 'none');
            }, 2000);
        });
    </script>
</body>
</html>
