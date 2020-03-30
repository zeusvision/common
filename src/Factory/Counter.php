<?php

namespace Zeus\Common\Factory;

class Counter
{
    private $generator;

    private function __construct()
    {
        $this->generator = $this->generator();
    }

    public static function make()
    {
        return new self();
    }

    public static function generator()
    {
        return (function () {
            $i = 0;
            while(true) {
                yield (string) $i++;
            }
        })();
    }

    public function next()
    {
        $this->generator->next();

        return $this->generator->current();
    }

    public function current()
    {
        return $this->generator->current();
    }
}
