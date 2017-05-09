<?php
require __DIR__ . '/vendor/autoload.php';
use MongoCli\Query\QueryParser as Parser;
$querySQL = trim(fgets(STDIN));
$application = new Parser($querySQL);
