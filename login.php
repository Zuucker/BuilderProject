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
  <link rel="stylesheet" type="text/css" href="css/global.css">
  <link rel="stylesheet" type="text/css" href="css/logowanie.css">
  <link rel="icon" type="image/x-icon" href="/icon.png">
  <meta name="author" content="Kamil Giec - Zuucker">
</head>

<body>
  <div class="container">
    <div class="title">
      <form action="login.php" method="post">
        <label for="username">Username:</label> 
        <input type="text" id="username" name="username"> 
        <label for="password">Password:</label>
        <input type="password" id="password" name="password"> 
        <input type="submit" class="button" value="Login">
      </form>
    </div>
  </div>

</body>

</html>