<?php

namespace App\QueueManager;

interface QueuedItemInterface
{
    public function getTitle();

    public function getLink();
}
