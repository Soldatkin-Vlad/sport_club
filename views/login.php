<?php require_once '../includes/db.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Проверка пользователя в БД
    $stmt = $pdo->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['id'] = $user['id'];
        echo "<script>alert('Вход успешен!'); window.location.href = 'profile.php';</script>";
    } else {
        echo "<script>alert('Неверные данные для входа.');</script>";
    }
}

require_once '../templates/header.php'; ?>

<link rel="stylesheet" href="../css/login.css">

<div class="form-container">
    <h2>Вход</h2>
    <form action="login.php" method="POST">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" class="input-field" required>

        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password" class="input-field" required>

        <button type="submit" class="btn">Войти</button>
        <p>Нет аккаунта? <a href="register.php">Регистрация</a></p>
    </form>
</div>

<?php require_once '../templates/footer.php'; ?>
