<?php

function readFiles($path)
{
    $files = scandir($path);
    return $files;
}

function getPrettyName($path)
{
    $file = fopen('data.csv', 'r');

    if ($file) {
        while (($line = fgetcsv($file)) !== false) {
            if (strcasecmp($line[1], $path) == 1 && (strlen($line[1]) - 1) == strlen($path)) {
                return $line[0];
            }
        }
        fclose($file);
    }

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
        if (strpos($line, $path) === false) {
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
    $newLine = $newLine . "\n";
    $file = fopen('data.csv', 'r+');

    file_put_contents('data.csv', $newLine, FILE_APPEND);

    fclose($file);
}


function preparePath($text)
{
    $search = array(' ', '-', 'ą', 'ć', 'ę', 'ł', 'ń', 'ó', 'ś', 'ź', 'ż', 'Ą', 'Ć', 'Ę', 'Ł', 'Ń', 'Ó', 'Ś', 'Ź', 'Ż');
    $replace = array('_', '_', 'a', 'c', 'e', 'l', 'n', 'o', 's', 'z', 'z', 'A', 'C', 'E', 'L', 'N', 'O', 'S', 'Z', 'Z');

    return str_replace($search, $replace, $text);
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

    echo "usunoł";
    deleteName($path . "," . $path . ";");
}

function createFolder($path)
{
    mkdir($path, 0777, true);
}

if (isset($_POST['changeName'])) {
    $fileName = $_POST['arg1'];
    $newFileName = $_POST['arg2'];
    $newFancyName = getPrettyName($fileName);

    changeName($newFancyName, $newFileName);
}

if (isset($_POST['addNew'])) {
    $fileName = $_POST['arg1'];
    $line = $fileName . "," . preparePath($fileName) . ";";
    echo "<p>$line</p>";

    addNewName($line);
    $fileName = "zapisane/" . preparePath($fileName) . "/miniatury";
    createFolder($fileName);
    //echo $fileName;
}

if (isset($_POST['delete'])) {
    $fileName = $_POST['arg1'];
    deleteFolder($fileName);
}



?>