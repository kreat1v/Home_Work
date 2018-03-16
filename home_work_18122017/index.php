<?php

echo '<pre>';

// 1. Дана строка содержащая HTML. Получите все ссылки в этой строке в виде массива (значение атрибутов href="" и src=""). Учтите, что названия атрибутов может быть в разных регистрах, так же может быть пробел между названием и символом =.

$str = '<div>
			<a href="http://site.com"></a>
			<a href ="http://com.ua"></a>
			<a HREF ="http://i.ua"></a>
			<script src="/scripts/browser.js"></script>
			<script src ="/scripts/index.js"></script>
			<script SRC ="/scripts/js.js"></script>
		</div>';
$result = preg_match_all('/(href|src)\s?="([^"]+)"/i', $str, $matches);
var_dump($matches[2]);

echo '<hr>';

/* 2. Дана строка содержащая переменные PHP. Оберните все переменные в HTML тег <b>
Примеры:
текст $var текст > текст <b>$var</b> текст
текст $data["key"] текст > текст <b>$data["key"]</b> текст */

function bold($str) {
	$result = preg_replace('/\s(\$[^\s]+)\s/i', ' <b>\1</b> ', $str);
	echo "Преобразованная строка: $result"."<br>";
}
bold('текст $var текст');
bold('текст $data["key"] текст');

echo '<hr>';

/* 3. Дана строка - ссылка на сайт, получить из нее домен.
Примеры:
https://site.com > site.com
http://sub.some-site.com.ua/some/page.html > sub.some-site.com.ua */

function domain($str) {
	preg_match('@^(?:https://|http://)?([^/]+)@i', $str, $matches);
	echo "Доменное имя: $matches[1]"."<br>";
}
domain('https://site.com');
domain('http://sub.some-site.com.ua/some/page.html');

echo '<hr>';

/* 4. Замените в строке двойную звездочку на !, не трогая одиночные звездочки и те, которые состоят в группе больше двух
Примеры:
** some ** message * > ! some ! message *
another *** message * > another *** message * */

function replaceStar($str) {
	$result = preg_replace('/(?<!\*)(\*{2})(?!\*)/i', "!", $str);
	echo "Преобразованная строка: $result"."<br>";
}
replaceStar('** some ** message *');
replaceStar('another *** message *');

echo '<hr>';

/* 5. Удалить идущие подряд (через пробел, 1 или больше) два и более одинаковых слова, причем так, чтобы не осталось лишних (двойных) пробелов. Считайте все слова состоящими из маленьких латинских букв.
Примеры:
we we are the the champions > we are the champions
hello hello world > hello world */

function deleteDuplicates($str) {
	$result = preg_replace('/(\b\w+\b)\s+?\1/i', '\1', $str);
	echo "Преобразованная строка: $result"."<br>";
}
deleteDuplicates('we   we are the the champions');
deleteDuplicates('hello hello world');