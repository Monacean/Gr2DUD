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

<?php 
$conn = mysqli_connect('localhost','root','Vw279^ZT%@8nFPrG','datasikkerhet');
 
if(!$conn)
{
	die(mysqli_error());
}
 
if(isset($_POST['submit']))
{
	$textareaValue = trim($_POST["message"]);
	
	$sql = "insert into textarea_value (textarea_message) values ('".$textareaValue."')";
	$rs = mysqli_query($conn, $sql);
	$affectedRows = mysqli_affected_rows($conn);
	
	if($affectedRows == 1)
	{
		$successMsg = "Record has been saved successfully";
	}
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
 		<p></p>
 		<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
 			<p>From: <?= htmlspecialchars($user["name"]) ?></p>
 			<textarea id="message" placeholder="Type your message here.." rows="5" cols="35" required></textarea>
 			<input type="submit" value="submit">
 		</form>

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