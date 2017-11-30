<?php
// Задание 1 - Выведите на экран $n раз фразу "Silence is golden".
// for
$n = 10;
for ($i = 1; $i <= $n; $i++) {
    echo 'Silence is golden.' . ' ';
}

echo '<hr />';

// Задание 2 -  Найти сумму чисел в диапазоне от 1 до 150 (включительно).
// for
for($i = 1, $j = 0; $i <= 150; $i++) {
    $j += $i;
}
echo $j;

echo '<br />';

// while
$i = 1;
$j = 0;
while ($i <= 150) {
    $j += $i;
    $i++;
}
echo $j;

echo '<hr />';

// Задание 3 - Вывести список простых чисел в диапазоне от 1 до 200 (включительно).
// for
$a = 1;
for($i = 2; $i <= 200; $i++) {
    for($j = 2; $j < $i; $j++) {
        if($i % $j == 0) {
            $a = 0;
            break;
        }
    }
    if($a) echo $i . ' ';
    $a = 1;
}

echo '<hr>';

// Задание 4 - Вывести числа в следущей последовательности: от 200 до 1.
// for
for($i = 200; $i > 0; $i--) {
    echo $i . ' ';
}

echo '<br />';

// while
$i = 200;
while ($i > 0) {
    echo $i . ' ';
    $i--;
}

echo '<br />';

// foreach
$arr = range(200, 1);
foreach ($arr as $i) {
    echo $i . ' ';
}

echo '<hr>';

// Задание 5 - С помощью цикла вывести произведение чисел от 1 до 50.
// for
for ($i = 1, $j = 1; $i <= 50; $i++) {
    $j *= $i;
}
echo $j;

echo '<br />';

// foreach
$arr = range(1, 50);
$j = 1;
foreach ($arr as $i) {
    $j *= $i;
}
echo $j;

echo '<hr>';

// Задание 6 - Вывести все числа, меньшие 1000, которые делятся без остатка одновременно на 3 и на 5.
// for
for ($i = 1; $i <= 1000; $i++) {
    if (($i % 3 == 0) && ($i % 5 == 0)){
        echo $i . ' ';
    }
}

echo '<br />';

// while
$i = 1;
while ($i <= 1000) {
    if (($i % 3 == 0) && ($i % 5 == 0)){
        echo $i . ' ';
    }
    $i++;
}

echo '<hr>';

// Задание 7 - Вывести на экран все шестизначные счастливые билеты. Билет называется счастливым, если сумма первых трех цифр в номере билета равна сумме последних трех цифр. Найдите количество счастливых билетов и процент от общего числа билетов.
$arr = range(100000, 999999);
$a = 0;
$b = 0;
foreach ($arr as $c) {
    $d = (string)$c;
    if (($d[0] + $d[1] + $d[2]) == ($d[3] + $d[4] + $d[5])) {
        echo $d . ' ';
        $a++;
    }
    $b++;
}
$e = round($a * 100 / $b, 1);
echo "<br /> Количество счастливых билетов: $a <br /> Процент от общего числа билетов: {$e}%";

echo '<hr>';

// Задание 8 -  Заполнить массив длины $n нулями и единицами, при этом данные значения чередуются начиная с нуля.
// for
$n = 30;
$arr = [];
for ($i = 0; $i <= $n; $i++) {
    if ($i % 2 == 0) {
        $arr[$i] = 0;
    } else {
        $arr[$i] = 1;
    }
}
echo '<pre>';
print_r($arr);
echo '</pre>';

echo '<br />';

// while
$n = 30;
$i = 0;
while ($i <= $n) {
    if ($i % 2 == 0) {
        $arr[$i] = 0;
    } else {
        $arr[$i] = 1;
    }
    $i++;
}
echo '<pre>';
print_r($arr);
echo '</pre>';

echo '<hr>';

// Задание 9 - Cоздать массив из $n чисел, каждый элемент которого равен квадрату своего индекса.
// for
$n = 30;
for ($i = 0; $i <= $n; $i++) {
    $arr[$i] = $i * $i;
}
echo '<pre>';
print_r($arr);
echo '</pre>';

echo '<hr>';

// Задание 10 - Даны два упорядоченных по возрастанию массива. Образовать из этих двух массивов единый упорядоченный по возрастанию массив.
$arr1 = range(1,30);
$arr2 = range(1,30);
$arr3 = array_merge($arr1, $arr2);
usort($arr3, 'strnatcmp');
echo '<pre>';
print_r($arr3);
echo '</pre>';

echo '<hr>';

