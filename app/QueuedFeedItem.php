<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\QueueManager\QueuedItemInterface;

class QueuedFeedItem extends Model implements QueuedItemInterface
{
    protected $table = 'queue';

    public function getTitle()
    {
        return $this->title;
    }

    public function getLink()
    {
        return $this->link;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setLink($link)
    {
        $this->link = $link;
    }
}