<?php
session_start();
header('Content-Type: application/json');
require_once '../config/db.php';

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Not logged in']);
    exit;
}

$user_id = $_SESSION['user_id'];

try {
    // Select upcoming appointments for this user (today or later)
    $stmt = $pdo->prepare("SELECT service, doctor, location, appointment_date, appointment_time 
                           FROM appointments 
                           WHERE user_id = ? AND appointment_date >= CURDATE()
                           ORDER BY appointment_date, appointment_time");
    $stmt->execute([$user_id]);
    $appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($appointments);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error', 'details' => $e->getMessage()]);
}
?>
