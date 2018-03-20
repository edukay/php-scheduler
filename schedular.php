<?php

use App\Events\SomeEvent;
use App\Scheduler\Kernel;

require_once 'vendor/autoload.php';

$kernel = new Kernel;
$kernel->setDate(Carbon\Carbon::create(2018, 2, 1, 0, 0, 0));

$kernel->add(new SomeEvent())->monthly();

$kernel->run();
