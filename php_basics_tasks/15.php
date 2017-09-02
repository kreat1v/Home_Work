<?php

$a = 88;
$b = 0;
$operator = "/";

if (($b == 0 && $operator == "/") || ($b == 0 && $operator == "%")) {
    echo 'Ошибка! На 0 делить нельзя.';
} elseif ($operator == "+") {
    echo $a + $b;
} elseif ($operator == "-") {
    echo $a - $b;
} elseif ($operator == "*") {
    echo $a * $b;
} elseif ($operator == "/") {
    echo $a / $b;
} elseif ($operator == "%") {
    echo $a % $b;
}