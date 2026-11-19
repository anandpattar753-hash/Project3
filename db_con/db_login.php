<?php
// show errors during development so blank pages are visible
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if (!isset($_POST['login'])) {
    header('Location: /lawyermanagementsystem/login.php?deactivate');
    exit;
}

require __DIR__ . '/dbCon.php';
$con = connect();

$email = strtolower(trim($_POST['email'] ?? ''));
$password = trim($_POST['password'] ?? $_POST['passord'] ?? '');

if ($email === '' || $password === '') {
    header('Location: /lawyermanagementsystem/login.php?deactivate');
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: /lawyermanagementsystem/login.php?error');
    exit;
}

$stmt = $con->prepare(
    "SELECT u.*, lawyer.lawyer_id, client.client_id, administrator.administrator_id
     FROM `user` AS u
     LEFT JOIN lawyer ON u.u_id = lawyer.lawyer_id
     LEFT JOIN client ON u.u_id = client.client_id
     LEFT JOIN administrator ON u.u_id = administrator.administrator_id
     WHERE LOWER(TRIM(u.email)) = ?
     LIMIT 1"
);

if (!$stmt) {
    error_log('Login prepare error: ' . $con->error);
    header('Location: /lawyermanagementsystem/login.php?error');
    exit;
}

$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();
$row = $result ? $result->fetch_assoc() : null;
$stmt->close();

if (!$row) {
    header('Location: /lawyermanagementsystem/login.php?error');
    exit;
}

$storedPassword = trim($row['password']);
$passwordMatch = false;

if (password_verify($password, $storedPassword)) {
    $passwordMatch = true;
} elseif ($password === $storedPassword) {
    $passwordMatch = true;
}

if (!$passwordMatch) {
    header('Location: /lawyermanagementsystem/login.php?error');
    exit;
}

// Auto-upgrade plain-text or legacy passwords to modern bcrypt hashes upon successful login
if (password_needs_rehash($storedPassword, PASSWORD_DEFAULT)) {
    $newHash = password_hash($password, PASSWORD_DEFAULT);
    $updateStmt = $con->prepare("UPDATE `user` SET `password` = ? WHERE `u_id` = ?");
    if ($updateStmt) {
        $updateStmt->bind_param('ss', $newHash, $row['u_id']);
        $updateStmt->execute();
        $updateStmt->close();
    }
}

if ($row['role'] === 'Lawyer' || $row['role'] === 'User') {
    if ($row['status'] !== 'Active') {
        header('Location: /lawyermanagementsystem/login.php?pending');
        exit;
    }
}

session_regenerate_id(true);
$_SESSION['login'] = true;
$_SESSION['email'] = $row['email'];
$_SESSION['first_Name'] = $row['first_Name'];
$_SESSION['last_Name'] = $row['last_Name'];
$_SESSION['status'] = $row['status'];

if ($row['role'] === 'Lawyer') {
    $_SESSION['lawyer_id'] = $row['lawyer_id'];
    header('Location: /lawyermanagementsystem/lawyer_dashboard.php?done');
    exit;
}

if ($row['role'] === 'User') {
    $_SESSION['client_id'] = $row['client_id'];
    header('Location: /lawyermanagementsystem/user_dashboard.php?done');
    exit;
}

if ($row['role'] === 'Admin') {
    header('Location: /lawyermanagementsystem/admin_dashboard.php?done');
    exit;
}

header('Location: /lawyermanagementsystem/login.php?error');
exit;
?>