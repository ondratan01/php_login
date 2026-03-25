<?php
$Name = $_POST['name'];
$Psw = $_POST['psw'];
echo $Name;

$dsn = "mysql:host=localhost;dbname=dbaze;charset=utf8";

$username = "admin";
$psw = "admin";
$users = "users";


$conn = new PDO($dsn, $username, $psw);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
echo "Connected successfully";

$sql = "INSERT INTO users (name, Password) VALUES (:name, :psw)";

$stmt = $conn->prepare($sql);

$stmt->execute([':name' => $Name, ':psw' => $Psw]);


$sql = "SELECT name FROM users WHERE name = :name"; 
$stmt = $conn->prepare($sql);
$stmt->execute([':name' => $Name]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row) {
    echo "uuh.. první uživatel email je: " . $row['name'];
} else {
    echo "Nenašel se žádný uživatel s tímto ID.";
}




?>