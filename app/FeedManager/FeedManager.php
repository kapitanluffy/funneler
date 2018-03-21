<?php

namespace App\FeedManager;

class FeedManager implements FeedManagerInterface
{
    public function __construct()
    {

    }

    /**
     * Load the given feed url
     *
     * @param  string $url
     *
     * @return SimpleXmlElement
     */
    public function load($url)
    {
        return simplexml_load_file($url);
    }
}
