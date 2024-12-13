<?php
//if (session_status() === PHP_SESSION_NONE) {
//    session_start();
//}
//
//require_once '../includes/db.php';
//require_once '../templates/header.php';
//
//
//if (!isset($_SESSION['user_id'])) {
//    echo "<script>alert('Войдите в аккаунт.'); window.location.href = 'login.php';</script>";
//    exit;
//}
//
//$user_id = $_SESSION['user_id'];
//$stmt = $pdo->prepare("SELECT name, email FROM users WHERE id = ?");
//$stmt->execute([$user_id]);
//$user = $stmt->fetch();
//
//$stmt = $pdo->prepare("SELECT plan_name, start_date, end_date FROM subscriptions WHERE user_id = ? AND end_date >= CURDATE()");
//$stmt->execute([$user_id]);
//$subscription = $stmt->fetch();
//?>
<!--<link rel="stylesheet" href="../css/profile.css">-->
<!--<div class="container-one">-->
<!--    <h1>Ваш профиль</h1>-->
<!--    <p><strong>Имя:</strong> --><?php //= htmlspecialchars($user['name']) ?><!--</p>-->
<!--    <p><strong>Email:</strong> --><?php //= htmlspecialchars($user['email']) ?><!--</p>-->
<!---->
<!--    --><?php //if ($subscription): ?>
<!--        <h2>Активный абонемент</h2>-->
<!--        <p><strong>План:</strong> --><?php //= htmlspecialchars($subscription['plan_name']) ?><!--</p>-->
<!--        <p><strong>Дата начала:</strong> --><?php //= htmlspecialchars($subscription['start_date']) ?><!--</p>-->
<!--        <p><strong>Дата окончания:</strong> --><?php //= htmlspecialchars($subscription['end_date']) ?><!--</p>-->
<!--    --><?php //else: ?>
<!--        <p>У вас нет активного абонемента.</p>-->
<!--    --><?php //endif; ?>
<!--    <a href="buy_subscription.php">Купить абонемент</a>-->
<!--</div>-->
<!---->
<!--</body>-->
<?php //require_once '../templates/footer.php'; ?>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../includes/db.php';

// Проверка авторизации
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Вы должны войти в систему, чтобы просматривать профиль.'); window.location.href = 'login.php';</script>";
    exit;
}

$user_id = $_SESSION['user_id'];

// Получение данных пользователя
$stmt = $pdo->prepare("SELECT name, email FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

// Получение данных об абонементе
$stmt = $pdo->prepare("SELECT plan_name, end_date FROM subscriptions WHERE user_id = ? ORDER BY end_date DESC LIMIT 1");
$stmt->execute([$user_id]);
$subscription = $stmt->fetch();

require_once '../templates/header.php';
?>

<link rel="stylesheet" href="../css/profile.css">

<div class="profile-container">
    <div class="card">
        <div class="user-info">
            <h2>Информация о пользователе</h2>
            <p><strong>ФИО:</strong> <?= htmlspecialchars($user['name']) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
        </div>
        <div class="subscription-info">
            <h2>Информация об абонементе</h2>
            <?php if ($subscription): ?>
                <p><strong>Тариф:</strong> <?= htmlspecialchars($subscription['plan_name']) ?></p>
                <p><strong>Действует до:</strong> <?= htmlspecialchars($subscription['end_date']) ?></p>
            <?php else: ?>
                <p>У вас нет активного абонемента.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require_once '../templates/footer.php'; ?>
