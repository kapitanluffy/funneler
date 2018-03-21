<?php

namespace App\FeedManager\RssFeed;

use App\FeedManager\RssFeed\RssFeedItem;
use App\FeedManager\AbstractFeed;

class RssFeed extends AbstractFeed
{
    public function __construct(\SimpleXMLElement $xml)
    {
        $this->xml = $xml;
        $this->items = $this->generateFeedItems($this->xml->channel->item);
    }

    protected function generateFeedItems($items)
    {
        $feedItems = [];

        foreach ($items as $item) {
            $feedItems[] = new RssFeedItem($item);
        }

        return $feedItems;
    }
}
