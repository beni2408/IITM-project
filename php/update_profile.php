<?php
header('Content-Type: application/json');
require_once '../config/mongodb.php';
require_once '../config/redis.php';

$sessionToken = $_POST['sessionToken'] ?? '';
$userId = $_POST['userId'] ?? '';
$age = $_POST['age'] ?? '';
$dob = $_POST['dob'] ?? '';
$contact = $_POST['contact'] ?? '';

if(empty($sessionToken) || empty($userId)) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

try {
    $sessionData = $redis->get($sessionToken);
    
    if(!$sessionData) {
        echo json_encode(['success' => false, 'message' => 'Session expired']);
        exit;
    }
    
    $session = json_decode($sessionData, true);
    
    if($session['userId'] != $userId) {
        echo json_encode(['success' => false, 'message' => 'Unauthorized']);
        exit;
    }
    
    $profileCollection->updateOne(
        ['userId' => (int)$userId],
        ['$set' => [
            'userId' => (int)$userId,
            'age' => $age,
            'dob' => $dob,
            'contact' => $contact,
            'updated_at' => new MongoDB\BSON\UTCDateTime()
        ]],
        ['upsert' => true]
    );
    
    echo json_encode(['success' => true, 'message' => 'Profile updated successfully']);
} catch(Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Failed to update profile']);
}
?>
