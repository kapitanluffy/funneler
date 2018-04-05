<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FeedManager\FeedManagerInterface;
use Illuminate\Routing\ResponseFactory;
use App\FeedManager\FeedItem;
use App\Jobs;

class FeedController extends Controller
{
    public function __construct(
        FeedManagerInterface $feedManager,
        Request $request,
        ResponseFactory $response
    ) {
        $this->feedManager = $feedManager;
        $this->request = $request;
        $this->response = $response;
    }

    public function index()
    {
        // $feed = $this->feedManager->load("http://feeds.dzone.com/home");
        $feed = $this->feedManager->load("http://www.reddit.com/r/programming/.rss");
        // $feed = $this->feedManager->load("https://www.theregister.co.uk/science/geeks_guide/headlines.atom");

        return $this->response->json($feed->toArray());
    }

    public function queue()
    {
        $link = $this->request->get('link');
        $message = $this->request->get('message');

        $job = new Jobs\PostToFacebook($message, $link);

        dispatch($job);

        return $this->response->json(['message' => 'Item queued']);
    }
}
