<?php

namespace App\Scheduler;

use App\Scheduler\Event;
use Carbon\Carbon;

class Kernel
{
    /**
     * Holds all the declared events
     */
    protected $events = [];

    /**
     * Holds the current date that an event is checked against
     * to determine if it should be run or not.
     */
    protected $date;

    /**
     * Get all the set events.
     * @return $events
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * Add an event to the events array.
     * The event must be an instance of Event::class
     *
     * @return Event $event
     */
    public function add(Event $event)
    {
        $this->events[] = $event;

        return $event;
    }

    /**
     * Set the kernel date variable
     * The date must be a Carbon::class instance
     */
    public function setDate(Carbon $date)
    {
        $this->date = $date;
    }

    /**
     * Get the kernel date
     *
     * @return Carbon $date
     */
    public function getDate()
    {
        return $this->date ?: Carbon::now();
    }

    /**
     * Called to iterate through all the events in the kernel
     * and call the handle method on each event
     */
    public function run()
    {
        foreach($this->getEvents() as $event) {
            if (!$event->isDueToRun($this->getDate())) {
                continue;
            }

            $event->handle();
        }
    }
}