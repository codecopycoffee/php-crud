<?php

require "config.php";

try {
  $pdo = new PDO("mysql:host=$host", $username, $password, $options);
  $sql = file_get_contents("data/init.sql");
  $pdo->exec($sql);
    
  echo "Database and table users created successfully.";
} catch(PDOException $error) {

  echo $error->getMessage();
}