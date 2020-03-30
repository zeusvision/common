<?php

namespace Zeus\Common\Tests\Factory;

use PHPUnit\Framework\TestCase;
use Zeus\Common\Factory\AutoIncrement;

class AutoIncrementTest extends TestCase
{
    /** @test */
    function it_can_get_a_new_counter()
    {
        $counter = AutoIncrement::new();

        $this->assertEquals(0, $counter->current());

        for($i = 0; $i < 10; $i++) {
            $this->assertEquals($i + 1, $counter->next());
        }
    }

    /** @test */
    function it_can_increment_default_counter()
    {
        for($i = 0; $i < 10; $i++) {
            $this->assertEquals($i + 1, AutoIncrement::get());
        }
    }

    /** @test */
    function it_can_increment_counters_with_keys()
    {
        for($i = 0; $i < 10; $i++) {
            $this->assertEquals($i + 1, AutoIncrement::get('test_a'));
            $this->assertEquals($i + 1, AutoIncrement::get('test_b'));
        }
    }
}
