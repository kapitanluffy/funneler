<?php

namespace App\FeedManager;

use App\FeedManager\FeedInterface;

abstract class AbstractFeed implements FeedInterface
{
    protected $url;

    protected $xml;

    protected $items;

    public function getUrl()
    {
        return $this->url;
    }

    public function items()
    {
        return $this->items;
    }

    public function getXml()
    {
        return $this->xml;
    }

    public function toArray()
    {
        $items = [];

        foreach ($this->items() as $item) {
           $items[] = $item->toArray();
        }

        return $items;
    }
}
