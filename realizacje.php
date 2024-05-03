<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="css/global.css">
    <link rel="stylesheet" type="text/css" href="css/realizacje.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet">
    <title>Builder Project</title>
    <script src="scripts.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <div class="navbar">
        <div class="logo" onClick="redirectTo('/')">
            <img src="house_icon.svg">
            <span>WILLIHAUS</span>
        </div>
    </div>
    <div class="container">
    <?php
    require 'utils.php';


    $path = "zapisane/";

    $results = readFiles($path);

    foreach ($results as $result) {
        if ($result !== "." && $result !== "..") {
            echo realizationComponent($result);
        }
    }
    ?>
    </div>
</body>

</html>