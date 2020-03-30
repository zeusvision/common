<?php

namespace Zeus\Common\Factory;

class AutoIncrement
{
    private $counters = [];
    private static $instance = null;

    public static function get($key = 'default')
    {
        $counter = self::instance()->getCounter($key);
        $counter->next();

        return $counter->current();
    }

    public static function new()
    {
        return Counter::make();
    }

    private function getCounter($key)
    {
        if (! isset($this->counters[$key])) {
            $this->counters[$key] = Counter::generator();
        }

        return $this->counters[$key];
    }

    private static function instance()
    {
        if (self::$instance === null) {
            self::$instance = new self;
        }

        return self::$instance;
    }
}
