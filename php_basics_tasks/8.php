<?php

include ('2.php');

if (!is_numeric($age) || $age < 0) {
    echo 'Неизвестный возраст';
} elseif ($age >= 18 && $age <= 59) {
    echo 'Вам еще работать и работать';
} elseif ($age > 59) {
    echo 'Вам пора на пенсию';
} elseif ($age >= 0 && $age <= 17) {
    echo 'Вам еще рано работать';
}