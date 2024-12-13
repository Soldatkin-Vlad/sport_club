<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
} // Запускаем сессию
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ferum Cyber Club</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
<header class="main-header">
    <div class="container">
        <h1 class="logo" ><a href="../views/index.php">Ferum Cyber Club</a></h1>
        <nav class="main-nav">
            <ul>
                <li><a href="../views/index.php">Главная</a></li>
                <li><a href="../views/buy_subscription.php">Абонементы</a></li>
                <li><a href="../views/trainings.php">Тренировки</a></li>
                <li><a href="../views/staff.php">Команда</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="../views/profile.php">Профиль</a></li>
                    <li><a href="../views/logout.php">Выйти</a></li>
                <?php else: ?>
                    <li><a href="../views/login.php">Вход</a></li>
                    <li><a href="../views/register.php">Регистрация</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>

