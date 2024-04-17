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
    if (getPrettyName($path) !== '' && getPrettyName($newPath) === '') {
        echo $path;
        rename('zapisane/' . $path, 'zapisane/' . $newPath);

        $file = fopen('data.csv', 'r+');
        $content = fread($file, filesize('data.csv'));
        rewind($file);
        fwrite($file, str_replace($path, $newPath, $content));
        fclose($file);
    }
}

function preparePath($text)
{
    $search = array(' ', '-', 'ą', 'ć', 'ę', 'ł', 'ń', 'ó', 'ś', 'ź', 'ż', 'Ą', 'Ć', 'Ę', 'Ł', 'Ń', 'Ó', 'Ś', 'Ź', 'Ż');
    $replace = array('_', '_', 'a', 'c', 'e', 'l', 'n', 'o', 's', 'z', 'z', 'A', 'C', 'E', 'L', 'N', 'O', 'S', 'Z', 'Z');

    return str_replace($search, $replace, $text);
}

function deleteFolder($path)
{

    if (substr($path, strlen($path) - 1, 1) != '/') {
        $tmp = $path .= '/';
        echo $tmp;
        //$path .= '/';
    }
    // $files = glob($path . '*', GLOB_MARK);
    // foreach ($files as $file) {
    //     if (is_dir($file)) {
    //         deleteFolder($file);
    //     } else {
    //         unlink($file);
    //     }
    // }
    // rmdir($path);

    echo "usunoł";
    changeName($path . "," . $path . ";", "");
}

if (isset($_POST['changeName'])) {
    $fileName = $_POST['arg1'];
    $newFileName = $_POST['arg2'];
    $newFileName = preparePath($newFileName);

    changeName($fileName, $newFileName);
}

if (isset($_POST['addNew'])) {
    $fileName = $_POST['arg'];
    echo "nwm";
}

if (isset($_POST['delete'])) {
    $fileName = $_POST['arg'];
    deleteFolder($fileName);
}



?>