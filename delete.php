<?php

/**
  * List all users with a link to delete
	* - Currently not in use -
  */

require "header.php";
require "../config.php";

	if (isset($_GET['id'])) {
		try {
			$pdo = new PDO($dsn, $username, $password, $options);
			$id = $_GET['id'];

			$sql = "DELETE FROM stuff WHERE id = :id";
			$stmt = $pdo->prepare($sql);
			$stmt->bindValue(':id', $id);
			$stmt->execute();

		} catch(PDOException $error) {
			echo $error->getMessage();
		}

	}

try {
  require "../config.php";

  $connection = new PDO($dsn, $username, $password, $options);

  $sql = "SELECT * FROM stuff";

  $statement = $connection->prepare($sql);
  $statement->execute();

  $result = $statement->fetchAll();
} catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
}

?>

<h2>Delete stuff</h2>

<table>
  <thead>
    <tr>
      <th>id</th>
      <th>Luggage</th>
      <th>Category</th>
      <th>Item</th>
      <th>Description</th>
			<th>Delete</th>
    </tr>
  </thead>
    <tbody>
    <?php foreach ($result as $row) : ?>
      <tr>
        <td><?php echo $row["id"]; ?></td>
        <td><?php echo $row["luggage"]; ?></td>
        <td><?php echo $row["category"]; ?></td>
        <td><?php echo $row["item"]; ?></td>
        <td><?php echo $row["description"]; ?></td>
				<td><a href="delete.php?id=<?php echo $row["id"]; ?>">Delete</a></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php include "footer.php"; ?>
