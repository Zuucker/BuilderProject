<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="/css/global.css">
    <link rel="stylesheet" type="text/css" href="/css/realizacja.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet">
    <title>Builder Project</title>
    <script src="/scripts.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <div class="navbar">
        <div class="logo"  onClick="redirectTo('/')">
            <img src="/house_icon.svg">
            <span>WILLIHAUS</span>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <?php
            require 'utils.php';

            $currentURL = $_SERVER['REQUEST_URI'];

            $parts = explode("/", $currentURL);

            $argument = end($parts);

            if ($argument === "realizacja.php" || $argument === "") {
                header("Location: realizacje.php");
                exit();
            } else {
                $path = "zapisane/" . $argument . "/";

                $results = readFiles($path);

                if ($results == "" || count($results) < 3) {
                    header("Location: http://" . $_SERVER['HTTP_HOST'] . "/realizacje.php");
                    exit();
                }

                $newPath = "/" . $path . "miniatury/" . $results[2];
                $prettyName = getPrettyName($argument);

                echo "<div class='miniature'>
                        <img src='$newPath'>
                    </div>
                    <div class='title text-important'>$prettyName</div>";

                echo "</div>";
                echo "<span class='text-important'>Więcej zdjęć z tej realizacji</span>";
                echo "<div class='grid'>";

                foreach ($results as $result) {
                    if ($result !== "." && $result !== ".." && $result !== "miniatury" && $result !== $results[2]) {
                        $newPath = "/" . $path . "miniatury/" . $result;
                        $originalPath = "/" . $path . $result;
                        echo "<img src='$newPath' onclick='expandMiniature(\"$originalPath\")'>";
                    }
                }

                echo "</div>";
            }
            ?>
            
    </div>
    <div class="overlay">
        <div class="content">
            <img src="" id="preview">
            <button class="button" onclick="toggleOverlay()">Wróć</button>
        </div>
    </div>
</body>