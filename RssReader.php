<?php

/**
 * Lettore Feed RSS
 * 
 * @author Mattepuffo
 * @since 2016-05-30
 * @version 1.2
 */
class RssReader {

    private $xmlUrl;
    private $xmlDoc;
    private $channel;
    private $channelTitle;
    private $channelLink;
    private $channelDescription;
    private $items;

    /**
     * Init
     * 
     * @param string $xmlUrl Url del feed
     */
    public function __construct($xmlUrl) {
        $this->xmlUrl = $xmlUrl;
        $this->xmlDoc = new DOMDocument();
        $this->xmlDoc->load($this->xmlUrl);
        $this->channel = $this->xmlDoc->getElementsByTagName('channel')->item(0);
        $this->channelTitle = $this->channel->getElementsByTagName('title')->item(0)->childNodes->item(0)->nodeValue;
        $this->channelLink = $this->channel->getElementsByTagName('link')->item(0)->childNodes->item(0)->nodeValue;
        $this->channelDescription = $this->channel->getElementsByTagName('description')->item(0)->childNodes->item(0)->nodeValue;
        $this->items = $this->xmlDoc->getElementsByTagName('item');
    }

    public function getChannelTitle() {
        return $this->channelTitle;
    }

    public function getChannelLink() {
        return $this->channelLink;
    }

    public function getChannelDescription() {
        return $this->channelDescription;
    }

    public function getItems($c) {
        $arrayItems = array();
        for ($i = 0; $i <= $c; $i++) {
            $arrayItems[] = array(
                'i_titolo' => $this->items->item($i)->getElementsByTagName('title')->item(0)->childNodes->item(0)->nodeValue,
                'i_link' => $this->items->item($i)->getElementsByTagName('link')->item(0)->childNodes->item(0)->nodeValue,
                'i_description' => $this->items->item($i)->getElementsByTagName('description')->item(0)->childNodes->item(0)->nodeValue,
                'i_last_up' => $this->items->item($i)->getElementsByTagName('pubDate')->item(0)->childNodes->item(0)->nodeValue,
            );
        }
        return $arrayItems;
    }

}
