<?php

namespace App\FeedManager;

use App\FeedManager\FeedManagerInterface;

class FileCacheFeedManager implements FeedManagerInterface
{
    public function __construct(FeedManagerInterface $manager, $cacheDirectory)
    {
        $this->manager = $manager;
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
            return new \SimpleXMLElement($data['xml']);
        }

        $feed = $this->manager->load($url);
        $this->cacheFeed($cacheKey, $feed);

        return $feed;
    }

    protected function generateCacheKey($value)
    {
        return hash('sha1', $value);
    }

    protected function cacheFeed($cacheKey, \SimpleXMLElement $feed)
    {
        $file = "{$this->cacheDirectory}/{$cacheKey}.feed";
        $handler = fopen($file, "w");

        if (!$handler) {
            throw new \Exception("Cannot open");
        }

        $expiry = strtotime("+24 hours", time());
        $data = ["expiry" => $expiry, "xml" => $feed->asXml() ];
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
