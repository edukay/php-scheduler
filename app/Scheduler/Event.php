<?php

namespace App\Scheduler;

use Cron\CronExpression;
use Carbon\Carbon;
use App\Scheduler\Frequencies;

abstract class Event
{
    use Frequencies;
    /**
     * The default cron expression for any new event
     * Makes the event run every minute
     */
    public $expression = '* * * * *';

    /**
     * Called to andle this event
     */
    abstract public function handle();

    /**
     * Check if the event is due to run
     *
     * @param Carbon $date
     * @return boolean
     */
    public function isDueToRun(Carbon $date)
    {
        return CronExpression::factory($this->expression)
                ->isDue($date);
    }
}