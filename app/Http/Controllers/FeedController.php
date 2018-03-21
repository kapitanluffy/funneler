<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FeedManager\FeedManagerInterface;
use Illuminate\Routing\ResponseFactory;
use App\QueueManager\QueueManagerInterface;
use App\FeedManager\FeedItem;

class FeedController extends Controller
{
    public function __construct(
        FeedManagerInterface $feedManager,
        QueueManagerInterface $queue,
        Request $request,
        ResponseFactory $response
    ) {
        $this->feedManager = $feedManager;
        $this->queue = $queue;
        $this->request = $request;
        $this->response = $response;
    }

    public function index()
    {
        // $feed = $this->feedManager->load("http://feeds.dzone.com/home");
        $feed = $this->feedManager->load("http://www.reddit.com/r/programming/.rss");

        return $this->response->json($feed->toArray());
    }

    public function queue()
    {
        $link = $this->request->get('link');
        $title = $this->request->get('title');

        $item = new FeedItem(['link' => $link, 'title' => $title]);

        $queuedItem = $this->queue->queue($item);

        return $this->response->json($queuedItem);
    }
}
