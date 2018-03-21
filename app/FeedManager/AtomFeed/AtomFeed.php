<?php

namespace App\FeedManager\AtomFeed;

use App\FeedManager\AtomFeed\AtomFeedItem;
use App\FeedManager\AbstractFeed;

class AtomFeed extends AbstractFeed
{
    public function __construct(\SimpleXMLElement $xml)
    {
        $this->xml = $xml;
        $this->items = $this->generateFeedItems($this->xml->entry);
    }

    protected function generateFeedItems($items)
    {
        $feedItems = [];

        foreach ($items as $item) {
            $feedItems[] = new AtomFeedItem($item);
        }

        return $feedItems;
    }
}
