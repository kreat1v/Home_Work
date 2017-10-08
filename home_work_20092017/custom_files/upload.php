<?php

define('DS', DIRECTORY_SEPARATOR);
$files = __DIR__.DS.'files'.DS;
define('F', $files);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $file = $_FILES['file'];
    $type = explode('/', $file['type']);
    $type = $type[0];
    $name = $file['name'];
    $dir = $file['tmp_name'];
    $size = $file['size'];

    if (fSize($size)){
        fDirectory ($type, $files, $dir, $name);
    } else {
        echo 'Ваш файл превышает допустимый размер!';
    }
}

// функция определения размера файла
function fSize ($a)
{
   if ($a > 2e+6){
       return false;
   } else {
       return true;
   }
}

// функция загрузки файла в определенную директорию
function fDirectory ($type, $files,  $dir, $name)
{
    if (!is_dir($files.$type)) {
        mkdir($files.$type);
        move_uploaded_file($dir, $files.$type.DS.$name);
    } else {
        move_uploaded_file($dir, $files.$type.DS.$name);
    }
}

?><form action="" enctype="multipart/form-data" method="post">
    <label for="file">Загрузите свой файл (не более 2mb).</label><br>
    <input type="hidden" name="MAX_FILE_SIZE" value="8000000" />
    <input type="file" name="file" id="file" style="padding: 10px 0" /><br>
    <button type="submit" style="margin-bottom: 30px;">Отправить</button><br>
    <a href="../custom_files/index.php"><< Вернуться на главную страницу</a>
</form>
