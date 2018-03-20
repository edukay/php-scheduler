<?php

use PHPUnit\Framework\TestCase;
use App\Scheduler\Event;
use App\Scheduler\Kernel;
use Carbon\Carbon;

class KernelTest extends TestCase
{
    /** @test */
    function can_get_list_of_events()
    {
        $kernel = new Kernel;

        $this->assertEquals([], $kernel->getEvents());
    }

    /** @test */
    function can_add_events()
    {
        $event = $this->getMockForAbstractClass(Event::class);

        $kernel = new Kernel;
        $kernel->add($event);

        $this->assertCount(1, $kernel->getEvents());
    }

    /** @test */
    function cant_add_non_events()
    {
        $this->expectException(TypeError::class);
        $kernel = new Kernel;
        $kernel->add('non event');
    }

    /** @test */
    function can_set_date()
    {
        $kernel = new Kernel;
        $kernel->setDate(Carbon::now());

        $this->assertInstanceOf(Carbon::class, $kernel->getDate());
    }

    /** @test */
    function has_default_set_date()
    {
        $kernel = new Kernel;

        $this->assertInstanceOf(Carbon::class, $kernel->getDate());
    }

    /** @test */
    function adding_event_returns_an_event()
    {
        $event = $this->getMockForAbstractClass(Event::class);

        $kernel = new Kernel;
        $result = $kernel->add($event);

        $this->assertInstanceOf(Event::class, $result);
    }

    /** @test */
    function runs_expected_event()
    {
        $event = $this->getMockForAbstractClass(Event::class);
        $event->expects($this->once())->method('handle');

        $kernel = new Kernel;
        $kernel->add($event);

        $kernel->run();
    }

    /** @test */
    function doesnt_run_unexpected_event()
    {
        $event = $this->getMockForAbstractClass(Event::class);
        $event->monthly();

        $event->expects($this->never())->method('handle');

        $kernel = new Kernel;
        $kernel->setDate(Carbon::create(2018, 2, 2, 0, 0, 0));

        $kernel->add($event);

        $kernel->run();
    }
}