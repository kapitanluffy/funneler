<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\QueueManager\QueuedItemInterface;

class QueuedItem extends Model implements QueuedItemInterface
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
}
