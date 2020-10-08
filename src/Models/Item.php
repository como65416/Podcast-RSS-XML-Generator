<?php

namespace Comoco\PodcastRssXml\Models;

class Item
{
    protected $title = '';

    protected $description = '';

    protected $pubTime = '';

    protected $audioUrl = '';

    protected $audioType = '';

    protected $audioLength = 0;

    protected $duration = 0;

    protected $isExplicit = false;

    protected $guid = '';

    /**
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @param int $pubTime
     */
    public function setPubTime(int $pubTime)
    {
        $this->pubTime = $pubTime;

        return $this;
    }

    /**
     * @param string $audioUrl
     */
    public function setAudioUrl(string $audioUrl)
    {
        $this->audioUrl = $audioUrl;

        return $this;
    }

    /**
     * @param string $audioType [description]
     */
    public function setAudioType(string $audioType)
    {
        $this->audioType = $audioType;

        return $this;
    }

    /**
     * @param int $audioLength [description]
     */
    public function setAudioLength(int $audioLength)
    {
        $this->audioLength = $audioLength;

        return $this;
    }

    /**
     * @param int $duration [description]
     */
    public function setDuration(int $duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * @param boolean $isExplicit
     */
    public function setIsExplicit(boolean $isExplicit)
    {
        $this->isExplicit = $isExplicit;

        return $this;
    }

    /**
     * @param string $guid
     */
    public function setGuid(string $guid)
    {
        $this->guid = $guid;

        return $this;
    }

    /**
     * @return array Sabre\Xml data format array
     */
    public function toXmlData()
    {
        return [
            'item' => [
                'title' => $this->title,
                $this->getDescriptionXml(),
                $this->getGuidXml(),
                $this->getPubDateXml(),
                $this->getEnclosureXml(),
            ],
        ];
    }

    protected function getDescriptionXml()
    {
        return [
            'description' => $this->description,
            'googleplay:description' => $this->description,
            'itunes:summary' => $this->description,
        ];
    }

    protected function getGuidXml()
    {
        return [
            'name' => 'guid',
            'attributes' => [
                'isPermaLink' => 'false',
            ],
            'value' => $this->guid,
        ];
    }

    protected function getPubDateXml()
    {
        return [
            'pubDate' => date('D, d M Y H:i:s', $this->pubTime) . ' GMT',
        ];
    }

    protected function getEnclosureXml()
    {
        return [
            'name' => 'enclosure',
            'attributes' => [
                'url' => $this->audioUrl,
                'type' => $this->audioType,
                'length' => (string) $this->audioLength,
            ],
        ];
    }

    protected function getExplicitXml()
    {
        return [
            'itunes:explicit' => ($this->isExplicit) ? 'yes' : 'no',
        ];
    }
}
