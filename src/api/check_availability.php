<?php
require_once '../config/db.php'; 
header('Content-Type: application/json');

if (isset($_GET['doctor']) && isset($_GET['date'])) {
    $doctor = $_GET['doctor'];
    $date = $_GET['date'];

    try {
        $stmt = $pdo->prepare("SELECT appointment_time FROM appointments WHERE doctor = ? AND appointment_date = ?");
        $stmt->execute([$doctor, $date]);
        $bookedSlots = $stmt->fetchAll(PDO::FETCH_COLUMN);

        $allSlots = ["09:00", "11:00", "14:00", "16:00"];
        $availableSlots = array_diff($allSlots, $bookedSlots);

        echo json_encode([
            'availableSlots' => array_values($availableSlots),
            'fullyBooked' => count($availableSlots) === 0
        ]);
    } catch (PDOException $e) {
        echo json_encode([
            'error' => 'Server error',
            'details' => $e->getMessage()
        ]);
    }
} else {
    echo json_encode(['error' => 'Missing parameters']);
}
