<?php

session_start();

if (isset($_SESSION["user_id"])) {
	$mysqli = require __DIR__ . "/database.php";

	$sql_query = "SELECT * FROM user 
				  WHERE id = {$_SESSION["user_id"]}";

	$query_result = $mysqli->query($sql_query);

	$user = $query_result->fetch_assoc();

}


?>

<!DOCTYPE html>
 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">
 	<title>Home</title>
 </head>
 <body>

 	<h1>Home</h1>

 	<?php if (isset($user)): ?>

 		<p>Hello <?= htmlspecialchars($user["name"]) ?></p>

 		<p><a href="logout.php">Log out</a></p>

 	<?php else: ?>

 		<p><a href="login.php">Log in</a> or <a href="signup.html">create account</a></p>

 	<?php endif; ?>

	 <div>
		 <ul>
			<li>Fag 1</li>
			<li>Fag 2</li>
			<li>Fag 3</li>
			<li>Fag 4</li>
		 </ul>
	 </div>
 </body>
 </html>