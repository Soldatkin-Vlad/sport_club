<?php
function checkRegularStatus($pdo, $userId) {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM subscriptions WHERE user_id = ? AND DATEDIFF(end_date, start_date) >= 365");
    $stmt->execute([$userId]);
    $totalYears = $stmt->fetchColumn();

    if ($totalYears >= 1) {
        $stmt = $pdo->prepare("UPDATE users SET is_regular = 1 WHERE id = ?");
        $stmt->execute([$userId]);
        return true;
    }
    return false;
}
?>
