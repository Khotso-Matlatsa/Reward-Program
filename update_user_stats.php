<?php
requireAdmin();

function updateUserStats($userId, $field, $amount = 1) {
    global $conn;

    $allowed = [
        'clicks',
        'invitations',
        'completed_tasks',
        'total_rewards',
        'referrals',
        'surveys_done'
    ];

    if (!in_array($field, $allowed)) {
        return false;
    }

    $stmt = $conn->prepare("
        UPDATE user_stats
        SET $field = $field + ?
        WHERE user_id = ?
    ");
    $stmt->bind_param("di", $amount, $userId);
    return $stmt->execute();
}
