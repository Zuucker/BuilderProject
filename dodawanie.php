<!DOCTYPE html>
<html>

<head>
    <title>Dodawanie realizacji</title>
    <link rel="stylesheet" type="text/css" href="css/global.css">
    <link rel="stylesheet" type="text/css" href="css/dodawanie.css">
    <link rel="icon" type="image/x-icon" href="/icon.png">
    <script src="/scripts/scripts.js"></script>
    <meta name="author" content="Kamil Giec - Zuucker">
    <?php
    require './scripts/utils.php';
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
        <div class="title text-important">Dodawanie plików
            <form method='post'>
                <div class="addition">
                    <input type="text" id="newNameInput" class="invisible" name="arg1" value="Nowa realizacja" maxlength="100">
                    <button type='submit' id="additionButton1" class="invisible" name='addNew'>Dodaj</button>
                    <button id="additionButton2" class="button" onclick="toggleAddition(event)">Dodaj nową realizację</button>
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
                    $creationTime = filectime($path . $file);
                    $date = date("d.m.Y H:i:s", $creationTime);
                    echo "<div class='record' onclick='toggleRecord(event)'>
                        <span>$name</span><span>" . countFiles($path . $file . "/") . " zdjęć </span><span>$date</span>
                        <div class='invisible'>
                            <button class='button' onclick='handleClick(\"changeName\",\"$file\")'>Zmień nazwę</button>
                            <button class='button' onclick='handleClick(\"delete\",\"$file\")'>Usuń</button>
                            <button class='button' onclick='handleClick(\"addFiles\",\"$file\")'>Dodaj pliki</button>
                        </div>
                    </div>";
                }
            }
            ?>
        </div>
        <div class="log-out button">
            <a href='logout.php'>Logout</a>
        </div>
    </div>
    <div class="overlay">
        <form method='post' enctype="multipart/form-data">
            <input class='invisible' id='firstArg' name='arg1' value='$file' />
            <input type='text' id="secondArg" name='arg2' value='new' />
            <input type="file" multiple class='invisible' accept="image/png, image/jpeg" id='files' name='files[]' />
            <button type='submit' id='submitButton' name='changeName'>Zmień nazwę</button>
            <button onclick='toggleOverlay()'>Anuluj</button>
        </form>
        <script>
            document.getElementById('files').addEventListener('change', function() {
                document.getElementById('submitButton').click();
            });
        </script>
    </div>
</body>

</html>