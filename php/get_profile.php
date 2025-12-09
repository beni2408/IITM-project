<?php
header('Content-Type: application/json');
require_once '../config/database.php';
require_once '../config/mongodb.php';
require_once '../config/redis.php';

$sessionToken = $_POST['sessionToken'] ?? '';
$userId = $_POST['userId'] ?? '';

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
    
    $stmt = $pdo->prepare("SELECT username, email FROM users WHERE id = ?");
    $stmt->execute([$userId]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $profile = $profileCollection->findOne(['userId' => (int)$userId]);
    
    $data = [
        'username' => $user['username'],
        'email' => $user['email'],
        'age' => $profile['age'] ?? '',
        'dob' => $profile['dob'] ?? '',
        'contact' => $profile['contact'] ?? ''
    ];
    
    echo json_encode(['success' => true, 'data' => $data]);
} catch(Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Failed to fetch profile']);
}
?>
