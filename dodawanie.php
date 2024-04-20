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
            <form method='post'>
                <div class="addition">
                    <input type="text" id="newNameInput" class="invisible" name="arg1" value="Nowa realizacja">
                    <button type='submit' id="additionButton1" class="invisible" name='addNew'>Dodaj</button>
                    <button id="additionButton2" onclick="toggleAddition(event)">Dodaj nową realizację</button>
                    <button id="additionButton3" class="invisible" onclick="toggleAddition(event)">Anuluj</button>
                </div>
            </form>
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
                            <button onclick='handleClick(\"changeName\",\"$file\")'>Zmień nazwę</button>
                            <button onclick='handleClick(\"delete\",\"$file\")'>Usuń</button>
                            <button onclick='handleClick(\"addFiles\",\"$file\")'>Dodaj pliki</button>
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
            <input class='invisible' id='firstArg' name='arg1' value='$file' />
            <input type='text' id="secondArg" name='arg2' value='nowe' />
            <input type="file" class='invisible' id='files' name='files'/>
            <button type='submit' id='submitButton' name='changeName'>Zmień nazwę</button>
            <button onclick='toggleOverlay()'>Anuluj</button>
        </form>
    </div>
</body>

</html>