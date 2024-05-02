<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="css/global.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/gallery.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet">
    <title>Builder Project</title>
    <script src="scripts.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script>
        window.addEventListener('wheel', function(e) {
             var scrollPosition = window.scrollY;

             var deltaY = e.deltaY;

             window.scrollTo({
                top: scrollPosition + window.innerHeight* (deltaY > 0 ? 1 : -1),
                behavior: 'smooth' 
            });

             e.preventDefault();
        },{passive:false});
    </script>
</head>

<body>
    <div class="navbar">
        <div class="logo" onClick="redirectTo('/')">
            <img src="house_icon.svg">
            <span>WILLIHAUS</span>
        </div>
    </div>
    <div class="container-1" id="about">
    <?php
    require 'utils.php';


    $path = "zapisane/";

    $results = readFiles($path);
    //wrócić tutaj
    
    $newPath = "/" . $path . "miniatury/" . $results[2];
    $prettyName = getPrettyName($argument);

    echo "<div class='miniature'>
                        <img src='$newPath'>
                    </div>
                    <div class='title'>$prettyName</div>";

    echo "</div>";
    echo "<div class='grid'>";

    foreach ($results as $result) {
        if ($result !== "." && $result !== ".." && $result !== "miniatury") {
            $newPath = "/" . $path . "miniatury/" . $result;
            $originalPath = "/" . $path . $result;
            echo "<img src='$newPath' onclick='expandMiniature(\"$originalPath\")'>";
        }
    }

    echo "</div>";

    ?>
    </div>
</body>

</html>