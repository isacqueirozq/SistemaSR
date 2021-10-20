<?php
$servername = "localhost";
$database = "SistemaSR";
$username = "id16024105_isac";
$password = "K/1it]t&iJM4~_[A";
$sql = "mysql:host=$servername;dbname=$database;";
$dsn_Options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
// Create a new connection to the MySQL database using PDO, $my_Db_Connection is an object
try {
    $conn = new PDO($sql, $username, $password, $dsn_Options);
    //echo "Connected successfully";
} catch (PDOException $error) {
    echo 'Connection error: ' . $error->getMessage();
}
?>