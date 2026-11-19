<?php
include("db_con/dbCon.php");
$conn = connect();

$res = mysqli_query($conn, "SELECT u_id, first_Name, last_Name, email, password, status, role FROM user");
echo "=== USER TABLE ===\n";
while ($row = mysqli_fetch_assoc($res)) {
    echo "ID: [{$row['u_id']}] | Name: [{$row['first_Name']} {$row['last_Name']}] | Email: [{$row['email']}] | Pwd: [{$row['password']}] | Role: [{$row['role']}] | Status: [{$row['status']}]\n";
}

$res2 = mysqli_query($conn, "SELECT lawyer_id, speciality, practise_Length, city FROM lawyer");
echo "\n=== LAWYER TABLE ===\n";
while ($row = mysqli_fetch_assoc($res2)) {
    echo "ID: [{$row['lawyer_id']}] | Speciality: [{$row['speciality']}] | Exp: [{$row['practise_Length']}] | City: [{$row['city']}]\n";
}
?>
