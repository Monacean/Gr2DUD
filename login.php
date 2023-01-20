 <?php


    $is_invalid = false;

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $mysqli = require  __DIR__ . "/database.php";

    $sql_query = sprintf("SELECT * FROM user
                  WHERE email = '%s'",
                  $mysqli->real_escape_string($_POST["email"]));

    $query_result = $mysqli->query($sql_query);

    $user = $query_result->fetch_assoc();

    // hvis email finnes, sjekk passord 
    if ($user) {

        if (password_verify($_POST["password"], $user["password_hash"])) {

            session_start();

            session_regenerate_id();

            $_SESSION["user_id"] = $user["id"];

            header("Location: index.php");
            exit;
        }
    }

    // om email eller passord er invalid
    $is_invalid = true;

}

?>

<!DOCTYPE html>
 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">
 	<title>Login</title>
 </head>
 <body>

 	<h1>Login</h1>

    <?php if ($is_invalid):?>
        <p style="color: indianred; font-size:80%;">invalid login</p>
    <?php endif; ?>

    <form method="post">
        <label for="email">email</label>
        <input type="email" name="email" id="email" value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">

        <label for="password">password</label>
        <input type="password" name="password" id="password">
    
        <button>Log in</button>
    </form>

    <p>New user? - <a href="signup.html">create account.</a></p>

</body>
</html>
