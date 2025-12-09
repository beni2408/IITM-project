<?php
header('Content-Type: application/json');
require_once '../config/redis.php';

$sessionToken = $_POST['sessionToken'] ?? '';

if(!empty($sessionToken)) {
    $redis->del($sessionToken);
}

echo json_encode(['success' => true, 'message' => 'Logged out successfully']);
?>
