<?php

namespace App\FeedManager;

use App\FeedManager\Feed;
use App\FeedManager\FeedFactoryInterface;

class FeedManager implements FeedManagerInterface
{
    public function __construct(FeedFactoryInterface $factory)
    {
        $this->feedFactory = $factory;
    }

    /**
     * Load the given feed url
     *
     * @param  string $url
     *
     * @return SimpleXmlElement
     */
    public function load($url)
    {
        $xml = simplexml_load_file($url);
        return $this->feedFactory->createFeed($xml);
    }
}
