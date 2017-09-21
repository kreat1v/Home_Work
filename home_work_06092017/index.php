<?php

echo "<pre>";

// Задание 1 - Дана строка. Найти количество слов, начинающихся с буквы b.
$a = "There are many big and small libraries everywhere in our country. They have millions of books in different languages. You can find there the oldest and the newest books.";
$a = strtolower($a);
$b = 0;
$c = str_word_count($a);
if ($a[0] == "b") {
    $b++;
}
for ($i = 0; $i <= $c; $i++) {
    $a = strpbrk($a, " ");
    if ($a[1] == "b") {
        $b++;
    }
    $a = trim($a);
}
echo "Kоличество слов, начинающихся с буквы b: {$b}.";

echo "<hr />";

//Задание 2 - Дана строка. Подсчитать, сколько в ней букв r, k, t. Вывести результат в виде массива.
$a = "There are many big and small libraries everywhere in our country. They have millions of books in different languages. You can find there the oldest and the newest books.";
$a = strtolower($a);
$arr = [];
foreach (count_chars($a, 1) as $k => $i) {
    if (chr($k) == "r") {
        $arr["r"] = $i;
    }
    if (chr($k) == "k") {
        $arr["k"] = $i;
    }
    if (chr($k) == "t") {
        $arr["t"] = $i;
    }
}
print_r($arr);

echo "<hr />";

// Задание 3 - Дана строка. Найти длину самого короткого слова и самого длинного слова.
$a = "There are many big and small libraries everywhere in our country. They have millions of books in different languages. You can find there the oldest and the newest books.";
$a = strtolower($a);
$a = str_word_count($a, 1);
$first_element_min = $first_element_max = strlen($a[0]);
for ($i = 1; $i < count($a); $i++) {
    $int = strlen($a[$i]);
    if ($int < $first_element_min) {
        $first_element_min = $int;
    } elseif ($int > $first_element_max) {
        $first_element_max = $int;
    }
}
echo "Длинна самого короткого слова: {$first_element_min}, а самого длинного: {$first_element_max}.";

echo "<hr />";

// Задание 4 - Дана строка символов, среди которых есть одно двоеточие :. Определить, сколько символов ему предшествует.
$a = "There are many big and small libraries everywhere in our country: they have millions of books in different languages. You can find there the oldest and the newest books.";
$a = explode(":", $a);
$c = strlen($a[0]);
echo "$c - столько символов предшествует знаку \":\".";

echo "<hr />";

// Задание 5 - Дана строка. Определить, сколько раз в нее входит подстрока abc.
$a = "There are many big and small libraries everywhere in abc our country. They have millions of books in different abc languages. You can find there the oldest and the newest abc books.";
echo 'Подстрока "abc" входит в строку следующее количество раз: ' . substr_count($a, 'abc') . ".";

echo "<hr />";

// Задание 6 - Дана строка. Подсчитать, сколько уникальных символов встречается в ней. Вывести их на экран в виде массива.
$a = "There are many big and small libraries everywhere in our country.";
$a = strtolower($a);
$a = count_chars($a, 3);
print_r(str_split($a));

echo "<hr />";

// Задание 7 - Дана строка. Найти в ней те слова, которые начинаются и оканчиваются одной и той же буквой.
$a = "There are many big and small libraries everywhere in our country. They have millions of books in different languages. You can find there the oldest and the newest books. On the table near the window you can always see beautiful spring and autumn flowers.";
$a = strtolower($a);
$a = str_word_count($a, 1);
echo "Cлова, которые начинаются и оканчиваются одной и той же буквой: ";
for ($i = 1; $i < count($a); $i++) {
    $word = $a[$i];
    if ($word[0] == (substr($word, -1))) {
        echo $word . " ";
    }
}

echo "<hr />";

// Задание 8 - Дана строка. В строке заменить все двоеточия : точкой с запятой ;. Подсчитать количество замен.
$a = "There are many big and small libraries everywhere in our country: they have millions of books in different languages: you can find there the oldest and the newest books.";
str_replace(":", ";", $a, $count);
echo "Количество замен: {$count}.";

echo "<hr />";

