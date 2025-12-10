<?php
session_start();
header('Content-Type: application/json');

ini_set('display_errors', 0); // Hide errors from browser
ini_set('log_errors', 1);     // Log errors to server logs
error_reporting(E_ALL);



if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in.']);
    exit;
}

try {
    $pdo = new PDO('mysql:host=localhost;dbname=medibook', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];

    // Validate Full Name
    $fullname = trim($_POST['fullname']);
    if (!preg_match("/^[A-Za-z\s\-']+$/", $fullname)) {
        echo json_encode(['success' => false, 'message' => 'Full name contains invalid characters.']);
        exit;
    }
    $fullname = htmlspecialchars($fullname);

    // Validate Email
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    if (!$email) {
        echo json_encode(['success' => false, 'message' => 'Invalid email format.']);
        exit;
    }

    $gender           = trim($_POST['gender'] ?? '');
    $insurance        = trim($_POST['insurance'] ?? '');
    $visited_before   = isset($_POST['visited_before']) ? 1 : 0;
    $chronic_disease  = isset($_POST['chronic_disease']) ? 1 : 0;
    $special_needs    = isset($_POST['special_needs']) ? 1 : 0;
    $location         = trim($_POST['location'] ?? '');
    $service          = trim($_POST['service'] ?? '');
    $doctor           = trim($_POST['doctor'] ?? '');
    $appointment_date = trim($_POST['appointment_date'] ?? '');
    $appointment_time = trim($_POST['appointment_time'] ?? '');
    $message          = htmlspecialchars(trim($_POST['message']));

    // Validate required fields
    if (!$service || !$fullname || !$email || !$doctor || !$location || !$appointment_date || !$appointment_time || !$gender || !$insurance) {
        echo json_encode(['success' => false, 'message' => 'Missing required fields.']);
        exit;
    }
// Check availability
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM appointments WHERE doctor = ? AND appointment_date = ? AND appointment_time = ?");
    $stmt->execute([$doctor, $appointment_date, $appointment_time]);
    $existing = $stmt->fetchColumn();

    if ($existing > 0) {
        echo json_encode(['success' => false, 'message' => 'Selected time slot is already booked.']);
        exit;
    }

    // Prepare and execute
    $stmt = $pdo->prepare("
        INSERT INTO appointments (
            user_id, fullname, email, gender, insurance, 
            visited_before, chronic_disease, special_needs,
            service, doctor, location, 
            appointment_date, appointment_time, message  
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    $success = $stmt->execute([
        $user_id, $fullname, $email, $gender, $insurance,
        $visited_before, $chronic_disease, $special_needs,
        $service, $doctor, $location,
        $appointment_date, $appointment_time, $message
    ]);

     if ($success) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Database insertion failed.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    }

}
catch (Exception $e) {
    error_log($e->getMessage()); // Log actual error
    echo json_encode(['success' => false, 'message' => 'Server error occurred.']);
}
