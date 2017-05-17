<?php
require __DIR__ . '/vendor/autoload.php';

use MongoCli\Query\QueryParser as Parser;

echo "MongoCli v1.0\n";
echo "Write 'exit' for exit from console\n";
$config = include __DIR__.'/config/config.php';
$querySQL = '';
while (true){
    echo '>>';
    $querySQL = trim(fgets(STDIN));
    if ($querySQL == 'exit') {
        exit("bye bye\n");
    }
    if (!empty($querySQL)) {
        $application = new Parser($querySQL, $config);
    }
}
