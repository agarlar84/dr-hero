<?php

namespace DrHero\Doctor;

class Collection implements \Countable
{
    private $collection;

    public function __construct(...$items)
    {
        $this->collection = $items;
    }

    public function count()
    {
        return count($this->collection);
    }
}
