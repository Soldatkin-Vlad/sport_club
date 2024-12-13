<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../includes/db.php';
include '../templates/header.php';
?>

<link rel="stylesheet" href="../css/index.css">

<div class="container">
    <h1>Добро пожаловать в спортивный клуб!</h1>
    <p>Мы предлагаем широкий выбор занятий и доступные абонементы. Узнайте больше, зарегистрируйтесь и присоединяйтесь к нам.</p>
</div>
</body>

<?php include '../templates/footer.php'; ?>
