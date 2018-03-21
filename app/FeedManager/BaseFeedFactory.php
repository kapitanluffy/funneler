<?php

namespace App\FeedManager;

use App\FeedManager\RssFeed\RssFeed;
use App\FeedManager\AtomFeed\AtomFeed;
use App\FeedManager\FeedFactoryInterface;

class BaseFeedFactory implements FeedFactoryInterface
{
    public function createFeed(\SimpleXMLElement $xml)
    {
        if ($xml->channel) {
            return new RssFeed($xml);
        } else {
            return new AtomFeed($xml);
        }
    }
}
