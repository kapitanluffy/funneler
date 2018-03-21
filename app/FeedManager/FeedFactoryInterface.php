<?php

namespace App\FeedManager;

interface FeedFactoryInterface
{
    /**
     * Create a FeedInterface from provided xml object
     *
     * @param  \SimpleXMLElement $xml
     *
     * @return FeedInterface
     */
    public function createFeed(\SimpleXMLElement $xml);
}
