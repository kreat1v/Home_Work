<?php

$s = 120;
$t = 2;

$vkm = $s / $t;
$vkm = round ($vkm);

$vm = (1000*$s)/(3600*$t);
$vm = round ($vm);

echo "$vkm км/ч";
echo '<br />';
echo "$vm м/с";