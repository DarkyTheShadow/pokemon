<?php

//database connection   
$dbhost = "mariadb";
$dbuser = "root";
$dbpass = "password";
$dbname = "pokemon_db";

try {
  $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "yippie"; 
}
catch(PDOException $e) {
    die("L + ratio + skill issue + negative hairline + no balls + " . $e->getMessage());
}