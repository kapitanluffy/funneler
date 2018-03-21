<?php

namespace App\QueueManager;

use App\QueueManager\QueuedItemInterface;
use App\QueueManager\QueueManagerInterface;
use App\QueuedItem;

class EloquentQueueManager implements QueueManagerInterface
{
    public function __construct(QueuedItem $queuedItem)
    {
        $this->queuedItem = $queuedItem;
    }

    public function queue(QueuedItemInterface $item)
    {
        $queuedItem = $this->queuedItem->newInstance();
        $queuedItem->title = $item->getTitle();
        $queuedItem->link = $item->getLink();
        $queuedItem->save();

        return $queuedItem;
    }
}
