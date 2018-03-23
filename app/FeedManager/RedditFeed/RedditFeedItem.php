<?php

namespace App\FeedManager\RedditFeed;

use App\FeedManager\AtomFeed\AtomFeedItem;

class RedditFeedItem extends AtomFeedItem
{
    protected $link;

    public function __construct(\SimpleXMLElement $item, $link)
    {
        $this->link = $link;
        parent::__construct($item);
    }

    public function getLink()
    {
        return $this->link;
    }
}
