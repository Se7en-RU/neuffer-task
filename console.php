<?php

declare(strict_types=1);

use App\App;
use App\ArgumentParser\ArgumentParser;
use App\DataRepository\CsvFileRepository;
use App\Logger\FileLogger;

require_once __DIR__ . '/vendor/autoload.php';

try {
    $app = new App(
        argumentParser: new ArgumentParser(),
        repository: new CsvFileRepository('result.csv'),
        logger: new FileLogger('log.txt'),
    );

    $app->run();
} catch (Throwable $throwable) {
    echo $throwable->getMessage();
}
