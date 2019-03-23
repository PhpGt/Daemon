<?php
use \Gt\Daemon\Pool;
use \Gt\Daemon\Process;

require_once '../src/Pool.php';
require_once '../src/Process.php';

$pool = new Pool();

$pool->add("Numbers", new Process("php numbers.php"));
$pool->add("Letters", new Process("php letters.php"));
$pool->add("Ping", new Process("ping google.com"));

$pool->exec();

while($pool->numRunning() > 0){
    fwrite(STDOUT,  $pool->read());
    fwrite(STDERR, $pool->readError());
    sleep(3);
}

$pool->close();

echo ("Execution done." . PHP_EOL);