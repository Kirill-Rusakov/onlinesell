<?php

require_once './php/registration_and_authorization/connect_db.php';

try {

    // Получение продуктов
    $sql = "SELECT * FROM products";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $products = $stmt->fetchAll(PDO::FETCH_ASSOC); // Получаем массив всех записей

    // Подсчет количества записей
    $count = $stmt->rowCount();
} catch (PDOException $e) {
    echo "Ошибка соединения: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ONLINESELL - административная панель</title>
    <link rel="stylesheet" href="css/main-site.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js" defer></script>
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
    <div class="container">
        <div class="sidebar">
            <div class="logo">
                <a href="#" class="logo-text">ONLINESELL</a>
            </div>
            <ul class="menu">
                <li id="on-main">Дашборд</li>
                <li class="orders-link">Заказы</li>
                <li class="clients-link">Клиенты</li>
                <li class="chat-link">Чат</li>
                <li class="products-link">Продукты
                </li>
                <li class="promo-link">Маркетинг
                    <!-- <ul class="submenu">
                        <li>Рассылки</li>
                        <li>Промокод</li>
                    </ul> -->
                </li>
                <li class="platforms-link">Платформы
                    <!-- <ul class="submenu">
                        <li>Telegram</li>
                        <li>Вебсайт</li>
                    </ul> -->
                </li>
                <li class="payment-link">Способ оплаты</li>
                <li class="delivery-link">Доставка</li>
                <li><a href="#" class="tariff-plan" style="background-color: transparent;padding: 0;">Тарифный план</a></li>
                <li class="workers-link">Сотрудники</li>
                <li class="settings-link">Настройки</li>
            </ul>
        </div>
        <div class="main-content">
            <div class="header">
                <div class="language-switcher">
                    <select>
                        <option value="ru">Рус</option>
                        <option value="uzb">Uzb</option>
                        <option value="eng">Eng</option>
                    </select>
                </div>
                <div class="balance-container">
                    <span class="balance">Ваш баланс: 0 UZS</span>
                    <button class="add-balance">+</button>
                </div>
                <div class="icons">
                    <span class="icon">?</span>
                    <span class="icon">i</span>
                    <span class="icon"><img src="./img/icons/profile.svg" alt="выход" width="20px" height="20px"></span>
                    <a href="index.html"><img src="./img/icons/exit.svg" alt="выход" width="20px" height="20px"></a>
                </div>
            </div>
            <div id="dashboard" class="dashboard">
                <!-- Dashboard content here -->
                <div class="stats">
                    <div class="stat">
                        <div class="stat-header">
                            <div class="stat-title">Доход</div>
                            <div class="stat-period">
                                <select>
                                    <option>Ежедневно</option>
                                    <option selected>Еженедельно</option>
                                    <option>Ежемесячно</option>
                                    <option>Ежегодно</option>
                                </select>
                            </div>
                        </div>
                        <div class="stat-value">0 RUB</div>
                    </div>
                    <div class="stat">
                        <div class="stat-header">
                            <div class="stat-title">Заказы</div>
                            <div class="stat-period">
                                <select>
                                    <option>Ежедневно</option>
                                    <option selected>Еженедельно</option>
                                    <option>Ежемесячно</option>
                                    <option>Ежегодно</option>
                                </select>
                            </div>
                        </div>
                        <div class="stat-value">0</div>
                    </div>
                    <div class="stat">
                        <div class="stat-header">
                            <div class="stat-title">Всего клиентов</div>
                            <div class="stat-period">
                                <select>
                                    <option>Ежедневно</option>
                                    <option selected>Еженедельно</option>
                                    <option>Ежемесячно</option>
                                    <option>Ежегодно</option>
                                </select>
                            </div>
                        </div>
                        <div class="stat-value">0</div>
                    </div>
                </div>
                <div class="charts">
                    <div class="chart">
                        <div class="chart-header">
                            <div class="chart-title">Статистика по доходу</div>
                            <div class="chart-period">
                                <select>
                                    <option>Ежедневно</option>
                                    <option selected>Еженедельно</option>
                                    <option>Ежемесячно</option>
                                    <option>Ежегодно</option>
                                </select>
                            </div>
                        </div>
                        <!-- Chart content -->
                        <canvas id="revenueChart"></canvas> <!-- Chart Canvas -->
                    </div>
                    <div class="chart">
                        <div class="chart-header">
                            <div class="chart-title">Статистика заказов</div>
                            <div class="chart-period">
                                <select>
                                    <option>Ежедневно</option>
                                    <option selected>Еженедельно</option>
                                    <option>Ежемесячно</option>
                                    <option>Ежегодно</option>
                                </select>
                            </div>
                        </div>
                        <!-- Chart content -->
                        <div class="order-counts">
                            <div class="order-source">
                                <img src="img/icons/telegram.svg" alt="Telegram"> 
                                <span>Telegram bot</span>
                                <div class="count">0</div>
                            </div>
                            <!-- <div class="order-source">
                                <img src="img/icons/website.svg" alt="Website">
                                <span>Вебсайт</span>
                                <div class="count">0</div>
                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="traffic-and-top-products">
                    <div class="traffic">
                        <div class="traffic-header">
                            <div class="traffic-title">Источник трафика</div>
                            <div class="traffic-period">
                                <select>
                                    <option>Ежедневно</option>
                                    <option selected>Еженедельно</option>
                                    <option>Ежемесячно</option>
                                    <option>Ежегодно</option>
                                </select>
                            </div>
                        </div>
                        <!-- Traffic content -->
                    </div>
                    <div class="top-products">
                        <div class="top-products-header">
                            <div class="top-products-title">Топ 10 продуктов</div>
                            <div class="top-products-period">
                                <select>
                                    <option>Ежедневно</option>
                                    <option selected>Еженедельно</option>
                                    <option>Ежемесячно</option>
                                    <option>Ежегодно</option>
                                </select>
                            </div>
                        </div>
                        <!-- Top products content -->
                    </div>
                </div>
                <div class="orders-limit">
                    <p>Ваш лимит исчерпан</p>
                    <button class="tariff-plan">Тарифный план</button>
                </div>
            </div>
            <div id="tariffs" class="tariffs" style="display: none;">
                <div class="tariff-switcher">
                    <button class="switch active">1 месяц</button>
                    <button class="switch">6 месяцев</button>
                    <button class="switch">на год</button>
                </div>
                <div class="tariff-plans">
                    <div class="tariff">
                        <h3>Тариф 1</h3>
                        <p>$100</p>
                        <ul>
                            <li>Пункт 1</li>
                            <li>Пункт 2</li>
                            <li>Пункт 3</li>
                            <li class="inactive">Пункт 4</li>
                            <li class="inactive">Пункт 5</li>
                        </ul>
                    </div>
                    <div class="tariff">
                        <h3>Тариф 2</h3>
                        <p>$200</p>
                        <ul>
                            <li>Пункт 1</li>
                            <li>Пункт 2</li>
                            <li>Пункт 3</li>
                            <li>Пункт 4</li>
                            <li class="inactive">Пункт 5</li>
                        </ul>
                    </div>
                    <div class="tariff">
                        <h3>Тариф 3</h3>
                        <p>$300</p>
                        <ul>
                            <li>Пункт 1</li>
                            <li>Пункт 2</li>
                            <li>Пункт 3</li>
                            <li>Пункт 4</li>
                            <li>Пункт 5</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="orders" id="orders" style="display: none;">
                <h2>ЗАКАЗЫ</h2>
            </div>
            <div class="clients" id="clients" style="display: none;">
                <h2>Клиенты</h2>
            </div>
            <div class="chat" id="chat" style="display: none;">
                <h2>Чат</h2>
            </div>
            <div class="products" id="products" style="display: none;">
                <h2>Категории и Продукты</h2>
                <div class="products-list">
                    <?php if (!empty($products)): ?>
                        <div class="product-grid">
                            <?php foreach ($products as $product): ?>
                                <div class="product-card">
                                    <div class="product-image">
                                        <img src="<?php echo $product['product_logo']; ?>" alt="<?php echo $product['product_title']; ?>" />
                                    </div>
                                    <div class="product-info">
                                        <h3 class="product-title"><?php echo $product['product_title']; ?></h3>
                                        <!-- <p class="product-category"><?php echo $product['category']; ?></p> -->
                                        <p class="product-price"><?php echo $product['product_price']; ?> UZS</p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p>Нет доступных продуктов.</p>
                    <?php endif; ?>
                </div>
                <button id="addProductBtn">Добавить продукт</button>
                <div class="modal-product">
                    <form class="form form-products">
                        <h2>Добавьте новый продукт</h2>
                        <input type="text" name="product-title" placeholder="название продукта">
                        <input type="text" name="price" placeholder="стоимость продукта">
                        <input type="text" name="unit" placeholder="единица измерения">
                        <textarea name="product-desc" placeholder="описание продукта"></textarea>
                        <input type="file" name="product-logo" class="form-file">
                        <button type="submit">Добавить</button>
                    </form>
                </div>
            </div>
            <div class="promo" id="promo" style="display: none;">
                <h2>Рассылки и Промокоды</h2>
            </div>
            <div class="platforms" id="platforms" style="display: none;">
                <h2>Telegram bots</h2>
            </div>
            <div class="payment" id="payment" style="display: none;">
                <h2>Способы оплаты</h2>
            </div>
            <div class="delivery" id="delivery" style="display: none;">
                <h2>Доставка</h2>
            </div>
            <div class="workers" id="workers" style="display: none;">
                <h2>Сотрудники</h2>
            </div>
            <div class="settings" id="settings" style="display: none;">
                <h2>Настройки</h2>
            </div>
        </div>
    </div>
    <script src="./libs/jquery-3.7.1.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Toggle submenu visibility
            document.querySelectorAll('.has-submenu').forEach(item => {
                item.addEventListener('click', () => {
                    item.classList.toggle('open');
                });
            });

            // Show tariffs and hide dashboard
            document.querySelectorAll('.tariff-plan').forEach(item => {
                item.addEventListener('click', () => {
                    document.getElementById('dashboard').style.display = 'none';
                    document.getElementById('tariffs').style.display = 'block';
                });
            });

            // Show dashboard and hide tariffs
            document.querySelector('#on-main').addEventListener('click', () => {
                document.getElementById('dashboard').style.display = 'block';
                document.getElementById('tariffs').style.display = 'none';
            });

            // Show orders and hide dashboard
            document.querySelectorAll('.orders-link').forEach(item => {
                item.addEventListener('click', () => {
                    document.getElementById('dashboard').style.display = 'none';
                    document.getElementById('orders').style.display = 'block';
                });
            });

            // Show dashboard and hide orders
            document.querySelector('#on-main').addEventListener('click', () => {
                document.getElementById('dashboard').style.display = 'block';
                document.getElementById('orders').style.display = 'none';
            });

            // Show clients and hide dashboard
            document.querySelectorAll('.clients-link').forEach(item => {
                item.addEventListener('click', () => {
                    document.getElementById('dashboard').style.display = 'none';
                    document.getElementById('clients').style.display = 'block';
                });
            });

            // Show dashboard and hide clients
            document.querySelector('#on-main').addEventListener('click', () => {
                document.getElementById('dashboard').style.display = 'block';
                document.getElementById('clients').style.display = 'none';
            });

            // Show chat and hide dashboard
            document.querySelectorAll('.chat-link').forEach(item => {
                item.addEventListener('click', () => {
                    document.getElementById('dashboard').style.display = 'none';
                    document.getElementById('chat').style.display = 'block';
                });
            });

            // Show dashboard and hide chat
            document.querySelector('#on-main').addEventListener('click', () => {
                document.getElementById('dashboard').style.display = 'block';
                document.getElementById('chat').style.display = 'none';
            });

            // Show products and hide dashboard
            document.querySelectorAll('.products-link').forEach(item => {
                item.addEventListener('click', () => {
                    document.getElementById('dashboard').style.display = 'none';
                    document.getElementById('products').style.display = 'block';
                });
            });

            // Show dashboard and hide products
            document.querySelector('#on-main').addEventListener('click', () => {
                document.getElementById('dashboard').style.display = 'block';
                document.getElementById('products').style.display = 'none';
            });

            // Show promo and hide dashboard
            document.querySelectorAll('.promo-link').forEach(item => {
                item.addEventListener('click', () => {
                    document.getElementById('dashboard').style.display = 'none';
                    document.getElementById('promo').style.display = 'block';
                });
            });

            // Show dashboard and hide promo
            document.querySelector('#on-main').addEventListener('click', () => {
                document.getElementById('dashboard').style.display = 'block';
                document.getElementById('promo').style.display = 'none';
            });

            // Show platforms and hide dashboard
            document.querySelectorAll('.platforms-link').forEach(item => {
                item.addEventListener('click', () => {
                    document.getElementById('dashboard').style.display = 'none';
                    document.getElementById('platforms').style.display = 'block';
                });
            });

            // Show dashboard and hide platforms
            document.querySelector('#on-main').addEventListener('click', () => {
                document.getElementById('dashboard').style.display = 'block';
                document.getElementById('platforms').style.display = 'none';
            });

            // Show payment and hide dashboard
            document.querySelectorAll('.payment-link').forEach(item => {
                item.addEventListener('click', () => {
                    document.getElementById('dashboard').style.display = 'none';
                    document.getElementById('payment').style.display = 'block';
                });
            });

            // Show dashboard and hide payment
            document.querySelector('#on-main').addEventListener('click', () => {
                document.getElementById('dashboard').style.display = 'block';
                document.getElementById('payment').style.display = 'none';
            });

             // Show delivery and hide dashboard
             document.querySelectorAll('.delivery-link').forEach(item => {
                item.addEventListener('click', () => {
                    document.getElementById('dashboard').style.display = 'none';
                    document.getElementById('delivery').style.display = 'block';
                });
            });

            // Show dashboard and hide delivery
            document.querySelector('#on-main').addEventListener('click', () => {
                document.getElementById('dashboard').style.display = 'block';
                document.getElementById('delivery').style.display = 'none';
            });

             // Show workers and hide dashboard
             document.querySelectorAll('.workers-link').forEach(item => {
                item.addEventListener('click', () => {
                    document.getElementById('dashboard').style.display = 'none';
                    document.getElementById('workers').style.display = 'block';
                });
            });

            // Show dashboard and hide workers
            document.querySelector('#on-main').addEventListener('click', () => {
                document.getElementById('dashboard').style.display = 'block';
                document.getElementById('workers').style.display = 'none';
            });

             // Show settings and hide dashboard
             document.querySelectorAll('.settings-link').forEach(item => {
                item.addEventListener('click', () => {
                    document.getElementById('dashboard').style.display = 'none';
                    document.getElementById('settings').style.display = 'block';
                });
            });

            // Show dashboard and hide settings
            document.querySelector('#on-main').addEventListener('click', () => {
                document.getElementById('dashboard').style.display = 'block';
                document.getElementById('settings').style.display = 'none';
            });

            // Switch active tariff duration
            document.querySelectorAll('.switch').forEach(item => {
                item.addEventListener('click', () => {
                    document.querySelectorAll('.switch').forEach(button => {
                        button.classList.remove('active');
                    });
                    item.classList.add('active');
                });
            });

            // Fetch sales data and create chart
            fetch('php/sales_data/sales_data.php')
                .then(response => response.json())
                .then(data => {
                    const labels = data.map(item => item.date);
                    const values = data.map(item => item.total);

                    var ctx = document.getElementById('revenueChart').getContext('2d');
                    var revenueChart = new Chart(ctx, {
                        type: 'bar', // or 'line', 'pie', etc.
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Revenue',
                                data: values,
                                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                })
                .catch(error => {
                    console.error('Error fetching sales data:', error);
                });
        });
    </script>
</body>
</html>
