<div class="container" style="background:#FFFFFF">
	<h1  class="text-center"> Главная страница </h1>
	<div class="col-6 m-auto" style="max-width: 80%; padding: 40px;">
		<h2  class="text-center"> Каталог </h2>
		<?php 
				
			//Подключение базы данных:
			
			$db = new PDO('mysql:host=localhost; dbname=books;charset=utf8', 'root', '');

			$action = $_POST['action'] ?? null;
			if($action) { $action(); }
			
			function add() {
				global $db;
				
				//1 Способ

				/*$name = $db->quote($_POST['name'] ?? null); quote - экранирует строку
				$price = $_POST['price'] ?? null;
				$category = $_POST['category'] ?? null;
				$sql = "INSERT INTO books(name, price, category) VALUES ($name, $price, $category)";
				$db->query($sql);*/

				//2 Способ

				$name = $_POST['name'] ?? null;
				$price = $_POST['price'] ?? null;
				$category = $_POST['category'] ?? null;

				$sth = $db->prepare("INSERT INTO books(name, price, category) VALUES (?, ?, ?)");
				$sth->execute([$name, $price, $category]);			
			}

			function deleteBook() {
				global $db;
				$id = $_POST['id'] ?? null;
				$sth = $db->prepare("DELETE FROM books WHERE id=?");
				$sth->execute([$id]);
			}
			
			function edit() {
				global $db;
				$id1 = $_POST['id1'] ?? null;
				$name = $_POST['name'] ?? null;
				$price = $_POST['price'] ?? null;
				$category = $_POST['category'] ?? null;

				$sth2 = $db->prepare("UPDATE books SET name='$name' , price=$price, category='$category'  WHERE id =$id1");	
				$sth2->execute([$name, $price, $category]);						
			}

			$result = $db->query('SELECT name, price, category, id FROM books WHERE category IS NOT NULL ORDER BY id DESC LIMIT 0, 10');
			$books = $result->fetchAll(PDO::FETCH_ASSOC);	

			echo '<table class="table table-striped"><tr style="color:#095FFD; text-align: center"><th  scope="col" >Name</th><th  scope="col">Price</th><th>Category</th><th></th></tr>';		
			foreach ($books as $book) {
				echo "<tr>";
				echo "<td>".$book['name']."</td>";
				echo "<td>".$book['price']."</td>";
				echo "<td>".$book['category']."</td>";
			?>
			<td>
				<a href="index.php?page=editBook&id=<?= $book['id'] ?>" metod="POST" class="btn btn-warning" style="width: 70px; margin-bottom: 5px">Edit</a>

				<form action="index.php" method="POST">
					<input type="hidden" name="id" value="<?= $book['id'] ?>">
					<button class="btn btn-danger" name="action" value="deleteBook">Delete</button>
				</form>
			</td>
			<?
				echo "</tr>";
			}
			echo "</table>";
		?>
	</div>
</div>