<?php

namespace App\QueueManager;

use App\FeedManager\FeedItemInterface;

interface QueueManagerInterface
{
    /**
     * Queues the given feed item
     *
     * @param  FeedItemInterface $item
     *
     * @return QueuedFeedItemInterface
     */
    public function queue(FeedItemInterface $item);
}
