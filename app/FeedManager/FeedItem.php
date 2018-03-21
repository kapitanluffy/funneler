<?php

namespace App\FeedManager;

use App\FeedManager\FeedItemInterface;

class FeedItem implements \JsonSerializable, FeedItemInterface
{
    public function __construct(array $item)
    {
        $defaults = ['title' => null, 'content' => null, 'link' => null];
        $this->data = array_merge($defaults, $item);
    }

    public function getTitle()
    {
        return $this->data['title'];
    }

    public function getContent()
    {
        return $this->data['content'];
    }

    public function getLink()
    {
        return $this->data['link'];
    }

    public function getXml()
    {
        return null;
    }

    public function jsonSerialize()
    {
        return [
            'title' => $this->getTitle(),
            'content' => $this->getContent(),
            'link' => $this->getLink()
        ];
    }

    public function toArray()
    {
        return $this->jsonSerialize();
    }
}
