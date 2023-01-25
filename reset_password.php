<!DOCTYPE html>
<html>
<head>
    <title>Forgot your password</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <h1>Password reset</h1>
    
    <form method="post" action="reset_request.php">
        <p>Please provide your email address.</p>
        <label for="email">email</label>
        <input type="text" name="email" placeholder="Enter your e-mail address...">
        
        <br>
        <button type="submit" name="reset-request-submit">Submit</button>
    </form>
    <?php
        if (isset($_GET["reset"])) {
            if ($_GET["reset"] == "success") {
                echo '<p class="signupsuccess">Check your e-mail!</p>';
            }
        }
    ?>
    
</body>
</html>