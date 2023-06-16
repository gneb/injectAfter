<?php

require_once "./vendor/autoload.php";

$res = injectAfter(["foo" => 3, "bar" => 1, "bob" => 5, "gog" => 6], 'gog', 'foo', 7);

print_r($res);