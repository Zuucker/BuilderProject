<!DOCTYPE html>
<html>

<head>
    <title>Dodawanie realizacji</title>
    <link rel="stylesheet" type="text/css" href="css/dodawanie.css">
    <script src="scripts.js"></script>
    <?php
    require 'utils.php';
    ?>
</head>

<body>
    <?php
    session_start();

    if (!isset($_SESSION["username"])) {
        header("Location: login.php");
        exit;
    } ?>

    <div class="container">
        <div class="title">Dodawanie plików
        </div>
        <div class="control-panel">
            <?php

            $path = "zapisane/";

            foreach (readFiles($path) as $file) {
                if (is_dir($path . "/" . $file) && !($file == "." || $file == "..")) {
                    $name = getPrettyName($file);
                    echo "<div class='record' onclick='toggleRecord(event)'>
                        $name
                        <div class='invisible'>
                            <input class='invisible' id='fileName' value='$file'>
                            <button onclick='handleClick(\"changeName\")'>Zmień nazwę</button>
                            <button onclick='handleClick(\"delete\")'>Usuń</button>
                        </div>
                    </div>";
                }
            }
            ?>
        </div>
        <div class="log-out">
            <a href='logout.php'>Logout</a>
        </div>
    </div>
    <div class="overlay">
        <form method='post'>
            <input class='invisible' id='newFileName' name='arg1' value='$file' />
            <input type='text' id="secondArg" name='arg2' value='nowe' />
            <button type='submit' id='submitButton' name='changeName'>Zmień nazwę</button>
            <button onclick='toggleOverlay()'>Anuluj</button>
        </form>
    </div>
</body>

</html>