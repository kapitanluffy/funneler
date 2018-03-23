<?php

namespace App\FeedManager\RedditFeed;

use App\FeedManager\RedditFeed\RedditFeedItem;
use App\FeedManager\AtomFeed\AtomFeed;

class RedditFeed extends AtomFeed
{
    protected function generateFeedItems($items)
    {
        $feedItems = [];

        foreach ($items as $item) {
            $content = $item->content->__toString();
            $url = $item->link['href']->__toString();

            if (preg_match('#<span><a href="(.+)">\[link\]#', $content, $match)) {
                $url = $match[1];
            }

            $feedItems[] = new RedditFeedItem($item, $url);
        }

        return $feedItems;
    }
}
