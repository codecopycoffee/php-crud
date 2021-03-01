<?php include "header.php"; ?>

<?php

if (isset($_POST['submit'])) {
    require "../config.php";

    try  {
        $pdo = new PDO($dsn, $username, $password, $options);

				$luggage = $_POST['luggage'];
	      $category = $_POST['category'];
        $item = $_POST['item'];
        $description = $_POST['description'];

        $sql = "INSERT INTO stuff (luggage, category, item, description)
				 				VALUES (:luggage, :category, :item, :description)";

        $statement = $pdo->prepare($sql);
				$statement->bindValue(':luggage', $luggage);
				$statement->bindValue(':category', $category);
				$statement->bindValue(':item', $item);
				$statement->bindValue(':description', $description);
        $statement->execute();
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

?>

<h1>Add An Item</h1>

<form method="post">
	<label for="luggage">luggage</label>
	<select name="luggage" id="luggage">
		<option value="" disabled selected>choose luggage...</option>
	  <option value="suitcase">suitcase</option>
	  <option value="carryon">carry-On</option>
	  <option value="ship">ship</option>
	  <option value="auxiliary">auxiliary</option>
	</select>

	<label for="category">category</label>
	<select name="category" id="category">
		<option value="" disabled selected>choose category...</option>
	  <option value="clothes">clothes</option>
	  <option value="shoes">shoes</option>
	  <option value="electronics">electronics</option>
	  <option value="selfcare">self care</option>
	  <option value="miscellaneous">miscellaneous</option>
	</select>

	<label for="item">item</label>
	<input type="text" name="item" id="item">

	<label for="description">description</label>
	<input type="text" name="description" id="description">

	<input type="submit" name="submit" value="submit">
</form>

<?php include "footer.php"; ?>
