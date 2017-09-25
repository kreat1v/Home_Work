<?php

//error_reporting(0);

// наши файлы
$commentsFile = __DIR__.'/comments.txt';
$censoredFile = __DIR__.'/censored.txt';

// массив со всем содержимым
$comments = unserialize(file_get_contents($commentsFile));

// слова, которые мы фильтруем
$censored = explode(PHP_EOL, file_get_contents($censoredFile));

// основная логика
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // убираем теги из полей ввода, если они были
    $author = htmlspecialchars($_POST['author']);
    $email = htmlspecialchars($_POST['email']);
    $message = strip_tags($_POST['message']);

    // проверяем, заполнены ли поля формы
    if (strlen($author) && strlen($email) && strlen($message)){

        //проверяем уникальность email
        if (emailFilter($comments, $email)){

            // проверяем, есть ли запрещенные слова в форме
            if (badwordFilter($censored, $author) || badwordFilter($censored, $message)){
                echo "<div class=\"errors\">Избавь нас от скверных слов!</div>";
            } else {

                // сохраняем данные из формы
                $comments[] = [
                    'author' => $_POST['author'],
                    'email' => $_POST['email'],
                    'message' => $_POST['message'],
                    'datetime' => date('d.m.Y <br /> H:i'),
                    'timestamp' => time(),
                ];

                // сохраняем всё в файл
                file_put_contents($commentsFile, serialize($comments));

                // стриаем данные из формы
                unset($_POST['author']);
                unset($_POST['email']);
                unset($_POST['message']);
            }
        } else {
            echo "<div class=\"errors\">Пользователь с таким мылом уже существует! Введи другое.</div>";
        }

    } else {
        echo "<div class=\"errors\">Заполни все поля формы!</div>";
    }
}

// функция для определения уникальности email
function emailFilter($comments, $email)
{
    foreach ($comments as $key => $a){
        if ($comments[$key]['email'] == $email) {
            return false;
        }
    }
    return true;
}

// функция определения запрещенных слов
function badwordFilter($censored, $str)
{
    foreach ($censored as $a){
        if (stripos($str, $a) !== false){
            return true;
        }
    }
    return false;
}

// сортировка комментариев в обратном порядке
usort($comments, function ($a, $b){
    return $a['timestamp'] && $a['timestamp'] > $b['timestamp'] ? -1 : 1;
});

// переменные для пагинации
$count = 5;
$len = count($comments) / $count;
if (is_float($len)){
    $len = (int)$len + 1;
}
$p = isset($_GET["p"]) ? (int) $_GET["p"] : 1;

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Твой отзыв</title>
</head>
<body>

<main>

    <div class="h1">
        <div class="first_h "><p>ОСТАВЬ</p></div>
        <div class="second_h"><p>СВОЙ</p></div>
        <div class="third_h"><p>ОТЗЫВ</p></div>
    </div>

    <div class="wrapper">
        <div class="my_form">
            <form method="post">
                <input type="text" name="author" placeholder="Введи своё имя" value="<?php echo isset($_POST['author']) ? $_POST['author'] : ''; ?>" class="my_form_style" />
                <input type="email" name="email" placeholder="Введи свой e-mail" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" class="my_form_style" />
                <textarea name="message" cols="30" rows="10" placeholder="Введи свой комментарий"  class="my_form_style"><?php
                    echo isset($_POST['message']) ? $_POST['message'] : '';
                    ?></textarea>
                <input type="submit" name="submit" value="ОТПРАВИТЬ" class="my_form_style button" />
            </form>
        </div>

        <div class="comment_wrapper">
            <?php
            for ($i = $p * $count - $count; $i <= $p * $count - 1; $i++):
                if (isset($comments[$i])) {
                    ?>
                    <div class="comment_body">
                        <div class="comment_author"><?= $comments[$i]['author'] ?></div>
                        <div class="comment_time"><?= $comments[$i]['datetime'] ?></div>
                        <div class="comment_message"><?= $comments[$i]['message'] ?></div>
                        <div class="comment_email"><?= $comments[$i]['email'] ?></div>
                    </div>
                    <?php
                }
            endfor; ?>
        </div>

    </div>
</main>

<footer>
    <nav>
        <div class="pagination">
            <?php for($i = 1; $i <= $len; $i++): ?>
                <a href="?p=<?= $i ?>" class="a<?= $i ?>"><?= $i?></a>
            <?php endfor; ?>
        </div>
    </nav>
    <div class="all_right">
        <p>2017 - All right reserved</p>
    </div>
</footer>

</body>
</html>