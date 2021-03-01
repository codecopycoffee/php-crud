<?php

if (isset($_POST['submit'])) {
    require "../config.php";
    echo "set";

    try  {
        $connection = new PDO($dsn, $username, $password, $options);
        
        $new_item = array(
            "luggage" => $_POST['luggage'],
            "category" => $_POST['category'],
            "item" => $_POST['item'],
            "description" => $_POST['description']
        );

        $sql = sprintf(
                "INSERT INTO %s (%s) values (%s)",
                "users",
                implode(", ", array_keys($new_item)),
                ":" . implode(", :", array_keys($new_item))
        );
        
        $statement = $connection->prepare($sql);
        $statement->execute($new_item);
        echo "Success";
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
} else {
	echo "not set";
}