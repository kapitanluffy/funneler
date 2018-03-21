<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FeedManager\FeedManagerInterface;
use Illuminate\Routing\ResponseFactory;

class FeedController extends Controller
{
    public function __construct(FeedManagerInterface $feedManager, ResponseFactory $response)
    {
        $this->feedManager = $feedManager;
        $this->response = $response;
    }

    public function index()
    {
        // $feed = $this->feedManager->load("http://feeds.dzone.com/home");
        $feed = $this->feedManager->load("http://www.reddit.com/r/programming/.rss");

        return $this->response->json($feed->toArray());
    }
}
