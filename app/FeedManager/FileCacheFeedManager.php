<?php

namespace App\FeedManager;

use App\FeedManager\FeedManagerInterface;
use App\FeedManager\FeedInterface;
use App\FeedManager\FeedFactoryInterface;

class FileCacheFeedManager implements FeedManagerInterface
{
    public function __construct(FeedManagerInterface $manager, FeedFactoryInterface $factory, $cacheDirectory)
    {
        $this->manager = $manager;
        $this->factory = $factory;
        $this->cacheDirectory = $cacheDirectory;
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
        $cacheKey = $this->generateCacheKey($url);

        if ($data = $this->getCachedFeed($cacheKey)) {
            $xml = new \SimpleXMLElement($data['xml']);
            return $this->factory->createFeed($xml);
        }

        $feed = $this->manager->load($url);
        $this->cacheFeed($cacheKey, $feed);

        return $feed;
    }

    protected function generateCacheKey($value)
    {
        return hash('sha1', $value);
    }

    protected function cacheFeed($cacheKey, FeedInterface $feed)
    {
        $file = "{$this->cacheDirectory}/{$cacheKey}.feed";
        $handler = fopen($file, "w");

        if (!$handler) {
            throw new \Exception("Cannot open");
        }

        $expiry = strtotime("+24 hours", time());
        $data = ["expiry" => $expiry, "xml" => $feed->getXml()->asXml() ];
        $data = json_encode($data);

        $bytes = fwrite($handler, $data);
        fclose($handler);
    }

    protected function getCachedFeed($cacheKey, $mode = "r")
    {
        $file = "{$this->cacheDirectory}/{$cacheKey}.feed";

        if (!file_exists($file)) {
            return false;
        }

        $handler = fopen($file, $mode);

        if (!$handler) {
            throw new \Exception("Cannot open");
        }

        $data = fgets($handler);
        fclose($handler);

        $data = json_decode($data, true);

        if (time() > $data['expiry']) {
            return false;
        }

        return $data;
    }
}
