<?php
$env = parse_ini_file(__DIR__ . '/.env');
$pdo = new PDO(
    'mysql:host=' . $env['DB_HOST'] . ';port=' . $env['DB_PORT'] . ';dbname=' . $env['DB_NAME'] . ';charset=utf8mb4',
    $env['DB_USERNAME'],
    $env['DB_PASSWORD']
);

$tables = $pdo->query('SHOW TABLES')->fetchAll(PDO::FETCH_COLUMN);
$userTable = in_array('user', $tables, true) ? 'user' : (in_array('users', $tables, true) ? 'users' : null);
if ($userTable === null) {
    throw new RuntimeException('No user table found');
}

$username = 'copilotuser001';
$email = 'copilotuser001@example.com';
$passwordHash = password_hash('Password123', PASSWORD_DEFAULT);

$stmt = $pdo->prepare(
    'INSERT INTO `' . $userTable . '` (`firstname`, `lastname`, `username`, `email`, `password`, `role`, `is_active`) ' .
    'VALUES (:firstname, :lastname, :username, :email, :password, :role, :is_active) ' .
    'ON DUPLICATE KEY UPDATE `username` = VALUES(`username`), `email` = VALUES(`email`)'
);

$result = $stmt->execute([
    ':firstname' => '',
    ':lastname' => '',
    ':username' => $username,
    ':email' => $email,
    ':password' => $passwordHash,
    ':role' => 'user',
    ':is_active' => 1,
]);

if (!$result) {
    throw new RuntimeException('Insert failed');
}

echo "created_user:$username:$email:$userTable\n";
