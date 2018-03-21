<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FeedManager\FeedManagerInterface;

class FeedController extends Controller
{
    public function __construct(FeedManagerInterface $feedManager)
    {
        $this->feedManager = $feedManager;
    }

    public function index()
    {
        $feed = $this->feedManager->load("http://feeds.dzone.com/home");
        return $feed->asXml();
    }
}
