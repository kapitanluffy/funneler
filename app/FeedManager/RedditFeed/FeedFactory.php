<?php

namespace App\FeedManager\RedditFeed;

use App\FeedManager\RedditFeed\RedditFeed;
use App\FeedManager\BaseFeedFactory;

class FeedFactory extends BaseFeedFactory
{
    public function createFeed(\SimpleXMLElement $xml)
    {
        if (!$xml->channel) {
            $url = $xml->link[0]['href']->__toString();
            $host = parse_url($url, PHP_URL_HOST);

            if (preg_match('#reddit.com#', $host)) {
                return new RedditFeed($xml);
            }
        }

        return parent::createFeed($xml);
    }
}
