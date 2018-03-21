<?php

namespace App\FeedManager;

interface FeedItemInterface
{
    /**
     * Get title
     *
     * @return string
     */
    public function getTitle();

    /**
     * Get content
     *
     * @return string
     */
    public function getContent();

    /**
     * Get link
     *
     * @return string
     */
    public function getLink();

    /**
     * Get xml
     *
     * @return \SimpleXmlElement
     */
    public function getXml();

    /**
     * Get assoc array
     *
     * @return array
     */
    public function toArray();
}
