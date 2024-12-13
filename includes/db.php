<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=sport_club', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec('SET NAMES utf8');
} catch (PDOException $e) {
    die('Ошибка подключения к базе данных: ' . $e->getMessage());
}