<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\QueueManager\QueueManagerInterface;
use App\QueuedItem;

class QueueController extends Controller
{
    public function __construct(QueueManagerInterface $queueManager)
    {
        $this->queueManager = $queueManager;
    }

    public function index()
    {
        $item = new QueuedItem();
        $item->title = "title";
        $item->link = "link";

        return $this->queueManager->queue($item);
    }
}
