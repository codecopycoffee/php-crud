<?php include "header.php"; ?>

<?php

/**
  * List all users with a link to edit
  */

try {
  require "../config.php";

  $connection = new PDO($dsn, $username, $password, $options);

  $sql = "SELECT * FROM stuff ORDER BY luggage";

  $statement = $connection->prepare($sql);
  $statement->execute();

  $result = $statement->fetchAll();
} catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
}
?>

<h2>Edit Items</h2>

<table>
  <thead>
    <tr>
      <th>id</th>
      <th>luggage</th>
      <th>category</th>
      <th>item</th>
      <th>description</th>
    </tr>
  </thead>
    <tbody>

    <?php
			foreach ($result as $row) { ?>

			<tr>
				<td><?php echo $row["id"]; ?></td>
				<td><?php echo $row["luggage"]; ?></td>
				<td><?php echo $row["category"]; ?></td>
				<td><?php echo $row["item"]; ?></td>
				<td><?php echo $row["description"]; ?></td>
				<td><a href="update-single.php?id=<?php echo $row["id"]; ?>">Edit</a></td>
			</tr>
			<?php } ?>

    </tbody>
</table>

<!-- Delete Functionality -->

<?php
if (isset($_POST['delete'])) {
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
?>

<?php include "footer.php"; ?>
