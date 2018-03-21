<?php

namespace App\FeedManager;

interface FeedManagerInterface
{
    /**
     * Load the given feed url
     *
     * @param  string $url
     *
     * @return SimpleXmlElement
     */
    public function load($url);
}
