<?php

namespace App\QueueManager;

use App\QueueManager\QueuedItemInterface;

interface QueueManagerInterface
{
    public function queue(QueuedItemInterface $item);
}
