<?php
$config = [
    'db' => [
        'host' => 'localhost',
        'username' => 'root',
        'dbname' => 'Stud',
        'password' => ''
    ]
];

$dbh = new PDO("mysql:host=" . $config['db']['host'] . ";dbname=" . $config['db']['dbname'],
    $config['db']['username'], $config['db']['password']
);