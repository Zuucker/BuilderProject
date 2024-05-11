<?php

function readFiles($path)
{
    $files = scandir($path);
    return $files;
}

function countFiles($path)
{
    $files = readFiles($path);
    $count = 0;

    foreach ($files as $file) {
        if (is_file($path . "/" . $file)) {
            $count++;
        }
    }
    return $count;
}

function getPrettyName($path)
{
    $file = fopen('data.csv', 'r');

    if ($file) {
        while (($line = fgetcsv($file)) !== false) {
            if ($line[0] === $path) {
                fclose($file);
                return substr($line[1], 0, -1);
            }
        }
    }

    fclose($file);
    return '';
}

function changeName($path, $newPath)
{
    $oldLine = $path . "," . preparePath($path) . ";";
    $newLine = $newPath . "," . preparePath($newPath) . ";";

    //print ("$oldLine|$newLine");

    $file = fopen('data.csv', 'r+');
    if ($file) {
        $content = fread($file, filesize('data.csv'));
        rewind($file);
        fwrite($file, str_replace($oldLine, $newLine, $content));
        rename('zapisane/' . preparePath($path), 'zapisane/' . preparePath($newPath));
        fclose($file);
    }
}

function deleteName($path)
{
    $file = fopen('data.csv', 'r+');
    $newContent = [];

    while (($line = fgets($file)) !== false) {
        $value = explode(",", $line)[1];
        $savedPath = substr($value, 0, strlen($value) - 2);

        if (!($savedPath === $path && strlen($savedPath) === strlen($path))) {
            $newContent[] = $line;
        }
    }

    rewind($file);

    fwrite($file, implode('', $newContent));

    ftruncate($file, ftell($file));

    fclose($file);
}

function addNewName($newLine)
{
    $newLine = "\n" . $newLine;
    $file = fopen('data.csv', 'r+');

    file_put_contents('data.csv', $newLine, FILE_APPEND);

    fclose($file);
}


function preparePath($text)
{
    $data = file('data.csv');
    $lastRow = array_pop($data);
    $lastLine = str_getcsv($lastRow);

    $index = intval($lastLine[0]) + 1;

    return sprintf("%04d", $index);
}

function deleteFolder($path)
{
    $files = glob('zapisane/' . $path . '/*');

    $filesInside = glob('zapisane/' . $path . '/miniatury/' . '*');

    foreach ($filesInside as $fileInside) {
        if (is_file($fileInside)) {
            unlink($fileInside);
        }
    }

    rmdir('zapisane/' . $path . '/miniatury');

    foreach ($files as $file) {
        if (is_file($file)) {
            unlink($file);
        }
    }

    rmdir('zapisane/' . $path);

    deleteName($path);
}

function createFolder($path)
{
    mkdir($path, 0777, true);
}

function resizeImage($filename, $newWidth, $newHeight)
{
    $image = null;

    if (strpos($filename, ".png") !== false) {
        $image = imagecreatefrompng($filename);
        $imgResized = imagescale($image, $newWidth, $newHeight);
        imagepng($imgResized, $filename);
    } else if (strpos($filename, ".jpg") !== false || strpos($filename, ".jpeg") !== false) {
        $image = imagecreatefromjpeg($filename);
        $imgResized = imagescale($image, $newWidth, $newHeight);
        imagejpeg($imgResized, $filename);
    }

    if ($image === null) {
        return null;
    }
}

if (isset($_POST['changeName'])) {
    $fileName = $_POST['arg1'];
    $newFileName = $_POST['arg2'];
    $newFancyName = getPrettyName($fileName);

    changeName($newFancyName, $newFileName);
}

if (isset($_POST['addNew'])) {
    $realizationName = $_POST['arg1'];
    $index = preparePath($realizationName);
    $line = $index . "," . $realizationName . ";";

    addNewName($line);
    $fileName = "zapisane/" . $index . "/miniatury";
    createFolder($fileName);
}

if (isset($_POST['delete'])) {
    $path = $_POST['arg1'];
    deleteFolder($path);
}

if (isset($_POST['upload'])) {

    $path = $_POST['arg1'];
    $uploadedFiles = $_FILES['files'];

    $file_path = 'config.ini';
    $config = parse_ini_file($file_path);

    foreach ($uploadedFiles['name'] as $key => $fileName) {

        $tmpFilePath = $uploadedFiles['tmp_name'][$key];

        if ($tmpFilePath != "") {
            $uploadDirectory = "zapisane/" . $path . "/";

            $newName = time();
            $newName = md5($newName) . ".png";

            $targetFilePath = $uploadDirectory . $newName;
            $miniatureTargetFilePath = $uploadDirectory . "miniatury/" . $newName;

            move_uploaded_file($tmpFilePath, $targetFilePath);

            list($width, $height, $type) = getimagesize($targetFilePath);

            $thumb = imagecreatetruecolor($config['newWidth'], $config['newHeight']);
            $source = imagecreatefromjpeg($targetFilePath);

            imagecopyresized($thumb, $source, 0, 0, 0, 0, $config['newWidth'], $config['newHeight'], $width, $height);
            imagepng($thumb, $miniatureTargetFilePath);
        }
    }
}

function realizationComponent($path)
{
    $name = getPrettyName($path);
    $images = readFiles("zapisane/" . $path . "/miniatury/");

    if ($images == '' || count($images) < 3 || $name === '') {
        return '';
    }

    $imagePath = "/zapisane/" . $path . "/miniatury/" . $images[2];
    return "<div class='realization' onclick='redirectTo(\"realizacja.php/$path\")'>
                <img src='$imagePath'>
                <span>$name</span>
            </div>";
}

?>