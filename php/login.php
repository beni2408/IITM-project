<?php
header('Content-Type: application/json');
require_once '../config/database.php';
require_once '../config/redis.php';

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if(empty($email) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'All fields are required']);
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE email = ?");
    $stmt->execute([$email]);
    
    if($stmt->rowCount() === 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid credentials']);
        exit;
    }
    
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if(!password_verify($password, $user['password'])) {
        echo json_encode(['success' => false, 'message' => 'Invalid credentials']);
        exit;
    }
    
    $sessionToken = bin2hex(random_bytes(32));
    
    $sessionData = json_encode([
        'userId' => $user['id'],
        'username' => $user['username'],
        'email' => $email,
        'timestamp' => time()
    ]);
    
    $redis->setex($sessionToken, 3600, $sessionData);
    
    echo json_encode([
        'success' => true,
        'message' => 'Login successful',
        'sessionToken' => $sessionToken,
        'userId' => $user['id']
    ]);
} catch(Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Login failed']);
}
?>
