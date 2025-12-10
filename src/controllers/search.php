<?php
header('Content-Type: application/json');

require_once '../config/db.php';

if (!isset($_GET['q'])) {
    echo json_encode(['error' => 'Missing query']);
    exit;
}

$q = trim($_GET['q']);
if (strlen($q) < 2) {
    echo json_encode([]);
    exit;
}

try {
    // Search doctors
    $stmt = $pdo->prepare("SELECT * FROM doctors WHERE name LIKE ?");
    $stmt->execute(["%$q%"]);
    $doctors = $stmt->fetchAll();

    // If no doctors found by name, search services
    if (count($doctors) === 0) {
        $stmt = $pdo->prepare("
            SELECT d.* FROM services s
            JOIN doctors d ON s.doctor_id = d.id
            WHERE s.name LIKE ?
        ");
        $stmt->execute(["%$q%"]);
        $doctors = $stmt->fetchAll();
    }

    // Add services to each doctor
    foreach ($doctors as &$doc) {
        $stmt = $pdo->prepare("SELECT name FROM services WHERE doctor_id = ?");
        $stmt->execute([$doc['id']]);
        $doc['services'] = array_column($stmt->fetchAll(), 'name');
    }

    echo json_encode($doctors);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Server error: ' . $e->getMessage()]);
}

