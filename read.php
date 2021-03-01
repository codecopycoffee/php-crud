<?php include "header.php"; ?>

<?php

if (isset($_POST['submit'])) {
  try {
    require "../config.php";

		if (isset($_POST['category'])) {
			$pdo = new PDO($dsn, $username, $password, $options);

			$category = $_POST['category'];

	    $sql = "SELECT * FROM `stuff` WHERE `category` = :category";

			$statement = $pdo->prepare($sql);
			$statement->bindValue(':category', $category);
			$statement->execute();

			$result = $statement->fetchAll();
			
		} elseif (isset($_POST['luggage'])) {
			$pdo = new PDO($dsn, $username, $password, $options);

			$luggage = $_POST['luggage'];

			$sql = "SELECT * FROM `stuff` WHERE `luggage` = :luggage";

			$statement = $pdo->prepare($sql);
			$statement->bindValue(':luggage', $luggage);
			$statement->execute();

			$result = $statement->fetchAll();
		}

  } catch(PDOException $error) {
    echo "<br>" . $error->getMessage();
  }
}

?>

<?php

	if (isset($_POST['submit'])) {
	  if ($result && $statement->rowCount() > 0) { ?>
	  	<h2>Results</h2>

			<table>
				<thead>
					<tr>
					  <th>id</th>
					  <th>Luggage</th>
					  <th>Category</th>
					  <th>Item</th>
					  <th>Description</th>
					</tr>
			  </thead>
			  <tbody>
			  	<?php foreach ($result as $row) { ?>
			    <tr>
						<td><?php echo $row["id"]; ?></td>
						<td><?php echo $row["luggage"]; ?></td>
						<td><?php echo $row["category"]; ?></td>
						<td><?php echo $row["item"]; ?></td>
						<td><?php echo $row["description"]; ?></td>
			    </tr>
			  	<?php } ?>
			  </tbody>
			</table>

	  <?php } else {
	    echo "No results found";
	   }
	} ?>

	<h2>View Items by Luggage</h2>

	<form method="post">
		<label for="luggage">Luggage</label>
		<select name="luggage" id="luggage">
			<option value="" disabled selected>Choose luggage...</option>
		  <option value="suitcase">Suitcase</option>
		  <option value="carryon">Carry-On</option>
		  <option value="ship">Ship</option>
		  <option value="auxiliary">Auxiliary</option>
		</select>

		<input type="submit" name="submit" value="View Results">
	</form>

<h2>View Items by Category</h2>

<form method="post">
	<label for="category">Category</label>
	<select name="category" id="category">
		<option value="" disabled selected>Choose category...</option>
		<option value="clothes">Clothes</option>
		<option value="shoes">Shoes</option>
		<option value="electronics">Electronics</option>
		<option value="selfcare">Self Care</option>
		<option value="miscellaneous">Miscellaneous</option>
	</select>

	<input type="submit" name="submit" value="View Results">
</form>

<?php include "footer.php"; ?>