// Задание 9 - Дана строка, содержащая буквы, целые неотрицательные числа и иные символы. Требуется все числа, которые встречаются в строке, поместить в отдельный целочисленный массив. Например, если дана строка bear 48 tail9 read13 bl0b, то в массиве должны оказаться числа 48, 9, 13 и 0.
$a = "bear 48 tail9 read13 bl0b";
$a = str_word_count($a, 1, '0123456789');
for ($i = 0; $i < count($a); $i++){
    $a[$i] = preg_replace('/[^0-9]/', '', $a[$i]);
}
$a = array_filter($a, function($el){return strlen($el) > 0;});
print_r($a);

echo "<hr />";

// Задание 10 - Дана строка. Определите, каких букв (строчных или прописных) в ней больше, и преобразуйте следующим образом: если больше прописных(больших) букв, чем строчных(маленьких), то все буквы преобразуются в прописные; если больше строчных, то все буквы преобразуются в строчные; если поровну и тех и других — текст остается без изменения.
$a = "There are many big and small libraries everywhere in our country. They have millions of books in different languages. You can find there the oldest and the newest books.";
$b = preg_replace('/[^A-Z]/', '', $a);
$c = preg_replace('/[^a-z]/', '', $a);
if ((strlen($b)) < (strlen($c))) {
    echo strtolower($a);
} elseif ((strlen($b)) > (strlen($c))) {
    echo strtoupper($a);
} else {
    echo  $a;
}

echo "<hr />";

// Задание 11 - Строка содержит одно слово. Проверить, будет ли оно читаться одинаково справа налево и слева направо (т.е. является ли оно палиндромом).
$a = "madam";
if ($a == strrev($a)) {
    echo "Слово палиндром.";
} else {
    echo "Слово не палиндром.";
}

echo "<hr />";

// Задание 12 - Дана строка, в которой слова зашифрованы — каждое из них записано наоборот. Расшифровать строку и вывести на экран.
$a = "Yreve loohcs sah a yrarbil.";
$a = strtolower($a);
$a = str_word_count($a, 1);
foreach ($a as $key => $word) {
    $a[$key] = strrev($word);
}
$a = implode($a, " ");
echo ucfirst($a) . ".";

echo "<hr />";

// Задание 13 - Дана строка, определить, каких букв в ней больше - гласных или согласных.
$a = "There are many big and small libraries everywhere in our country.";
$a = strtolower($a);
$a = count_chars($a, 1);
$i = 0;
$j = 0;
$vowels = ['a', 'e', 'i', 'o', 'u', 'y'];
foreach ($a as $key => $b) {
    $key = chr($key);
    if (($key == ' ') || ($key == '.')) {
        unset($b);
        continue;
    }
    $j = $j + $b;
    if (in_array($key, $vowels)){
        $i = $i + $b;
        $j = $j - $b;
    }
}
if ($i < $j){
    echo 'В строке больше согласных.';
} elseif ($i > $j){
    echo 'В строке больше гласных.';
} elseif ($i == $j){
    echo 'Равное количество гласных и согласных.';
}

echo "<hr />";

// Задание 14 - Дан массив строк, в котором хранятся фамилии и инициалы учеников класса (формат: Иванов И.И.). Требуется вывести массив в котором для каждого ученика указано количества его однофамильцев.
$first_form = ["Aleynikov A.V.",
    "Budnikov O.D.",
    "Gorov D.P.",
    "Ivolga A.L.",
    "Ivolga M.L.",
    "Efimec A.S.",
    "Kaymakov G.F.",
    "Krivich A.L.",
    "Mironov A.S.",
    "Mironov K.S.",
    "Ovsyannikov P.V.",
    "Polyakov S.S.",
    "Sergeeva A.D.",
    "Stroganov S.K.",
    "Fedorova O.E.",
    "Fedorova S.G.",
    "Fedorova N.G."];
$a = $first_form;
foreach ($a as $key => $b){
    $a[$key] = str_word_count($a[$key],2);
}
$b = implode($first_form, " ");
foreach ($a as $key => $c) {
    foreach ($c as $d) {
        $arr[$key] = substr_count($b, $d);
        break;
    }
}
$first_form = array_flip($first_form);
$i = 0;
foreach ($first_form as $key => $e) {
    $first_form[$key] = $arr[$i] - 1;
    $i++;
}
print_r($first_form);