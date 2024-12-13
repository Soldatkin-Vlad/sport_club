<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
} // Запускаем сессию

require_once '../includes/db.php';
require_once '../templates/header.php';
?>

<link rel="stylesheet" href="../css/staff.css">

<div class="container-one">
    <h2>Наша команда</h2>
    <div class="staff-container">
        <?php
        // Получение данных о сотрудниках из БД
        $stmt = $pdo->query("SELECT name, role, image FROM staff ORDER BY role DESC");
        $staff = $stmt->fetchAll();

        foreach ($staff as $person):
            ?>
            <div class="staff-card">
                <div class="staff-image" style="background-image: url('<?php echo $person['image']; ?>');"></div>
                <h3><?php echo htmlspecialchars($person['name']); ?></h3>
                <p><?php echo htmlspecialchars($person['role']); ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php
require_once '../templates/footer.php';
?>
