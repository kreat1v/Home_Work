<?php
echo '<pre />';

// Задание 1 - Написать функцию, которая возводит число в заданную степень и возвращает его. Число передается в функцию первым аргументом, степень - вторым. По-умолчанию аргумент степени должен принимать значение 2. (Использовать встроенную в язык функцию pow нельзя).
function myPower ($n, $power = 2)
{
    $arr = array_fill(1, $power, $n);
    $n = array_product($arr);
    return $n;
}
echo myPower(5,5);

echo '<hr />';

// Задание 2 - Написать функцию, которая создает массив и заполняет его случайными числами в диапазоне, указанном пользователем. Функция должна принимать три аргумента - начало диапазона, его конец и длину требуемого массива. После генерации она должна вернуть созданный массив.
function createArray ($start, $finish, $length)
{
    for ($i = 0; $i < $length; $i++){
        $myArray[$i] = rand($start, $finish);
    }
    return $myArray;
}
print_r(createArray(10,20,15));

echo '<hr />';

// Задание 3 - Написать функцию, которая будет возвращать сумму элементов целочисленного массива, который был передан в нее первым аргуметом.
function sumArray (array $arr)
{
    $n = 0;
    foreach ($arr as $a){
        $n = $n + $a;
    }
    return $n;
}
echo sumArray([2, 10, 20]);

echo '<hr />';

// Задание 4 - Сгенерировать десять массивов из случайных чисел. Найти среди них один с максимальной суммой элементов и вывести его на экран. При решении задачи использовать две функции из двух задач выше.
$a = 0;
for ($i = 0; $i < 10; $i++){
    $arr1 = createArray(1,10,20);
    $b = sumArray($arr1);
    echo $b . '<br>';
    if ($a < $b){
        $a = $b;
        $arr2 = $arr1;
    }
}
echo "Максимальная сумма эллементов массива $a <br />";
print_r($arr2);

echo '<hr />';

// Задание 5 - Написать функцию, которая принимает один аргумент по ссылке - строку. Функция должна добавить в конец входящей строки строку functioned!. Возвращать функция ничего не должна.
function addString (& $a)
{
    $a = $a . " functioned!";
}
$b = 'Test';
addString($b);
echo $b;

echo '<hr />';

// Задание 6 - Написать функцию, которая принимает один аргумент - натуральное число n. Функция должна вывести все числа от 1 до n через пробел. Циклы или функцию range использовать нельзя.(Рекурсия)
function printN (int $n)
{
    if ($n == 1) {
        return 1;
    }
    echo printN($n - 1) . " " . $n;
}
printN (10);