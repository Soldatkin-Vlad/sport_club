<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../includes/db.php';

// Проверка авторизации пользователя
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Вы должны войти в систему, чтобы купить абонемент.'); window.location.href = 'login.php';</script>";
    exit;
}

$user_id = $_SESSION['user_id'];

// Обработка формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $plan_name = $_POST['plan_name'];
    $duration_in_months = intval($_POST['duration']);

    $start_date = date('Y-m-d');

    $stmt = $pdo->prepare("SELECT end_date FROM subscriptions WHERE user_id = ? ORDER BY end_date DESC LIMIT 1");
    $stmt->execute([$user_id]);
    $current_subscription = $stmt->fetch();

    if ($current_subscription && strtotime($current_subscription['end_date']) >= strtotime($start_date)) {
        $start_date = $current_subscription['end_date'];
    }

    $end_date = date('Y-m-d', strtotime("+$duration_in_months months", strtotime($start_date)));

    $stmt = $pdo->prepare("INSERT INTO subscriptions (user_id, plan_name, start_date, end_date) VALUES (?, ?, ?, ?)");
    $stmt->execute([$user_id, $plan_name, $start_date, $end_date]);

    echo "<script>alert('Абонемент успешно оформлен!'); window.location.href = 'profile.php';</script>";
}

require_once '../templates/header.php';
?>

<link rel="stylesheet" href="../css/buy_subscription.css">

<div class="container-one">
    <h2>Выберите абонемент</h2>
    <div class="cards-container">
        <div class="card">
            <div class="image" style="background-image: url('../images/month1.jpg');"></div>
            <div class="text">
                <h3>1 месяц</h3>
                <p>1500 рублей</p>
                <form method="POST" action="buy_subscription.php">
                    <input type="hidden" name="plan_name" value="1 месяц">
                    <input type="hidden" name="duration" value="1">
                    <button type="submit">Купить</button>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="image" style="background-image: url('../images/month3.jpg');"></div>
            <div class="text">
                <h3>3 месяца</h3>
                <p>4000 рублей</p>
                <form method="POST" action="buy_subscription.php">
                    <input type="hidden" name="plan_name" value="3 месяца">
                    <input type="hidden" name="duration" value="3">
                    <button type="submit">Купить</button>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="image" style="background-image: url('../images/months6.png');"></div>
            <div class="text">
                <h3>6 месяцев</h3>
                <p>7500 рублей</p>
                <form method="POST" action="buy_subscription.php">
                    <input type="hidden" name="plan_name" value="6 месяцев">
                    <input type="hidden" name="duration" value="6">
                    <button type="submit">Купить</button>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="image" style="background-image: url('../images/month12.jpg');"></div>
            <div class="text">
                <h3>1 год</h3>
                <p>13000 рублей</p>
                <form method="POST" action="buy_subscription.php">
                    <input type="hidden" name="plan_name" value="1 год">
                    <input type="hidden" name="duration" value="12">
                    <button type="submit">Купить</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once '../templates/footer.php'; ?>