// Задание 11 - Дана переменная $n - число, которое не превосходит 100000 (сто тысяч). Вывести прописью число, которое она хранит (например, 2134 - две тысячи сто тридцать четыре). Массив использовать необязательно.
error_reporting(0);
$n = 2134;
$i = strlen((string)$n);
$v = (string)$n;
$nul = 'ноль';
# массивы
$arr1 = [1 => 'один', 'два', 'три', 'четыре', 'пять', 'шесть', 'семь', 'восемь', 'девять'];
$arr2 = ['десять', 'одиннадцать', 'двенадцать', 'тринадцать', 'четырнадцать', 'пятнадцать', 'шестнадцать', 'семнадцать', 'восемнадцать', 'девятнадцать'];
$arr3 = [2 => 'двадцать', 'тридцать', 'сорок', 'пятьдесят', 'шестьдесят', 'семьдесят', 'восемьдесят', 'девяносто'];
$arr4 = [1 => 'сто', 'двести', 'триста', 'четыреста', 'пятьсот', 'шестьсот', 'семьсот', 'восемьсот', 'девятьсот'];
$arr5 = [1 => 'одна тысяча', 'две тысячи', 'три тысячи', 'четыре тысячи', 'пять тысяч', 'шесть тысяч', 'семь тысяч', 'восемь тысяч', 'девять тысяч'];
# циклы
# от 1 до 9
foreach ($arr1 as $k1 => $c1) {
    if ($k1 == substr($v, -1)) {
        $w6 = $arr1[$k1];
    }
}
# от 10 до 19
foreach ($arr2 as $k2 => $c2) {
    if ($k2 == substr($v, -1)) {
        $w5 = $arr2[$k2];
    }
}
# от 20 до 99
foreach ($arr3 as $k3 => $c3) {
    if ($k3 == substr($v, -2, 1)) {
        $w4 = "$arr3[$k3] ";
    }
}
# от 100 до 999
foreach ($arr4 as $k5 => $c5) {
    if ($k5 == substr($v,-3,1)) {
        $w3 = "$arr4[$k5] ";
    }
}
# тысячи
foreach ($arr5 as $k6 => $c6) {
    if ($k6 == substr($v,-4,1)) {
        $w2 = "$arr5[$k6] ";
    }
} foreach ($arr2 as $k7 => $c7){
    if ($k7 == substr($v,-4,1)) {
        $w1 = "$arr2[$k7] ";
    }
} foreach ($arr3 as $k8 => $c8){
    if ($k8 == substr($v,-5,1)) {
        $w0 = "$arr3[$k8] ";
    }
}
# выводы
echo "$n - ";
if ($n == 0) {
    echo $nul;
} elseif ($n == 100000) {
    echo "сто тысяч";
} if ($i == 1) {
    echo $w6;
} elseif (($i == 2) && ($v[0] == 1)) {
    echo $w5;
} elseif (($i == 2) && ($v[0] > 1)) {
    echo "$w4 " . $w6;
}

elseif (($i == 3) && (substr($v, -2,1) == 0)) {
    echo $w3 . $w6;
} elseif (($i == 3) && (substr($v,-2,1) == 1)) {
    echo $w3 . $w5;
} elseif (($i == 3) && (substr($v,-2,1) > 1)) {
    echo $w3 . $w4 . $w6;
}

elseif (($i == 4) && (substr($v, -2,1) == 0)) {
    echo $w2 . $w6;
} elseif (($i == 4) && (substr($v,-2,1) == 1)) {
    echo $w2 . $w5;
} elseif (($i == 4) && (substr($v,-2,1) > 1)) {
    echo $w2 . $w3 . $w4 . $w6;
}

elseif (($i == 5) && (substr($v, -2,1) == 0) && (substr($v,-5,1) == 1)) {
    echo $w1 . "тысяч " . $w6;
} elseif (($i == 5) && (substr($v,-2,1) == 1) && (substr($v,-5,1) == 1)) {
    echo $w1 . "тысяч " . $w5;
} elseif (($i == 5) && (substr($v,-2,1) > 1) && (substr($v,-5,1) == 1)) {
    echo $w1 . "тысяч " . $w3 . $w4 . $w6;
}

elseif (($i == 5) && (substr($v, -2,1) == 0) && (substr($v,-5,1) > 1) && (substr($v,-4,1) > 0)) {
    echo $w0 . "тысяч " . $w6;
} elseif (($i == 5) && (substr($v, -2,1) == 0) && (substr($v,-5,1) > 1)) {
    echo $w0 . $w2 . $w6;
}

elseif (($i == 5) && (substr($v,-2,1) == 1) && (substr($v,-5,1) > 1) && (substr($v,-4,1) > 0)) {
    echo $w0 . $w2 . $w5;
} elseif (($i == 5) && (substr($v,-2,1) == 1) && (substr($v,-5,1) > 1)) {
    echo $w0 . "тысяч " . $w5;
}

elseif (($i == 5) && (substr($v,-2,1) > 1) && (substr($v,-5,1) > 1) && (substr($v,-4,1) > 0)) {
    echo $w0 . $w2 . $w3 . $w4 . $w6;
}  elseif (($i == 5) && (substr($v,-2,1) > 1) && (substr($v,-5,1) > 1)) {
    echo $w0 . "тысяч " . $w3 . $w4 . $w6;
}

echo '<hr>';

// Задание 12 - Создать массив который содержит полный список букв латинского алфавита. Вывести каждую вторую букву алфавита с новой строки.
// foreach
$arr = range('A', 'Z');
$i = 1;
foreach ($arr as $k => $a) {
    if ($k == $i) {
        echo $a . '<br />';
        $i = $i + 2;
    }
}