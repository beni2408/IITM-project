<?php
class FakeRedis {
    private $dir;
    
    public function __construct() {
        $this->dir = __DIR__ . '/../sessions';
        if (!is_dir($this->dir)) mkdir($this->dir, 0777, true);
    }
    
    public function setex($key, $ttl, $value) {
        file_put_contents($this->dir . '/' . $key, $value);
    }
    
    public function get($key) {
        $file = $this->dir . '/' . $key;
        return file_exists($file) ? file_get_contents($file) : false;
    }
    
    public function del($key) {
        $file = $this->dir . '/' . $key;
        if (file_exists($file)) unlink($file);
    }
}

$redis = new FakeRedis();
?>
