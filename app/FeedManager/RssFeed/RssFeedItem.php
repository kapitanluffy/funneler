<?php

namespace App\FeedManager\RssFeed;

use App\FeedManager\FeedItemInterface;

class RssFeedItem implements \JsonSerializable, FeedItemInterface
{
    protected $xml;

    public function __construct(\SimpleXMLElement $item)
    {
        $this->xml = $item;
    }

    public function getTitle()
    {
        return $this->xml->title->__toString();
    }

    public function getContent()
    {
        return $this->xml->description->__toString();
    }

    public function getLink()
    {
        return $this->xml->link->__toString();
    }

    public function getTimestamp()
    {
        return strtotime($this->xml->pubDate);
    }

    public function getXml()
    {
        return $this->xml;
    }

    public function jsonSerialize()
    {
        return [
            'title' => $this->getTitle(),
            'content' => $this->getContent(),
            'link' => $this->getLink(),
            'timestamp' => $this->getTimestamp()
        ];
    }

    public function toArray()
    {
        return $this->jsonSerialize();
    }
}
