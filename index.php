<?php
    //include "php/database.php";
    include "php/sql.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="info" style="width: 300px; background-color: #ccc; height: 80vh; margin-right: 60px;flex: 0 0 300px;">     
        </div>
        <div class="monitoring">
            <h2 class="monitoring__title">
                Мониторинг загруженности аппаратов КТ/МРТ в мед. организациях СКО
            </h2>
            <div class="monitoring__sel">
                <div class="item">
                    <h3 class="item__title">Выберите организацию:</h3>
                    <div class="item__select">
                        <select name="hospital" id="">
                            <option value="">Областная больница</option>
                        </select>
                    </div>
                </div>
                <div class="item">
                    <h3 class="item__title">Выберите аппарат:</h3>
                    <div class="item__select">
                        <select name="type" id="">
                            <option value="1">КT кабинет (Онко)</option>
                            <option value="2">КT кабинет (Обл)</option>
                            <option value="3">МРТ</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="monitoring__today">
                <h3 class="monitoring__today__title">Сегодня, <?= date("d.m.Y"); ?></h3>
                <div class="monitoring__today__blocks">
                <div class="block">
                        <div class="block__num" id="total">16</div>
                        <div class="block__txt">Всего</div>
                    </div>
                    <div class="block">
                        <div class="block__num" id="recorded">1</div>
                        <div class="block__txt">Записано</div>
                    </div>
                    <div class="block">
                        <div class="block__num" id="came">16</div>
                        <div class="block__txt">Прошли обследование</div>
                    </div>
                    <div class="block block__wrong">
                        <div class="block__num" id="didNotCome">2</div>
                        <div class="block__txt">Не явились</div>
                    </div>
                </div>
            </div>

            <div class="monitoring__cal">
                <h3 class="monitoring__cal__title">Очередь</h3>
                <div class="monitoring__cal__items">
                    <div class="item">
                        <h4 class="item__month"><?= $monthsNames[$month] ?></h4>
                        <div class="item__content">
                            <?= draw_calendar(date("m"), date("Y")); ?>
                        </div>
                    </div>

                    <div class="item">
                        <h4 class="item__month"><?= $monthsNames[$nextMonth] ?></h4>

                        <div class="item__content">
                            <?= draw_calendar(date("m")+1, date("Y")); ?>
                        </div>
                    </div>

                    <div class="item">
                        <h4 class="item__month"><?= $monthsNames[$nextnextMonth] ?></h4>

                        <div class="item__content">
                            <?= draw_calendar(date("m")+2, date("Y")); ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="monitoring__lightning">
                <div class="monitoring__lightning__item monitoring__lightning__active">- нет свободных</div>
                <div class="monitoring__lightning__item monitoring__lightning__nonactive">- есть свободные</div>
                <div class="monitoring__lightning__item monitoring__lightning__neutral">- выходной</div>
            </div>
        </div>
    </div>
    <div class="tooltip">3 свободно</div>
    <script src="js/jquery-3.5.1.js"></script>
    <script src="js/script.js"></script>
</body>
</html>