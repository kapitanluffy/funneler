<?php

namespace App\FeedManager;

interface FeedInterface
{
    /**
     * Array of feed items
     *
     * @return array[FeedItemInterface]
     */
    public function items();

    /**
     * Get feed url
     *
     * @return string
     */
    public function getUrl();

    /**
     * Get xml
     *
     * @return \SimpleXmlElement
     */
    public function getXml();
}
