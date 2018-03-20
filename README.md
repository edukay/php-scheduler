# php-scheduler

## A php scheduler for scheduling events and running them using cron jobs.

### Add an event inside the app\Events directory and add it to the scheduler.php file. Be sure to include when the event will be run.

### The times for the event can be set using functions such as
* at($hour, $minute)
* daily()
* monthly()
* weekends()
* weekdays()
* days(1,2,3)


### They can also be chained on like:
* daily()->at(12, 30)
* monthly()->days(1,2)
* monthly()->at(10, 45)


### for understanding cron syntax, you can test your cron expressions at [crontab.guru][1]

[1]: http://www.crontab.guru
