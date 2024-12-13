<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$name, $email, $password]);

    echo "<script>alert('Регистрация успешна!'); window.location.href = 'login.php';</script>";
}

require_once '../templates/header.php'; ?>

<link rel="stylesheet" href="../css/register.css">

<div class="form-container">
    <h2>Регистрация</h2>
    <form action="register.php" method="POST">
        <label for="name">Имя:</label>
        <input type="text" id="name" name="name" class="input-field" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" class="input-field" required>

        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password" class="input-field" required>

        <button type="submit">Зарегистрироваться</button>
        <p>Уже есть аккаунт? <a href="login.php">Войти</a></p>
    </form>
</div>

<!--<body>-->
<!--<form action="register.php" method="POST" class="form-container">-->
<!--    <h2>Регистрация</h2>-->
<!--    <label for="name">ФИО:</label>-->
<!--    <input type="text" name="name" id="name" required>-->
<!--    <label for="email">Email:</label>-->
<!--    <input type="email" name="email" id="email" required>-->
<!--    <label for="password">Пароль:</label>-->
<!--    <input type="password" name="password" id="password" required>-->
<!--    <button type="submit">Зарегистрироваться</button>-->
<!--    <p>Уже есть аккаунт? <a href="login.php">Войти</a></p>-->
<!--</form>-->
<!--</body>-->
<?php require_once '../templates/footer.php'; ?>
