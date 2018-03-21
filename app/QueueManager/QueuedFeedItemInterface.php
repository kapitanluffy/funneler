<?php

namespace App\QueueManager;

interface QueuedFeedItemInterface
{
    public function getTitle();

    public function getLink();

    public function setTitle($title);

    public function setLink($link);
}
