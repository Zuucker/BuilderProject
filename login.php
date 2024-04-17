<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST["username"];
  $password = $_POST["password"];

  $file_path = 'config.ini';
  $config = parse_ini_file($file_path);

  if ($username === $config['login'] && $password === $config['password']) {
    $_SESSION["username"] = $username;
    header("Location: dodawanie.php");
    exit;
  } else {
    header("Location: login.php");
    exit;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
</head>

<body>
  <h2>Login</h2>
  <form action="login.php" method="post">
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username"><br>
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password"><br><br>
    <input type="submit" value="Login">
  </form>

</body>

</html>