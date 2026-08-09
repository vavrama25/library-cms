<?php

function customHash($pass, $email) {

$shaHash = hash('sha512', $pass);

$preWhirlpool = $shaHash . $email;

$whirlpoolHash = hash("whirlpool", $preWhirlpool);

$hash =  mb_substr($whirlpoolHash, 5, null, 'UTF-8');

return $hash;
}


?>