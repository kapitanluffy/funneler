<?php

namespace App\QueueManager;

use App\FeedManager\FeedItemInterface;
use App\QueueManager\QueueManagerInterface;
use App\QueueManager\QueuedFeedItemInterface;

class EloquentQueueManager implements QueueManagerInterface
{
    public function __construct(QueuedFeedItemInterface $queuedItem)
    {
        $this->queuedItem = $queuedItem;
    }

    public function queue(FeedItemInterface $item)
    {
        $queuedItem = $this->queuedItem->newInstance();
        $queuedItem->setTitle($item->getTitle());
        $queuedItem->setLink($item->getLink());
        $queuedItem->save();

        return $queuedItem;
    }
}
