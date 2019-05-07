<?php

namespace App;

class App
{
    const CONFIG_PATH = __DIR__ . '/config/config.php';
    public $db;
    public $assetsPath;
    public $basePath;
    
    public function __construct()
    {
        $config = include self::CONFIG_PATH;
        $this->basePath = realpath(__DIR__);
        $this->assetsPath = $config['assets_path'];
        $this->db = new \PDO($config['db']['dsn'], $config['db']['username'], $config['db']['password']);
    }
}