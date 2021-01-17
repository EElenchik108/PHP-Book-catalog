<div class="container" style="background:#FFFFFF">
	<h1  class="text-center"> Редактирование книги</h1>
	<div class="col-6 m-auto" style="max-width: 80%; padding: 40px;">
		<?php
			$id1 = $_GET['id'] ?? NULL;

			$db = new PDO('mysql:host=localhost; dbname=books;charset=utf8', 'root', '');
			$result = $db->query('SELECT DISTINCT category FROM books WHERE category IS NOT NULL ORDER BY category');
			$categories = $result->fetchAll(PDO::FETCH_COLUMN);
			if(isset($id1)){			
			$result2 = $db->query('SELECT name, price, category FROM books WHERE id= '.$id1.' ');
			$books = $result2->fetchAll(PDO::FETCH_ASSOC);}			
		?>

		<form action="index.php" method="POST" class="col-6  m-auto">
			<div class="form-group">
				<label for="name">Название книги:</label>
				<input type="text" id="name" name="name" class="form-control" value="<?= isset($id1) ? $books[0]["name"] : '' ?>">
			</div>
			<div class="form-group">
				<label for="price">Цена книги:</label>
				<input type="text" id="price" name="price" class="form-control"  value="<?= isset($id1) ? $books[0]["price"] : '' ?>">
			</div>
			<div class="form-group">Категория книги:</label>
			<select name="category" id="category" class="form-control">
				<?php
					foreach ($categories as $category):?> <option <?= isset($id1) ? ($books[0]["category"]==$category ? 'selected="selected"' : '') : '' ?> > <?= $category ?></option>
					<?php endforeach ?>			
			</select>
			</div>
			<input type="hidden" name="id1" value="<?= $id1 ?>">
			<button class="btn btn-primary" name="action" value="edit">Редактировать книгу</button>
		</form>

	</div>
</div>
