<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="/css/global.css">
    <link rel="stylesheet" type="text/css" href="/css/realizacja.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="/icon.png">
    <title>Builder Project</title>
    <script src="/scripts/scripts.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Kamil Giec - Zuucker">
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
            require './scripts/utils.php';

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

                echo "</div>";
                echo "<span class='text-important'>$prettyName</span>";
                echo "<div class='grid'>";

                foreach ($results as $result) {
                    if ($result !== "." && $result !== ".." && $result !== "miniatury") {
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
            <span class="text-important" id="previewCounter"></span>
            <img src="" id="preview" onclick="handleOverlayChange(event)">
            <button class="button" onclick="toggleOverlay()">Wróć</button>
        </div>
        <script>
            document.addEventListener('keydown', (event)=>{
                event.preventDefault();
                handleOverlayChange(event);
            });
            
            document.addEventListener('touchstart', handleTouchStart, false);
            document.addEventListener('touchend', handleTouchEnd, false);
        </script>
    </div>
</body>