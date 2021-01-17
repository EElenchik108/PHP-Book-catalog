<?php
	session_start();
	$page =  $_GET['page'] ?? 'home';
	$menu = require_once'menu.php';	
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	<title>Book catalog</title>
</head>
<body style="background:#F5F5F5">
	<div class="container" style="background:#FFFFFF">	
		<div class="col-6 m-auto" style="max-width: 180vw; padding: 20px;">
			<ul class="nav nav-tabs">
				<?php
		    	foreach ($menu as $link =>$text):
		    	?>    
		    	<li class="nav-item">
		    		<a class="nav-link <?= $page==$link ? 'active' : null ?>" href="index.php?page=<?= $link ?>"> <?= $text ?></a>
		  		</li>
		  		<?php endforeach ?>
			</ul>	
		</div>
	</div>		

	<?php 	
		if(file_exists("pages/{$page}.php")) {
		require_once "pages/{$page}.php";
		}
		else {
			echo "<p>Pages not found</p>";
		}			
	?>	

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>	
</body>
</html>

