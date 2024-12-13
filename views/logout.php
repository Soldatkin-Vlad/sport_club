<?php
session_start();
session_unset(); // Удаляем все переменные сессии
session_destroy(); // Уничтожаем сессию

// Переадресация на главную страницу
header('Location: index.php');
exit;
?>
