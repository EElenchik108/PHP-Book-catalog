<div class="container" style="background:#FFFFFF">
	<h1  class="text-center"> Добавление новой книги</h1>
	<div class="col-6 m-auto" style="max-width: 80%; padding: 40px;">
		<?php 
			$db = new PDO('mysql:host=localhost; dbname=books;charset=utf8', 'root', '');
			$result = $db->query('SELECT DISTINCT category FROM books WHERE category IS NOT NULL ORDER BY category');
			$categories = $result->fetchAll(PDO::FETCH_COLUMN);			
		?>

		<form action="index.php" method="POST" class="col-6  m-auto">
			<div class="form-group">
				<label for="name">Название книги:</label>
				<input type="text" id="name" name="name" class="form-control">
			</div>
			<div class="form-group">
				<label for="price">Цена книги:</label>
				<input type="text" id="price" name="price" class="form-control">
			</div>
			<div class="form-group">
			<label class="form-group">Категория книги:</label>
			<select name="category" id="category" class="form-control">
				<?php
					foreach ($categories as $category):?> 
						<option> <?= $category ?></option>
					<?php endforeach ?>				
			</select>
			</div>
			<button class="btn btn-primary" name="action" value="add">Добавить книгу</button>		
		</form>	

	</div>
</div>
