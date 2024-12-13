<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
} // Запускаем сессию

require_once '../includes/db.php';
require_once '../templates/header.php';

?>

    <link rel="stylesheet" href="../css/trainings.css">

    <div class="container-one">
        <h2>Наши тренировки</h2>
        <div class="cards-container">
            <?php
            // Получение данных о тренировках из БД
            $stmt = $pdo->query("SELECT id, title, image, description FROM trainings");
            $trainings = $stmt->fetchAll();

            foreach ($trainings as $training):
                ?>
                <div class="card" onclick="openTrainingModal('<?php echo htmlspecialchars($training['title'], ENT_QUOTES); ?>',
                        '<?php echo htmlspecialchars($training['description'], ENT_QUOTES); ?>', '<?php echo $training['image']; ?>')">
                    <div class="image" style="background-image: url('<?php echo $training['image']; ?>');"></div>
                    <div class="text">
                        <h3><?php echo htmlspecialchars($training['title']); ?></h3>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div id="trainingModal" class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeTrainingModal()">&times;</span>
            <img id="modalImage" src="" alt="Тренировка">
            <h3 id="modalTitle"></h3>
            <p id="modalDescription"></p>
        </div>
    </div>

    <script src="../js/trainings.js"></script>
<?php
require_once '../templates/footer.php';
?>