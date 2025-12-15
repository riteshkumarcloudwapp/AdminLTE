<?php
$pdo = new PDO("mysql:host=127.0.0.1;dbname=adminLTE","root","");
$sql = "SELECT COLUMN_NAME FROM information_schema.COLUMNS WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME='users'";
$q = $pdo->query($sql);
$cols = $q->fetchAll(PDO::FETCH_COLUMN);
echo "users table columns:\n" . implode(", ", $cols) . "\n\n";
$r = $pdo->query("SELECT * FROM users LIMIT 5");
$rows = $r->fetchAll(PDO::FETCH_ASSOC);
foreach ($rows as $i => $row) {
    echo "Row " . ($i+1) . ":\n";
    foreach ($row as $k => $v) echo "  $k => " . ($v === null ? "(null)" : $v) . "\n";
    echo "\n";
}
