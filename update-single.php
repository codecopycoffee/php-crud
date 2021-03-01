<?php

/**
  * Edit a single item
	* - Currently not in use -
  */

require "header.php";
require "../config.php";

if (isset($_POST['submit'])) {
	try {
		$pdo = new PDO($dsn, $username, $password, $options);

		$id = $_GET['id'];
		$luggage = $_POST['luggage'];
		$category = $_POST['category'];
		$item = $_POST['item'];
		$description = $_POST['description'];

		$sql = "UPDATE stuff
			SET luggage = :luggage,
			category = :category,
			item = :item,
			description = :description
			WHERE id = :id
			";

			$statement = $pdo->prepare($sql);
			$statement->bindValue(':id', $id);
			$statement->bindValue(':luggage', $luggage);
			$statement->bindValue(':category', $category);
			$statement->bindValue(':item', $item);
			$statement->bindValue(':description', $description);
			$statement->execute();

	} catch(PDOException $error) {
		echo $error->getMessage();
	}
}

if (isset($_GET['id'])) {
	try {
		$pdo = new PDO($dsn, $username, $password, $options);
		$id = $_GET['id'];

		$sql = "SELECT * FROM stuff WHERE id = :id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();

		$item = $stmt->fetch(PDO::FETCH_ASSOC);

	} catch(PDOException $error) {
		echo $error->getMessage();
	}

} else {
	echo "Something has gone awry.";
	exit;
}

if (isset($_POST['submit']) && $statement) {
	echo "BOOM updated";
}

?>

<h2>Edit Single Item</h2>

<form method="post">

	<?php foreach ($item as $key => $value) : ?>
		<label for="<?php echo $key; ?>">
			<?php echo ucfirst($key); ?>
		</label>
		<input type="text"
			name="<?php echo $key; ?>"
			id="<?php echo $key; ?>"
			value="<?php echo $value; ?>"
			<?php echo ($key === 'id' ? 'readonly' : null); ?>>
	<?php endforeach; ?>

	<input type="submit" name="submit" value="Submit">

</form>

<?php include "footer.php"; ?>
